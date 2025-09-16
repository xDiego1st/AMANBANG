var fs = require("fs"),
    zlib = require("zlib"),
    UglifyJS = require("uglify-js"),
    MagicString = require("magic-string");

var PLUGIN_FILE_NAME = "leaflet.markercluster.layersupport";

function getFiles() {
    return [
        "src/layersupport.js"
    ];
}

function bundleFiles(files, copyright) {
    var bundle = new MagicString.Bundle(),
        umdTemplate = require(__dirname + "/umd.template.js"),
        i = 0;

    for (; i < files.length; i += 1) {
        bundle.addSource({
            filename: files[i],
            content: new MagicString( fs.readFileSync(files[i], "utf8") + "\n\n" )
        });
    }

    bundle.prepend(
        copyright + umdTemplate.before
    ).append(umdTemplate.after);

    return bundle;
}

function getSizeDelta(newContent, oldContent, fixCRLF) {
    if (!oldContent) {
        return " (new)";
    }
    if (newContent === oldContent) {
        return " (unchanged)";
    }
    if (fixCRLF) {
        newContent = newContent.replace(/\r\n?/g, '\n');
        oldContent = oldContent.replace(/\r\n?/g, '\n');
    }
    var delta = newContent.length - oldContent.length;

    return delta === 0 ? "" : " (" + (delta > 0 ? "+" : "") + delta + " bytes)";
}

function loadSilently(path) {
    try {
        return fs.readFileSync(path, "utf8");
    } catch (e) {
        return null;
    }
}

function bytesToKB(bytes) {
    return (bytes / 1024).toFixed(2) + " kB";
}

function fillContentWithMetaData(content, metaData) {
    return content.
        replace("{VERSION}", metaData.version).
        replace("{YEAR}", metaData["_year"]).
        replace("{AUTHOR}", metaData.author).
        replace("{LICENSE}", metaData.license).
        replace("{NAME}", metaData["_name"]).
        replace("{DESCRIPTION}", metaData.description);
}

exports.build = function (callback, metaData, compsBase32, buildName) {

    var files = getFiles(compsBase32);

    console.log("Bundling and minifying " + files.length + " file(s)...");

    var copyrightSrc = fillContentWithMetaData(fs.readFileSync("build/copyright-src.js", "utf8"), metaData),
        copyrightMin = fillContentWithMetaData(fs.readFileSync("build/copyright.js", "utf8"), metaData),

        filenamePart = PLUGIN_FILE_NAME + (buildName ? "-" + buildName : ""),
        pathPart = "dist/",
        srcFilename = filenamePart + "-src.js",
        mapFilename = filenamePart + "-src.js.map",
        srcPath = pathPart + srcFilename,
        mapPath = pathPart + mapFilename,

        bundle = bundleFiles(files, copyrightSrc),
        newSrc = bundle.toString() + "\n//# sourceMappingURL=" + mapFilename,

        oldSrc = loadSilently(srcPath),
        srcDelta = getSizeDelta(newSrc, oldSrc, true);

    // Make sure the dist/ folder exists.
    try {
        fs.accessSync(pathPart, fs.F_OK);
    } catch (err) {
        fs.mkdirSync(pathPart);
    }

    pathPart += filenamePart;

    console.log("\tNon-minified: " + bytesToKB(newSrc.length) + srcDelta);

    if (newSrc !== oldSrc) {
        fs.writeFileSync(srcPath, newSrc);
        fs.writeFileSync(mapPath, bundle.generateMap({
            file: srcFilename,
            includeContent: true,
            hires: false
        }));
        console.log("\tSaved to " + srcPath);
    }

    var path = pathPart + ".js",
        oldMinified = loadSilently(path),
        newMinified = copyrightMin + UglifyJS.minify(newSrc, {
                warnings: true,
                fromString: true
            }).code,
        delta = getSizeDelta(newMinified, oldMinified);

    console.log("\tMinified: " + bytesToKB(newMinified.length) + delta);

    var newGzipped,
        gzippedDelta = "";

    function done() {
        if (newMinified !== oldMinified) {
            fs.writeFileSync(path, newMinified);
            console.log("\tSaved to " + path);
        }
        console.log("\tGzipped: " + bytesToKB(newGzipped.length) + gzippedDelta);
        callback();
    }

    zlib.gzip(newMinified, function (err, gzipped) {
        if (err) { return; }
        newGzipped = gzipped;
        if (oldMinified && (oldMinified !== newMinified)) {
            zlib.gzip(oldMinified, function (err, oldGzipped) {
                if (err) { return; }
                gzippedDelta = getSizeDelta(gzipped, oldGzipped);
                done();
            });
        } else {
            done();
        }
    });
};


//////////////////////////////////////
// Docs
//////////////////////////////////////

function _fillFileTemplate(content, dataMap) {
	for (var key in dataMap) {
		//content = content.replace(key, dataMap[key]);
		content = _replaceAll(content, key, dataMap[key]);
	}

	return content;
}

function _replaceAll(target, search, replacement) {
	return target.split(search).join(replacement);
}

exports.buildDocs = function (callback, metaData) {

	console.log('Generating docs...');

	var readmeContent = _fillFileTemplate(fs.readFileSync('build/readme.template.md', 'utf8'), {
			'{{TAG_NAME}}': 'v' + metaData.version,
			'{{VERSION}}': metaData.version
		}),
		readmeFilepath = 'README.md';

	console.log('Writing README');
	fs.writeFileSync(readmeFilepath, readmeContent);

	console.log('Done');

	callback();
};
