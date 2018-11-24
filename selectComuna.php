<?php
/**
 * Created by PhpStorm.
 * User: rodro077
 * Date: 08-11-18
 * Time: 22:25
 */

include 'datosServidor.php';
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$conn->set_charset("utf8");
$sql = "SELECT nombre FROM `comuna`";
$result = mysqli_query($conn, $sql);
echo "<option value=''>Seleccione Comuna</option>";
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {

        echo "<option value='".$row['nombre']."'>".$row['nombre']."</option>";

    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>