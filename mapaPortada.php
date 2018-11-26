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
$sql = "SELECT v1.id, r1.nombre, c1.nombre, r2.nombre, c2.nombre, v1.fecha_ida, k1.valor, e1.valor
    FROM `viaje` v1, `region` r1,`comuna` c1, `region` r2,
    `comuna` c2, `kilos_encargo` k1, `espacio_encargo` e1 
    WHERE c1.id=origen 
    AND c2.id=destino 
    AND r1.id = c1.region_id 
    AND r2.id = c2.region_id
    AND k1.id=kilos_disponible 
    AND e1.id=espacio_disponible 
    ORDER BY v1.id DESC
    LIMIT 3";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_row();
    $id1 = $row[0];
    $addressOrigen1 = $row[2] . ", " . $row[1];
    $addressDestino1 = $row[4] . ", " . $row[3];
    $fechaViaje1 = $row[5];
    $kilos1 = $row[6];
    $espacio1 = $row[7];
    $row = $result->fetch_row();
    $id2 = $row[0];
    $addressOrigen2 = $row[2] . ", " . $row[1];
    $addressDestino2 = $row[4] . ", " . $row[3];
    $fechaViaje2 = $row[5];
    $kilos2 = $row[6];
    $espacio2 = $row[7];
    $row = $result->fetch_row();
    $id3 = $row[0];
    $addressOrigen3 = $row[2] . ", " . $row[1];
    $addressDestino3 = $row[4] . ", " . $row[3];
    $fechaViaje3 = $row[5];
    $kilos3 = $row[6];
    $espacio3 = $row[7];
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
        var id1 = <?php echo json_encode($id1); ?>;
        var addressOrigen1 = <?php echo json_encode($addressOrigen1); ?>;
        var addressDestino1 = <?php echo json_encode($addressDestino1); ?>;
        var fechaViaje1 = <?php echo json_encode($fechaViaje1); ?>;
        var kilos1 = <?php echo json_encode($kilos1); ?>;
        var espacio1 = <?php echo json_encode($espacio1); ?>;
        var id2 = <?php echo json_encode($id2); ?>;
        var addressOrigen2 = <?php echo json_encode($addressOrigen2); ?>;
        var addressDestino2 = <?php echo json_encode($addressDestino2); ?>;
        var fechaViaje2 = <?php echo json_encode($fechaViaje2); ?>;
        var kilos2 = <?php echo json_encode($kilos2); ?>;
        var espacio2 = <?php echo json_encode($espacio2); ?>;
        var id3 = <?php echo json_encode($id3); ?>;
        var addressOrigen3 = <?php echo json_encode($addressOrigen3); ?>;
        var addressDestino3 = <?php echo json_encode($addressDestino3); ?>;
        var fechaViaje3 = <?php echo json_encode($fechaViaje3); ?>;
        var kilos3 = <?php echo json_encode($kilos3); ?>;
        var espacio3 = <?php echo json_encode($espacio3); ?>;
        codeAddress(gc, addressOrigen1, addressDestino1, fechaViaje1, kilos1, espacio1, id1);
        codeAddress(gc, addressOrigen2, addressDestino2, fechaViaje2, kilos2, espacio2, id2);
        codeAddress(gc, addressOrigen3, addressDestino3, fechaViaje3, kilos3, espacio3, id3);
    }
    function codeAddress(gc, addressOrigen, addressDestino, fechaViaje, kilos, espacio, id) {
        gc.geocode({'address': addressOrigen}, function (resOrigen, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                gc.geocode({'address': addressDestino}, function (resDestino, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var markerOrigen = new google.maps.Marker({
                            position: resOrigen[0].geometry.location,
                            map: map,
                            title: addressOrigen + ", Fecha de viaje: " + fechaViaje
                        });

                        var markerDestino = new google.maps.Marker({
                            position: resDestino[0].geometry.location,
                            map: map,
                            title: addressDestino + ", Fecha de viaje: " + fechaViaje
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

                        var infowindow = new google.maps.InfoWindow({
                            content:
                                "<h4>Detalle de viaje:</h4>" +
                                "<ul>\n" +
                                "<li>Fecha de viaje: " + fechaViaje + "\n" +
                                "<li>Origen: " + addressOrigen + "\n" +
                                "<li>Destino: " + addressDestino + "\n" +
                                "<li>Espacio: " + espacio + "\n" +
                                "<li>Kilos: " + kilos + "\n" +
                                "<li><a href='detailViaje.php?id=" + id +"' target='_blank'>Detalle viaje</a>" +
                                "</ul>"


                        });
                        google.maps.event.addListener(markerOrigen, 'click', function() {
                            infowindow.open(map,markerOrigen);
                        });
                        google.maps.event.addListener(markerDestino, 'click', function() {
                            infowindow.open(map,markerDestino);
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