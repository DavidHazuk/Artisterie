function initMap() {
	var artisterie = {lat: 45.753112, lng: 4.911909};
	var map = new google.maps.Map(document.getElementById('map'), {	zoom: 5,
		center: artisterie,
		zoom: 16
	});

	var marker = new google.maps.Marker({position: artisterie,
										map: map
										});

	marker.addListener('click', function() {
		infowindow.open(map, marker);
	});				
}
