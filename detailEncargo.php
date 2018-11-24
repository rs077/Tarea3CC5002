<?php
/**
 * Created by PhpStorm.
 * User: rodro077
 * Date: 08-11-18
 * Time: 17:25
 */

header ('Content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Encargo</title>
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
$sql = "SELECT en1.descripcion, e1.valor, k1.valor, r1.nombre, c1.nombre, r2.nombre, c2.nombre, 
    en1.email_encargador, en1.celular_encargador, en1.id  
    FROM `encargo` en1, `comuna` c1 , `region` r1, `comuna` c2, 
    `region` r2,`kilos_encargo` k1, `espacio_encargo` e1
    WHERE c1.id=en1.origen 
    AND r1.id=c1.region_id 
    AND c2.id=en1.destino 
    AND r2.id=c2.region_id 
    AND k1.id=en1.kilos
    AND en1.id=". $_GET["id"] ." 
    AND e1.id=espacio";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table id='detalles'>
<thead><tr><th>Tipo de dato</th><th>Información</th></tr></thead>";
    // output data of each row
    while($row = $result->fetch_row()) {
        echo "<tr><td>Descripción encargo</td><td>" . $row[0]. "</td></tr>";
        echo "<tr><td>Espacio</td><td>" . $row[1]. "</td></tr>";
        echo "<tr><td>Kilos</td><td>" . $row[2]. "</td></tr>";
        echo "<tr><td>Region origen</td><td>" . $row[3]. "</td></tr>";
        echo "<tr><td>Comuna origen</td><td>" . $row[4]. "</td></tr>";
        echo "<tr><td>Region destino</td><td>" . $row[5]. "</td></tr>";
        echo "<tr><td>Comuna destino</td><td>" . $row[6]. "</td></tr>";
        echo "<tr><td>Foto encargo</td><td>foto</td></tr>";
        echo "<tr><td>Email encargador</td><td>" . $row[7]. "</td></tr>";
        echo "<tr><td>Número celular encargador</td><td>" . $row[8]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
<br><a href="verEncargos.php" class="btn btn-info">Volver a Encargos</a>
</body>
</html>
