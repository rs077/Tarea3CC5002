<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Viaje</title>
    <link rel="stylesheet" type="text/css" href="css/vistaDetalles.css">
    <link rel="stylesheet" type="text/css" href="css/boostrapV4w3cFix.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script>
        $(function(){
            $("#nav-bar").load("barraNavegacion.html");
        });
    </script>
</head>
<body>
<!--barra de navegacion-->
<div id="nav-bar"></div>
<?php

include 'datosServidor.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");
$sql = "SELECT r1.nombre, c1.nombre, r2.nombre, c2.nombre, v1.fecha_ida, e1.valor, k1.valor, 
    v1.email_viajero, v1.celular_viajero 
    FROM `viaje` v1, `region` r1,`comuna` c1, `region` r2,
    `comuna` c2, `kilos_encargo` k1, `espacio_encargo` e1 
    WHERE c1.id=origen 
    AND c2.id=destino 
    AND k1.id=kilos_disponible 
    AND e1.id=espacio_disponible 
    AND v1.id=". $_GET["id"] ." 
    AND r1.id = c1.region_id 
    AND r2.id = c2.region_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table id='detalles'>
<thead><tr><th>Tipo de dato</th><th>Información</th></tr></thead>";
    // output data of each row
    while($row = $result->fetch_row()) {
        echo "<tr><td>Region origen</td><td>" . $row[0]. "</td></tr>";
        echo "<tr><td>Comuna origen</td><td>" . $row[1]. "</td></tr>";
        echo "<tr><td>Region destino</td><td>" . $row[2]. "</td></tr>";
        echo "<tr><td>Comuna destino</td><td>" . $row[3]. "</td></tr>";
        echo "<tr><td>Fecha viaje</td><td>" . $row[4]. "</td></tr>";
        echo "<tr><td>Espacio disponible</td><td>" . $row[5]. "</td></tr>";
        echo "<tr><td>Kilos disponibles</td><td>" . $row[6]. "</td></tr>";
        echo "<tr><td>Email viajero</td><td>" . $row[7]. "</td></tr>";
        echo "<tr><td>Número celular viajero</td><td>" . $row[8]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
<br><a href="verViajes.php" class="btn btn-info">Volver a viajes</a>
</body>
</html>
