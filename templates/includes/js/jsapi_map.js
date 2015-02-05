/**
 * 
 */

var map, geocoder;

require([ "esri/map", "esri/dijit/Geocoder", "dojo/domReady!" ], function(Map,
		Geocoder) {
	map = new Map("map", {
		basemap : "national-geographic",
		center : [ -120.435, 46.159 ], // lon, lat
		zoom : 7
	});

	geocoder = new Geocoder({
		map : map
	}, "search");
	geocoder.startup();
});