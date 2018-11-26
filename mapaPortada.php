<!DOCTYPE html>
<html>
<body>

<h1>Vista en Google Maps de los 3 últimos viajes ingresados:</h1>

<div id="googleMap" style="width:100%;height:500px;"></div>

<script>
    var map;
    function initialize() {
        var latlng = new google.maps.LatLng(-33.47269,-70.668182);
        var mapOptions = {
            center:latlng,
            zoom:4,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
        var address1 = 'Santiago';
        var address2 = 'Calama';

        var gc = new google.maps.Geocoder();

        gc.geocode({'address': address1}, function (res1, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                gc.geocode({'address': address2}, function (res2, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        new google.maps.Marker({
                            position: res1[0].geometry.location,
                            map: map
                        });

                        new google.maps.Marker({
                            position: res2[0].geometry.location,
                            map: map
                        });

                        new google.maps.Polyline({
                            path: [
                                res1[0].geometry.location,
                                res2[0].geometry.location
                            ],
                            strokeColor: '#FF0000',
                            geodesic: true,
                            map: map
                        });
                    }
                });
            }
        });

    }
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATD6NGNgSk5PI4nEru094HIQyln6IbtTo&callback=initialize">
</script>
</body>
</html>