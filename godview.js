

var canvas = document.getElementById('maps');
var map;
var image = "node.png";
var lastid = 1;

function initialize(){

	var coordinates = {lat: 9.081999, lng: 8.675277};
	var options = {
	  zoom: 3,
      center: coordinates,
      draggable: true,
      streetViewControl: true,
      mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	map = new google.maps.Map(canvas, options);
}

function getUser(){

	if (window.XMLHttpRequest){
	    var xmlhttp = new XMLHttpRequest();
	} else { 
	    var xmlhttp = new ActiveXObject('Microsoft.XMLHTTP'); 
	}

	xmlhttp.onreadystatechange = function(){

		if(xmlhttp.statusText === "OK"){

	    	var data = JSON.parse(xmlhttp.responseText);

	    	var infowindow = new google.maps.InfoWindow;

	    	lastid++;

	    	for (var i = 0; i < data.length; i++){

	    		marker = new google.maps.Marker({
				    position: new google.maps.LatLng(data[i].latitude, data[i].longitude),
				    map: map,
				    icon: image
				});

			    google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
			        return function() {

			        	var contentString = 
			    		'<div>'+
			    		'<h3>' + data[i].username+ '<h3>'
			    		'<div>';

			          infowindow.setContent(contentString);
			          infowindow.open(map, marker);
			        }
			    })(marker, i));

			    google.maps.event.addListener(marker, 'mouseout', (function(marker, i) {
			        return function() {
			        	infowindow.close();
			        }
			    })(marker, i));

			    google.maps.event.addListener(marker, 'click', (function(marker, i) {
			        return function() {
			        	map.setZoom(9);
		      			map.setCenter(this.getPosition());
			        }
			    })(marker, i));
	    	}
	    }
	}

	xmlhttp.open('GET', 'fetchuser.php?user=' + lastid ,true);
	xmlhttp.send();
}





window.onload = function(){

	initialize();

	setInterval(() => {
		getUser();
	}, 5000);

	
}



