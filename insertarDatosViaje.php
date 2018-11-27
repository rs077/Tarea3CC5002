<?php
/**
 * Created by PhpStorm.
 * User: rodro077
 * Date: 29-10-18
 * Time: 14:53
 */

include 'datosServidor.php';
$id_comuna_origen = "";
$id_comuna_destino = "";

// SELECT DATA id comuna origen
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$nombre_comuna_origen = $_POST["comuna-origen"];
$sql = "SELECT id FROM `comuna` WHERE nombre = '".$nombre_comuna_origen."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $id_comuna_origen = $row["id"];
    }
}
$conn->close();

// SELECT DATA id comuna destino
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$nombre_comuna_destino = $_POST["comuna-destino"];
$sql = "SELECT id FROM `comuna` WHERE nombre = '".$nombre_comuna_destino."'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $id_comuna_destino = $row["id"];
    }
}
$conn->close();

// INSERT DATA
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$fecha_ida = $_POST["fecha-viaje"];
$origen = $id_comuna_origen;
$destino = $id_comuna_destino;
$kilos_disponible = $_POST["kilos-disponibles"];
$espacio_disponible = $_POST["espacio-disponible"];
$email_viajero = $_POST["email"];
$celular_viajero = $_POST["celular"];

$sql = "INSERT INTO `viaje` (fecha_ida, origen, destino, kilos_disponible, 
    espacio_disponible, email_viajero, celular_viajero) 
    VALUES ('".$fecha_ida."', '".$origen."', '".$destino."', '".$kilos_disponible."', 
            '".$espacio_disponible."', '".$email_viajero."', '".$celular_viajero."')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: index.php");
?>