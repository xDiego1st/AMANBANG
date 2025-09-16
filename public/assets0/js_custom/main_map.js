function getBaseMaps(map, ACCESS_TOKEN, footName, type_map = 'osm_standard') {
    var apiKeyEsri = 'AAPKef6a87de87c34a329ec652751829c8acY8dQ3-wnWCF63XUWiKvBQqcSA1MwB_HEY6BkiL11FACuIbqBClnUiKj5HjRoViTI';

    ATTRIBUTION = "DISKOMINFO &copy; <a href='./'>" + footName + "</a>";
    MB_URL = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=' + ACCESS_TOKEN;
    OSM_URL = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    ESRI_URL = 'https://server.arcgisonline.com/arcgis/rest/services/{basemapStyle}/MapServer/tile/{z}/{y}/{x}?token=' + apiKeyEsri;
    // ESRI VECTOR
    ESRI_URL_TOKEN = 'https://basemaps-api.arcgis.com/arcgis/rest/services/styles/{basemapStyle}?type={type}&token=' + apiKeyEsri;
    ESRI_URL_TOKEN2 = 'https://ibasemaps-api.arcgis.com/arcgis/rest/services/{basemapStyle}/MapServer/tile/{z}/{y}/{x}?token=' + apiKeyEsri;

    // -- OSM
    var osm_standard = L.tileLayer(OSM_URL, { attribution: ATTRIBUTION });
    // -- MAPBOX
    var mb_streets = L.tileLayer(MB_URL, { id: 'mapbox/streets-v11', attribution: ATTRIBUTION });
    var mb_outdoors = L.tileLayer(MB_URL, { id: 'mapbox/outdoors-v11', attribution: ATTRIBUTION });
    var mb_satellite = L.tileLayer(MB_URL, { id: 'mapbox/satellite-v9', attribution: ATTRIBUTION });
    var mb_satellite_streets = L.tileLayer(MB_URL, { id: 'mapbox/satellite-streets-v11', attribution: ATTRIBUTION });
    var mb_navigation_day = L.tileLayer(MB_URL, { id: 'mapbox/navigation-day-v1', attribution: ATTRIBUTION });
    var mb_grayscale = L.tileLayer(MB_URL, { id: 'mapbox/light-v10', attribution: ATTRIBUTION});
    var mb_dark = L.tileLayer(MB_URL, { id: 'mapbox/dark-v10', attribution: ATTRIBUTION });
    
    // -- ESRI DEFAULT BASEMAP
    // var esri_national_geo = L.esri.basemapLayer("NationalGeographic", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    // List Base : "Streets", "Topographic", "Oceans", "OceansLabels", "NationalGeographic", "Physical", "Gray", "GrayLabels", "DarkGray", "DarkGrayLabels", "Imagery", "ImageryLabels", "ImageryTransportation", "ImageryClarity", "ImageryFirefly", ShadedRelief", "ShadedReliefLabels", "Terrain", "TerrainLabels" or "USATopo"
    
    // -- ESRI DEFAULT
    var esri_world_street = L.tileLayer(ESRI_URL, { basemapStyle: 'World_Street_Map', attribution: ATTRIBUTION });
    var esri_world_topo = L.tileLayer(ESRI_URL, { basemapStyle: 'World_Topo_Map', attribution: ATTRIBUTION });
    var esri_world_dark_gray_base = L.tileLayer(ESRI_URL, { basemapStyle: 'Canvas/World_Dark_Gray_Base', attribution: ATTRIBUTION });
    var esri_world_light_gray_base = L.tileLayer(ESRI_URL, { basemapStyle: 'Canvas/World_Light_Gray_Base', attribution: ATTRIBUTION });
    var esri_natgeo_world = L.tileLayer(ESRI_URL, { basemapStyle: 'NatGeo_World_Map', attribution: ATTRIBUTION });
    var esri_world_imagery = L.tileLayer(ESRI_URL, { basemapStyle: 'World_Imagery', attribution: ATTRIBUTION });
    var esri_world_transportation = L.tileLayer(ESRI_URL, { basemapStyle: 'Reference/World_Transportation', attribution: ATTRIBUTION });
    var esri_world_boundaries_places = L.tileLayer(ESRI_URL, { basemapStyle: 'Reference/World_Boundaries_and_Places', attribution: ATTRIBUTION });
    
    // List Base :
    // NatGeo_World_Map (MapServer)
    // USA_Topo_Maps (MapServer)
    // World_Imagery (MapServer)
    // World_Physical_Map (MapServer)
    // World_Shaded_Relief (MapServer)
    // World_Street_Map (MapServer)
    // World_Terrain_Base (MapServer)
    // World_Topo_Map (MapServer)
    // Canvas/World_Dark_Gray_Base (MapServer)
    // Canvas/World_Dark_Gray_Reference (MapServer)
    // Canvas/World_Light_Gray_Base (MapServer)
    // Canvas/World_Light_Gray_Reference (MapServer)
    // Elevation/World_Hillshade_Dark (MapServer)
    // Elevation/World_Hillshade (MapServer)
    // Ocean/World_Ocean_Base (MapServer)
    // Ocean/World_Ocean_Reference (MapServer)
    // Polar/Antarctic_Imagery (MapServer)
    // Polar/Arctic_Imagery (MapServer)
    // Polar/Arctic_Ocean_Base (MapServer)
    // Polar/Arctic_Ocean_Reference (MapServer)
    // Reference/World_Boundaries_and_Places_Alternate (MapServer)
    // Reference/World_Boundaries_and_Places (MapServer)
    // Reference/World_Reference_Overlay (MapServer)
    // Reference/World_Transportation (MapServer)
    // Specialty/DeLorme_World_Base_Map (MapServer)
    // Specialty/World_Navigation_Charts (MapServer)
    // WorldElevation3D/Terrain3D (ImageServer)
    // WorldElevation3D/TopoBathy3D (ImageServer)


    // -- ESRI VECTOR
    var esri_light_gray = L.esri.Vector.vectorBasemapLayer("ArcGIS:LightGray", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_dark_gray = L.esri.Vector.vectorBasemapLayer("ArcGIS:DarkGray", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_navigation = L.esri.Vector.vectorBasemapLayer("ArcGIS:Navigation", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_navigation_night = L.esri.Vector.vectorBasemapLayer("ArcGIS:NavigationNight", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_streets = L.esri.Vector.vectorBasemapLayer("ArcGIS:Streets", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_streets_night = L.esri.Vector.vectorBasemapLayer("ArcGIS:StreetsNight", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_streets_relief = L.esri.Vector.vectorBasemapLayer("ArcGIS:StreetsRelief", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_topographic = L.esri.Vector.vectorBasemapLayer("ArcGIS:Topographic", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_imagery_1 = L.esri.Vector.vectorBasemapLayer("ArcGIS:Imagery", { apiKey: apiKeyEsri, pane:"tilePane", attribution: ATTRIBUTION });

    var esri_imagery = L.layerGroup([
        esri_imagery_1,
        esri_world_transportation,
        esri_world_boundaries_places,
    ]);

    var esri_imagery_standard = L.esri.Vector.vectorBasemapLayer("ArcGIS:Imagery:Standard", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_imagery_labels = L.esri.Vector.vectorBasemapLayer("ArcGIS:Imagery:Labels", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_oceans = L.esri.Vector.vectorBasemapLayer("ArcGIS:Oceans", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_hillshade_light = L.esri.Vector.vectorBasemapLayer("ArcGIS:Hillshade:Light", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_hillshade_dark = L.esri.Vector.vectorBasemapLayer("ArcGIS:Hillshade:Dark", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_charted_territory = L.esri.Vector.vectorBasemapLayer("ArcGIS:ChartedTerritory", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_colored_pencil = L.esri.Vector.vectorBasemapLayer("ArcGIS:ColoredPencil", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_nova = L.esri.Vector.vectorBasemapLayer("ArcGIS:Nova", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_midcentury = L.esri.Vector.vectorBasemapLayer("ArcGIS:Midcentury", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_midcentury = L.esri.Vector.vectorBasemapLayer("ArcGIS:Midcentury", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_osm_standard = L.esri.Vector.vectorBasemapLayer("OSM:Standard", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });
    var esri_osm_streets = L.esri.Vector.vectorBasemapLayer("OSM:Streets", { apiKey: apiKeyEsri, attribution: ATTRIBUTION });



    if (type_map == 'osm_standard') osm_standard.addTo(map);
    else if (type_map == 'mb_streets') mb_streets.addTo(map);
    else if (type_map == 'mb_outdoors') mb_outdoors.addTo(map);
    else if (type_map == 'mb_satellite') mb_satellite.addTo(map);
    else if (type_map == 'mb_satellite_streets') mb_satellite_streets.addTo(map);
    else if (type_map == 'mb_navigation_day') mb_navigation_day.addTo(map);
    else if (type_map == 'mb_grayscale') mb_grayscale.addTo(map);
    else if (type_map == 'mb_dark') mb_dark.addTo(map);

    // -- ESRI DEFAULT
    else if (type_map == 'esri_world_street') esri_world_street.addTo(map);
    else if (type_map == 'esri_world_topo') esri_world_topo.addTo(map);
    else if (type_map == 'esri_world_dark_gray_base') esri_world_dark_gray_base.addTo(map);
    else if (type_map == 'esri_world_light_gray_base') esri_world_light_gray_base.addTo(map);
    else if (type_map == 'esri_natgeo_world') esri_natgeo_world.addTo(map);
    else if (type_map == 'esri_world_imagery') esri_world_imagery.addTo(map);
    else if (type_map == 'esri_world_transportation') esri_world_transportation.addTo(map);
    else if (type_map == 'esri_world_boundaries_places') esri_world_boundaries_places.addTo(map);
    
    // -- ESRI VECTOR
    else if (type_map == 'esri_light_gray') esri_light_gray.addTo(map);
    else if (type_map == 'esri_dark_gray') esri_dark_gray.addTo(map);
    else if (type_map == 'esri_navigation') esri_navigation.addTo(map);
    else if (type_map == 'esri_navigation_night') esri_navigation_night.addTo(map);
    else if (type_map == 'esri_streets') esri_streets.addTo(map);
    else if (type_map == 'esri_streets_night') esri_streets_night.addTo(map);
    else if (type_map == 'esri_streets_relief') esri_streets_relief.addTo(map);
    else if (type_map == 'esri_topographic') esri_topographic.addTo(map);
    else if (type_map == 'esri_imagery') esri_imagery.addTo(map);
    else if (type_map == 'esri_imagery_standard') esri_imagery_standard.addTo(map);
    else if (type_map == 'esri_imagery_labels') esri_imagery_labels.addTo(map);
    else if (type_map == 'esri_oceans') esri_oceans.addTo(map);
    else if (type_map == 'esri_hillshade_light') esri_hillshade_light.addTo(map);
    else if (type_map == 'esri_hillshade_dark') esri_hillshade_dark.addTo(map);
    else if (type_map == 'esri_charted_territory') esri_charted_territory.addTo(map);
    else if (type_map == 'esri_colored_pencil') esri_colored_pencil.addTo(map);
    else if (type_map == 'esri_nova') esri_nova.addTo(map);
    else if (type_map == 'esri_midcentury') esri_midcentury.addTo(map);
    else if (type_map == 'esri_osm_standard') esri_osm_standard.addTo(map);
    else if (type_map == 'esri_osm_streets') esri_osm_streets.addTo(map);

    
    var baseMaps = {
        "OSM Standard": osm_standard,
        "MB Streets": mb_streets,
        // "MB Outdor": mb_outdoors,
        // "MB Satellite": mb_satellite,
        "MB Satellite Streets": mb_satellite_streets,
        "MB Navigation Day": mb_navigation_day,
        // "MB Grayscale": mb_grayscale,
        // "MB Dark": mb_dark,
        
        // "Esri Light Gray": esri_light_gray,
        // "Esri Dark Gray": esri_dark_gray,
        "Esri Navigation": esri_navigation,
        // "Esri Navigation Night": esri_navigation_night,
        // "Esri Streets": esri_streets,
        // "Esri Streets Night": esri_streets_night,
        "Esri Streets Relief": esri_streets_relief,
        // "Esri Topographic": esri_topographic,
        "Esri Imagery": esri_imagery,
        // "Esri Imagery Standard": esri_imagery_standard,
        // "Esri Imagery Labels": esri_imagery_labels,
        // "Esri Oceans": esri_oceans,
        // "Esri Hillshade Light": esri_hillshade_light,
        // "Esri Hillshade Dark": esri_hillshade_dark,
        // "Esri Charted Territory": esri_charted_territory,
        // "Esri Colored Pencil": esri_colored_pencil,
        // "Esri Nova": esri_nova,
        // "Esri Midcentury": esri_midcentury,
        // "Esri OSM Standard": esri_osm_standard,
        // "Esri OSM Streets": esri_osm_streets,

        // -- ESRI DEFAULT
        // "Esri World Street": esri_world_street,
        // "Esri World Topo": esri_world_topo,
        // "Esri World Dark Gray Base": esri_world_dark_gray_base,
        // "Esri World Light Gray Base": esri_world_light_gray_base,
        "Esri National Geographic": esri_natgeo_world,
        // "Esri World Imagery": esri_world_imagery,
        // "Esri World Transportation": esri_world_transportation,
    };
    return baseMaps;
} 

function exportMap(map, title) {
    var browserControl = L.control.browserPrint({
        documentTitle: title,
        closePopupsOnPrint: false
    }).addTo(map);
    return exportMap;
}

function exportMapToPNG(map, title) {
    var saveAsImage = function () {
        return domtoimage
                // .toPng(document.body)
                .toPng(document.querySelector(".grid-print-container"))
                .then(function (dataUrl) {
                    var link = document.createElement('a');
                    link.download = map.printControl.options.documentTitle || title + '.png';
                    link.href = dataUrl;
                    link.click();
                }).catch(function (error) {
                    alert('Oops, something went wrong!' + error)
                    console.error('Oops, something went wrong!', error);
                });
    }
    L.control.browserPrint({
        documentTitle: title,
        printModes: [
            L.BrowserPrint.Mode.Auto(),
            L.BrowserPrint.Mode.Landscape('A4'),
            L.BrowserPrint.Mode.Portrait('A4'),
            L.BrowserPrint.Mode.Custom()
        ],
        printFunction: saveAsImage
    }).addTo(map);

    return exportMapToPNG;
}

function showCurrentPoint(position, map, myIcon) {
    var location = L.marker(position, {draggable: true}).addTo(map);
    location.on('dragend', function(e){
        $('#lat').val(e.target._latlng.lat);
        $('#lng').val(e.target._latlng.lng);
        $('#map_tipe').val("HYBRID");
        $('#zoom').val(map.getZoom());
    })

    map.on('zoomstart zoomend', function(e){
        $('#zoom').val(map.getZoom());
    })

    var lc = L.control.locate({
        flyTo: false,
        keepCurrentZoomLevel: false,
        showCompass: true,
        drawCircle: true,
        drawMarker: true,
        icon: 'fas fa-map-marker-alt',
        strings: {
            title: "Lokasi Saya",
            popup: "Anda berada disekitar {distance} {unit} dari titik ini",
            locateOptions: {
                watch: true,
                enableHighAccuracy: true
            },
        }
    }).addTo(map);

    map.on('locationfound', function(e) {
        $('#lat').val(e.latlng.lat);
        $('#lng').val(e.latlng.lng);
        location.setLatLng(e.latlng);
        map.setView(e.latlng);
        var radius = e.accuracy;
        L.circle(e.latlng, radius).addTo(map);
    });
    // map.on('locationerror', function(e) {
    //     alert(e.message);
    // });
    map.on('startfollowing', function() {
        map.on('dragstart', lc._stopFollowing, lc);
    }).on('stopfollowing', function() {
        map.off('dragstart', lc._stopFollowing, lc);
    });

    return showCurrentPoint;
}

function showCurrentPoint_Edit(position, map, myIcon) {
    var location = L.marker(position, {draggable: true}).addTo(map);
    location.on('dragend', function(e){
        $('#lat_e').val(e.target._latlng.lat);
        $('#lng_e').val(e.target._latlng.lng);
        $('#map_tipe').val("HYBRID");
        $('#zoom').val(map.getZoom());
    })

    map.on('zoomstart zoomend', function(e){
        $('#zoom').val(map.getZoom());
    })

    var lc = L.control.locate({
        flyTo: false,
        keepCurrentZoomLevel: false,
        showCompass: true,
        drawCircle: true,
        drawMarker: true,
        icon: 'fas fa-map-marker-alt',
        strings: {
            title: "Lokasi Saya",
            popup: "Anda berada disekitar {distance} {unit} dari titik ini",
            locateOptions: {
                watch: true,
                enableHighAccuracy: true
            },
        }
    }).addTo(map);

    map.on('locationfound', function(e) {
        $('#lat_e').val(e.latlng.lat);
        $('#lng_e').val(e.latlng.lng);
        location.setLatLng(e.latlng);
        map.setView(e.latlng);
        var radius = e.accuracy;
        L.circle(e.latlng, radius).addTo(map);
    });
    // map.on('locationerror', function(e) {
    //     alert(e.message);
    // });
    map.on('startfollowing', function() {
        map.on('dragstart', lc._stopFollowing, lc);
    }).on('stopfollowing', function() {
        map.off('dragstart', lc._stopFollowing, lc);
    });

    return showCurrentPoint;
}

function getDistance(from, to) {
    var distance = (from.distanceTo(to)).toFixed(0)/1000 + ' km';
    return distance;
}

function direction($lat, $lng) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    }
    function showPosition(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        var url = "https://www.google.com/maps/dir/?api=1&origin=" + latitude + "," + longitude +
            "&destination=" + $lat + "," + $lng + "";
        window.open(url, '_blank');
    }
}

function sidebarLeaflet(map, identifier = 'leaflet-sidebar') {
    var sidebar = L.control.sidebar(identifier, {
        position: 'right',
        closeButton: true,
        autoPan: true,
    });

    map.addControl(sidebar);
    map.on('click', function () {
        sidebar.hide();
    });
    sidebar.on('show', function () {
        console.log('Sidebar will be visible.');
    });
    sidebar.on('shown', function () {
        console.log('Sidebar is visible.');
    });
    sidebar.on('hide', function () {
        console.log('Sidebar will be hidden.');
    });
    sidebar.on('hidden', function () {
        console.log('Sidebar is hidden.');
    });
    L.DomEvent.on(sidebar.getCloseButton(), 'click', function () {
        console.log('Close button clicked.');
    });

    // setTimeout(function () {
    //     sidebar.show();
    // }, 500);
    // var marker = L.marker([0.5712795966325395, 99.7998046875]).addTo(map).on('click', function () {
    //     sidebar.toggle();
    // });
    
    return sidebar;
}




function style(feature) {
    return {
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7,
        fillColor: getColor(feature.properties.density)
    };
}

function highlightFeature(e) {
    var layer = e.target;
    layer.setStyle({
        fillColor: '#0F3F83', // '#0a0', 
        color: '#0F3F83', // '#0a0', 
        weight: 2,
        fillOpacity: 0.5,
        dashArray: '',
    });
    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
        layer.bringToFront();
    }
    info.update(feature.properties);
}

function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
}

function zoomToFeature(e) {
    map.fitBounds(e.target.getBounds());
}

function shpPekanbaru(map, shp_file) {
    var styleHighlight = {
        fillColor: '#0F3F83', // '#0a0', 
        color: '#0F3F83', // '#0a0', 
        weight: 2,
        fillOpacity: 0.5,
        dashArray: '',
    }
    
    var geo = L.geoJson({ features: [] }, {
        onEachFeature: function popUp(feature, layer) {
            // var out = [];
            // if (feature.properties) {
            //     for (var key in feature.properties) {
            //         out.push(key + ": " + feature.properties[key]);
            //     }
            //     layer.bindPopup(out.join("<br />"));
            // }

            // Info text on top for each polygon
            layer.bindTooltip(feature.properties.Kelurahan, {
                permanent: true, direction: "center"
            }).openTooltip();

            layer.on("click", function (event) {
                map.fire("click", event); // Trigger a map click as well.

                var centerOfPolygon = layer.getBounds().getCenter();
                var latOfClick = event.latlng.lat;
                var lngOfClick = event.latlng.lng;
                var popup = "<font size='3'>" + feature.properties.Kelurahan + "</font> <br>";
                    popup += "<font size='2'> Kecamatan : " + feature.properties.Kecamatan  + "</font> <br>";
                    popup += "<div class='text-small mt-2'> <a onclick='direction("+latOfClick+", "+lngOfClick+")'> Petunjuk arah, lihat google maps <br> ("+latOfClick+","+lngOfClick+") </a> </div>";
                layer.bindPopup(popup).openPopup();

                map.fitBounds(layer.getBounds());
            })
            .on("mouseover", function() {
                layer.setStyle(styleHighlight);

                if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                    layer.bringToFront();
                }
                info.update(feature.properties);
            })
            .on("mouseout", function() {
                // layer.closePopup();
                geo.resetStyle(this);
                info.update();
            });
        },
        style: function(feature) {
            return { 
                color: feature.properties.color ?? '#3388ff',
                weight: 1.5,
                opacity: 1,
                dashArray: '4',
            } 
        }
    }).addTo(myLayers['myLayers_pekanbaru']);// .addTo(map); // .addTo(myLayers['myLayers_pekanbaru']);
  
    // Add searching data from SHP Pekanbaru
    var searchControl = new L.Control.Search({
        position:'topleft',		
        layer: geo,
        propertyName: 'Kelurahan',
        initial: false,
        zoom: 18,
        collapsed: true,
        marker: false,
        moveToLocation: function(latlng, title, map) {
            var zoom = map.getBoundsZoom(latlng.layer.getBounds());
            map.setView(latlng, zoom); // access the zoom
        },
        buildTip: function(text, val) {
            var type = val.layer.feature.properties.Kecamatan;
            return '<div class="d-flex justify-content-between"> <a href="#">'+text+' </a> <b>'+type+'</b> </div>';
        }
    });
    searchControl.on('search:locationfound', function(e) {
        e.layer.setStyle(styleHighlight);
        if (e.layer._popup)
            e.layer.openPopup();
    })
    .on('search:collapsed', function(e) {
        geo.eachLayer(function(layer) { // restore feature color
            geo.resetStyle(layer);
        });	
    });
    map.addControl(searchControl);
        
    var base = shp_file;
    shp(base).then(function (data) {
        geo.addData(data);
        map.fitBounds(geo.getBounds());
    });

    // Control that shows info on hover (SHP Pekanbaru)
    var info = L.control();
    info.onAdd = function (map) {
        this._div = L.DomUtil.create('div', 'info-leaf');
        this.update();
        return this._div;
    };
    info.update = function (props) {
        this._div.innerHTML = (props ? '<h6 class="text-bold"> Batas Kelurahan Pekanbaru </h6> <b>' + props.Kelurahan + '</b> <br /> Kecamatan : ' + props.Kecamatan : '');
    };
    info.addTo(map);
}

function shpPekanbaru2(map, shp_file) {
    var styleHighlight = {
        fillColor: '#0F3F83', // '#0a0', 
        color: '#0F3F83', // '#0a0', 
        weight: 2,
        fillOpacity: 0.5,
    }
    
    var baseSHPPekanbaru = shp_file;
    shp(baseSHPPekanbaru).then(function(geojson) {
        var layerPku = new L.Shapefile(geojson, {
            onEachFeature: function(feature, layer) {
                // layer.on("click", function (e) {
                //     map.fire("click", e); // Trigger a map click as well.
                    
                //     var latOfClick = e.latlng.lat;
                //     var lngOfClick = e.latlng.lng;
                //     console.log(e.latlng)
                // });

                layer.on("click", function (event) {
                    map.fire("click", event); // Trigger a map click as well.

                    var centerOfPolygon = layer.getBounds().getCenter();
                    var latOfClick = event.latlng.lat;
                    var lngOfClick = event.latlng.lng;
                    var popup = "<font size='3'>" + feature.properties.Kelurahan + "</font> <br>";
                        popup += "<font size='2'> Kecamatan : " + feature.properties.Kecamatan  + "</font> <br>";
                        popup += "<div class='text-small mt-2'> <a onclick='direction("+latOfClick+", "+lngOfClick+")'> Petunjuk arah, lihat google maps <br> ("+latOfClick+","+lngOfClick+") </a> </div>";
                    layer.bindPopup(popup).openPopup();
                })
                .on("mouseover", function() {
                    layer.setStyle(styleHighlight);
                    var popup = "<font size='3'>" + feature.properties.Kelurahan + "</font> <br>";
                        popup += "<font size='2'> Kecamatan : " + feature.properties.Kecamatan  + "</font> <br>";
                    layer.bindPopup(popup).openPopup();
                })
                .on("mouseout", function() {
                    // layer.closePopup();
                    layerPku.resetStyle(this);
                });
            },
            style: function(feature) {
                return { 
                    color: feature.properties.color ?? '#3388ff',
                    weight: 1.5,
                    opacity: 1,
                } 
            },
            // pointToLayer: function (feature, latlng) {
            //     return L.circleMarker(latlng, {
            //         radius: 8,
            //         fillColor: "#ff7800",
            //         color: "#000",
            //         weight: 1.5,
            //         opacity: 1,
            //         fillOpacity: 0.8
            //     });
            // }
        }).addTo(myLayers['myLayers_pekanbaru']);

        // Add searching data from SHP Pekanbaru
        var searchControl = new L.Control.Search({
            position:'topleft',		
            layer: layerPku,
            propertyName: 'Kelurahan',
            initial: false,
            zoom: 18,
            collapsed: true,
            marker: false,
            moveToLocation: function(latlng, title, map) {
                var zoom = map.getBoundsZoom(latlng.layer.getBounds());
                map.setView(latlng, zoom); // access the zoom
            },
            buildTip: function(text, val) {
                var type = val.layer.feature.properties.Kecamatan;
                return '<div class="d-flex justify-content-between"> <a href="#">'+text+' </a> <b>'+type+'</b> </div>';
            }
        });
        searchControl.on('search:locationfound', function(e) {
            e.layer.setStyle(styleHighlight);
            if (e.layer._popup)
                e.layer.openPopup();
        })
        .on('search:collapsed', function(e) {
            layerPku.eachLayer(function(layer) { // restore feature color
                layerPku.resetStyle(layer);
            });	
        });
        map.addControl(searchControl);
    });
}


// // function eximShp(layerpeta)
// {
//     L.Control.Shapefile = L.Control.extend({

//     onAdd: function(map) {
//         var thisControl = this;

//         var controlDiv = L.DomUtil.create('div', 'leaflet-control-command');

//         // Create the leaflet control.
//         var controlUI = L.DomUtil.create('div', 'leaflet-control-command-interior', controlDiv);

//         // Create the form inside of the leaflet control.
//         var form = L.DomUtil.create('form', 'leaflet-control-command-form', controlUI);
//         form.action = '';
//         form.method = 'post';
//         form.enctype='multipart/form-data';

//         // Create the input file element.
//         var input = L.DomUtil.create('input', 'leaflet-control-command-form-input', form);
//         input.id = 'file';
//         input.type = 'file';
//         input.name = 'uploadFile';
//         input.style.display = 'none';

//         L.DomEvent
//             .addListener(form, 'click', function () {
//                 document.getElementById("file").click();
//             })
//             .addListener(input, 'change', function(){
//                 var input = document.getElementById('file');
//                 if (!input.files[0]) {
//                     alert("Pilih file shapefile dalam format .zip");
//                 }
//                 else {
//                     file = input.files[0];

//                     fr = new FileReader();
//                     fr.onload = receiveBinary;
//                     fr.readAsArrayBuffer(file);
//                 }

//                 function receiveBinary() {
//                     geojson = fr.result
//                     var shpfile = new L.Shapefile(geojson).addTo(map);

//                     shpfile.once('data:loaded', function (e) {

//                           var type = e.layerType;
//                           var layer = e.layer;
//                           var coords =[];
//                       var geojson = turf.flip(shpfile.toGeoJSON());
//                           var shape_for_db = JSON.stringify(geojson);

//                           var polygon =
//                           L.geoJson(JSON.parse(shape_for_db), {
//                               pointToLayer: function (feature, latlng) {
//                                   return L.circleMarker(latlng, { style: style });
//                               },
//                               onEachFeature: function (feature, layer) {
//                                   coords.push(feature.geometry.coordinates);
//                               },

//                           })

//                       var jml = coords[0].length;
//                             for (var x = 0; x < jml; x++)
//                             {
//                                 if (coords[0][x].length > 2)
//                                 {
//                                 coords[0][x].pop();
//                                 };
//                             }

//                                             document.getElementById('path').value =
//                                             JSON.stringify(coords)
//                                             .replace(']],[[', '],[')
//                                             .replace(']],[[', '],[')
//                                             .replace(']],[[', '],[')
//                                             .replace(']],[[', '],[')
//                                             .replace(']],[[', '],[')
//                                             .replace(']],[[', '],[')
//                                             .replace(']],[[', '],[')
//                                             .replace(']],[[', '],[')
//                                             .replace(']],[[', '],[')
//                                             .replace(']],[[', '],[')
//                                             .replace(']]],[[[', '],[')
//                                             .replace(']]],[[[', '],[')
//                                             .replace(']]],[[[', '],[')
//                                             .replace(']]],[[[', '],[')
//                                             .replace(']]],[[[', '],[')
//                                             .replace('[[[[', '[[[')
//                                             .replace(']]]]', ']]]')
//                                             .replace('],null]', ']');

//                                             layerpeta.fitBounds(shpfile.getBounds());

//                       });
//                 }
//             });

//         controlUI.title = 'Impor Shapefile (.Zip)';
//         return controlDiv;
//     },
// });

// L.control.shapefile = function(opts) {
//     return new L.Control.Shapefile(opts);
// };

// L.control.shapefile({ position: 'topleft' }).addTo(layerpeta);

// return eximShp;
// }

// //Cetak Peta ke PNG
// function cetakPeta(layerpeta)
// {
//   L.control.browserPrint({
//     documentTitle: "Peta_Wilayah",
//     printModes: [
//     //   L.control.browserPrint.mode.auto("Auto"),
//     //   L.control.browserPrint.mode.landscape("Landscape"),
//     //   L.control.browserPrint.mode.portrait("Portrait"),
      
//       L.BrowserPrint.Mode.Auto(),
//       L.BrowserPrint.Mode.Landscape(),
//       L.BrowserPrint.Mode.Portrait(),
//       L.BrowserPrint.Mode.Custom(),
//     ],
//   }).addTo(layerpeta);

//   L.Control.BrowserPrint.Utils.registerLayer(L.MarkerClusterGroup, 'L.MarkerClusterGroup', function (layer, utils) {
//     return layer;
//   });

// //   L.Control.BrowserPrint.Utils.registerLayer(L.MapboxGL, 'L.MapboxGL', function(layer, utils) {
// //       return L.mapboxGL(layer.options);
// //     }
// //   );

//   window.print = function () {
//     return domtoimage
//     .toPng(document.querySelector(".grid-print-container"))
//     .then(function (dataUrl) {
//       var link = document.createElement('a');
//       link.download = layerpeta.printControl.options.documentTitle || "exportedMap" + '.png';
//       link.href = dataUrl;
//       link.click();
//     });
//   };
//   return cetakPeta;
// }