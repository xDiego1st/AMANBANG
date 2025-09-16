module.exports = {

    ///////////////////////////
    before:
    ///////////////////////////
'(function (root, factory) {\n' +
'    if (typeof define === "function" && define.amd) {\n' +
'        define(["leaflet"], factory);\n' +
'    } else if (typeof module === "object" && module.exports) {\n' +
'        factory(require("leaflet"));\n' + // Side effect only even in CommonJS
'    } else {\n' +
'        factory(root.L);\n' +
'    }\n' +
'}(this, function (L, undefined) {\n\n', // Does not actually expect the 'undefined' argument, it is just a trick to have an undefined variable while making sure we do not accidentally catch a global variable.


    ///////////////////////////
    after:
    ///////////////////////////
'\n' +
'}));\n'

};
