var map = L.map('map').setView([0.5049228153847494,101.45442125242411], 13);

// Basemaps
var topographic=L.esri.basemapLayer("Topographic").addTo(map);

// Shapefile control
L.control.shapefile({ position: 'topleft' }).addTo(map);
