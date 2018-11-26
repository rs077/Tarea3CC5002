<!DOCTYPE html>
<html>
<body>

<h1>Vista en Google Maps de los 3 últimos viajes ingresados:</h1>

<div id="googleMap" style="width:100%;height:400px;"></div>

<script>
    var map;
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-33.47269,-70.668182);
        var mapOptions = {
            center:latlng,
            zoom:6,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
        var geocoder1 = new google.maps.Geocoder();
        var geocoder2 = new google.maps.Geocoder();
        var address1 = 'Santiago';
        var address2 = 'Arica';
        geocodeAddress(geocoder1, map, address1);
        geocodeAddress(geocoder2, map, address2);
    }

    function geocodeAddress(geocoder, resultsMap, address) {
        //var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

    /*var marker = new google.maps.Marker({
            position: latlng,
            animation:google.maps.Animation.BOUNCE
            });
        marker.setMap(map);*/

        /*var marker = new google.maps.Marker({
            position: latlng,
            animation:google.maps.Animation.BOUNCE
            });
        marker.setMap(map);*/

    /*
    var geocoder;
    var map;
    var ultimoMarker;
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-33.47269,-70.668182);
        var mapOptions = {
            zoom: 12,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    }
    function codeAddress() {
  var address = document.getElementById('address').value;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location,
	  title: address
      });
      var infowindow = new google.maps.InfoWindow({
      	  content: "<p>Descripcion de este marcador, con muchos datos</p><h2>titulo</h2>"
	  });
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
      });
      // agregar linea entre este y último marcador
      if (ultimoMarker) {
	var flightPlanCoordinates = [
          ultimoMarker.position, marker.position];
        var flightPath = new google.maps.Polyline({
            path: flightPlanCoordinates,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
          });

          flightPath.setMap(map);
      }
      ultimoMarker = marker;
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
    */
</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATD6NGNgSk5PI4nEru094HIQyln6IbtTo&callback=initialize">

</script>

</body>
</html>