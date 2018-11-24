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
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO `viaje` (fecha_ida, origen, destino, kilos_disponible, 
    espacio_disponible, email_viajero, celular_viajero) 
    VALUES (:fecha_ida, :origen, :destino, :kilos_disponible, :espacio_disponible, :email_viajero, :celular_viajero)");
    $stmt->bindParam(':fecha_ida', $fecha_ida);
    $stmt->bindParam(':origen', $origen);
    $stmt->bindParam(':destino', $destino);
    $stmt->bindParam(':kilos_disponible', $kilos_disponible);
    $stmt->bindParam(':espacio_disponible', $espacio_disponible);
    $stmt->bindParam(':email_viajero', $email_viajero);
    $stmt->bindParam(':celular_viajero', $celular_viajero);


    // insert a row
    $fecha_ida = $_POST["fecha-viaje"];
    $origen = $id_comuna_origen;
    $destino = $id_comuna_destino;
    $kilos_disponible = $_POST["kilos-disponibles"];
    $espacio_disponible = $_POST["espacio-disponible"];
    $email_viajero = $_POST["email"];
    $celular_viajero = $_POST["celular"];
    $stmt->execute();

}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
$conn = null;
header("Location: index.html");
?>