<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
include 'datosServidor.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");
$q = $_GET["q"];
$sql = "SELECT e.id, e.descripcion FROM `encargo` e";
$result = $conn->query($sql);
$response = "";
if (strlen($q) > 0){
    while($row = $result->fetch_row()) {
        $hint = $row[1];
        if (strpos($hint, $q) !== false) {
            $response = $hint;
            echo "<a href='detailEncargo.php?id=" .$row[0]. "'>" . $response ."<br/></a>";
        }
    }
}
if ($response == "") {
    $response = "no hay sugerencias";
    echo $response;
}
$conn->close();
?>
</body>
</html>