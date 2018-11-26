<!DOCTYPE html>
<html>
<body>

<h1>Vista en Google Maps de los 3 últimos viajes ingresados:</h1>

<div id="googleMap" style="width:100%;height:500px;"></div>
<?php
/* codigo php para consultar tres ultimos viajes */
include 'datosServidor.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");
$sql = "SELECT v1.id, r1.nombre, c1.nombre, r2.nombre, c2.nombre 
    FROM `viaje` v1, `region` r1,`comuna` c1, `region` r2,
    `comuna` c2 
    WHERE c1.id=origen 
    AND c2.id=destino 
    AND r1.id = c1.region_id 
    AND r2.id = c2.region_id
    ORDER BY v1.id DESC
    LIMIT 3";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_row();
    $addressOrigen1 = $row[2] . "," . $row[1];
    $addressDestino1 = $row[4] . "," . $row[3];
    $row = $result->fetch_row();
    $addressOrigen2 = $row[2] . "," . $row[1];
    $addressDestino2 = $row[4] . "," . $row[3];
    $row = $result->fetch_row();
    $addressOrigen3 = $row[2] . "," . $row[1];
    $addressDestino3 = $row[4] . "," . $row[3];

} else {
    echo "0 results";
}
$conn->close();
?>
<script>
    var map;
    function initialize() {
        var latlng = new google.maps.LatLng(-33.47269, -70.668182);
        var mapOptions = {
            center: latlng,
            zoom: 5,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
        var gc = new google.maps.Geocoder();
        var addressOrigen1 = <?php echo json_encode($addressOrigen1); ?>;
        var addressDestino1 = <?php echo json_encode($addressDestino1); ?>;
        var addressOrigen2 = <?php echo json_encode($addressOrigen2); ?>;
        var addressDestino2 = <?php echo json_encode($addressDestino2); ?>;
        var addressOrigen3 = <?php echo json_encode($addressOrigen3); ?>;
        var addressDestino3 = <?php echo json_encode($addressDestino3); ?>;
        codeAddress(gc, addressOrigen1, addressDestino1);
        codeAddress(gc, addressOrigen2, addressDestino2);
        codeAddress(gc, addressOrigen3, addressDestino3);
    }
    function codeAddress(gc, addressOrigen, addressDestino) {
        gc.geocode({'address': addressOrigen}, function (resOrigen, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                gc.geocode({'address': addressDestino}, function (resDestino, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        new google.maps.Marker({
                            position: resOrigen[0].geometry.location,
                            map: map
                        });

                        new google.maps.Marker({
                            position: resDestino[0].geometry.location,
                            map: map
                        });

                        new google.maps.Polyline({
                            path: [
                                resOrigen[0].geometry.location,
                                resDestino[0].geometry.location
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
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAG195ROSB1lHUnAgFQjLMqBBBE7yq9Tss&callback=initialize">
</script>
</body>
</html>