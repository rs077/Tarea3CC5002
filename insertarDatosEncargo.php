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
//$stmt->bindParam(':fotos', $foto);
//$foto = "";
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
    $stmt = $conn->prepare("INSERT INTO `encargo` (descripcion, origen, destino, espacio, kilos, 
    email_encargador, celular_encargador) 
    VALUES (:descripcion, :origen, :destino, :espacio, :kilos, :email_encargador, :celular_encargador)");
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':origen', $origen);
    $stmt->bindParam(':destino', $destino);
    $stmt->bindParam(':espacio', $espacio);
    $stmt->bindParam(':kilos', $kilos);
    $stmt->bindParam(':email_encargador', $email_encargador);
    $stmt->bindParam(':celular_encargador', $celular_encargador);

    // insert a row
    $descripcion = $_POST["descripcion"];
    $origen = $id_comuna_origen;
    $destino = $id_comuna_destino;
    $espacio = $_POST["espacio-solicitado"];
    $kilos = $_POST["kilos-solicitados"];
    $email_encargador = $_POST["email"];
    $celular_encargador = $_POST["celular"];
    $stmt->execute();

    echo "New records created successfully";

}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
$conn = null;
//header("Location: index.html");
?>