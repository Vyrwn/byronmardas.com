// EDA_Weather_Tool
// Base maps.js file that links to openstreetmaps and allows for search and pin locations
// Developed by F+P EDA team
// Version: v0.0.1
// 06.02.19

// notes: read all teh coordinates from the list of epw files.
// maybe asign colour groups to the markers to annotate the different climates?


var map;
var feature;


// list of locations to load as points on the map
// To DO : Replace this with a JSON file that has all the EPW information.
// var planes = [
// 		["7C6B07",-40.99497,174.50808],
// 		["7C6B38",-41.30269,173.63696],
// 		["7C6CA1",-41.49413,173.5421],
// 		["7C6CA2",-40.98585,174.50659],
// 		["C81D9D",-40.93163,173.81726],
// 		["C82009",-41.5183,174.78081],
// 		["C82081",-41.42079,173.5783],
// 		["C820AB",-42.08414,173.96632],
// 		["C820B6",-41.51285,173.53274]
// 	];




// base function to reference openstreetmap and create the map for the html to load.
function load_map() {
	map = new L.Map('map', {zoomControl: true});

	// from osmUrl we can change the looks of the map (make sure that any reference comes from open source data)
	var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
	// var osmUrl = 'https://tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png',
		osmAttribution = 'Map data &copy; 2012 <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
		osm = new L.TileLayer(osmUrl, {maxZoom: 18, attribution: osmAttribution});


	// define the center and zoom level when loading the page (zoom level 3 allows for a global view)
	map.setView(new L.LatLng(20, 10), 3).addLayer(osm);


	$.ajax({
		url: 'js/doe.csv',
		dataType: 'text/plain',
	}).done(successFunction);

	function successFunction(data) {
		var planes = data.split('/\r?\n|\r/');
		console.log(planes);

		// for (var i = 0; i < planes.length; i++) {
		// 	var markersplit = planes[i].split(',');
		// 	marker = new L.marker([markersplit[3],markersplit[4]]).bindPopup(markersplit[0]).addTo(map);
		// }

	}


	// variable to allow to read the points from above and pass that to the marker rendering function



	// create layer with all the markers to turn on and off (maybe no need for this)
	// var overlayMaps = {
	// 	"Cities" : marker
	// }
	// L.control.layers(overlayMaps).addTo(map);


}



// function that allows map to zoom in and center on the chosen location after performing search
function chooseAddr(lat1, lng1, lat2, lng2, osm_type) {
	var loc1 = new L.LatLng(lat1, lng1);
	var loc2 = new L.LatLng(lat2, lng2);
	var bounds = new L.LatLngBounds(loc1, loc2);

	if (feature) {
		map.removeLayer(feature);
	}
	if (osm_type == "node") {
		feature = L.circle( loc1, 25, {color: 'green', fill: false}).addTo(map);
		map.fitBounds(bounds);
		map.setZoom(18);
	} else {
		var loc3 = new L.LatLng(lat1, lng2);
		var loc4 = new L.LatLng(lat2, lng1);

		// feature = L.polyline( [loc1, loc4, loc2, loc3, loc1], {color: 'red'}).addTo(map);
		map.fitBounds(bounds);
	}
}



// function that allows to search for location (city, country, PoI) and returns the 5 first results.
function addr_search() {
    var inp = document.getElementById("addr");

    $.getJSON('http://nominatim.openstreetmap.org/search?format=json&limit=5&q=' + inp.value, function(data) {
        var items = [];

        $.each(data, function(key, val) {
            bb = val.boundingbox;
            items.push("<li><a href='#' onclick='chooseAddr(" + bb[0] + ", " + bb[2] + ", " + bb[1] + ", " + bb[3]  + ", \"" + val.osm_type + "\");return false;'>" + val.display_name + '</a></li>');
        });

		$('#results').empty();
        if (items.length != 0) {
            $('<p>', { html: "" }).appendTo('#results');
            $('<ul/>', {
                'class': 'my-new-list',
                html: items.join('')
            }).appendTo('#results');
        } else {
            $('<p>', { html: "No results found" }).appendTo('#results');
        }
    });
}


// script to allow for seach by using "Enter" key
var input = document.getElementById("addr");
		input.addEventListener("keyup", function(event) {
		  event.preventDefault();
		  if (event.keyCode === 13) {
			document.getElementById("searchButton").click();
		  }
		});



window.onload = load_map;
