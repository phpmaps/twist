/**
 * 
 */

$(document).ready(function() {
	//$('map').removeClass('post img,.type-page img');
	
	$(this).removeClass( "post img");
	$(this).removeClass( "type-page img");
	//$(this).removeClass( "img");
    console.log( "ready!" );
    var map = L.map('map').setView([37.75, -122.23], 10);
    L.esri.basemapLayer('Imagery').addTo(map);
    L.esri.basemapLayer('ImageryLabels').addTo(map);
});

