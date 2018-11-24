<?php if (count($_POST)>0) echo "Form Submitted!"; ?>
    <!--region origen-->
    <div class="form-group row">
        <label class="control-label" for="region-origen">Región origen:</label>
        <select class="form-control" id="region-origen" name="region-origen">
            <?php
            include 'selectRegion.php';
            ?>
        </select>
        <span class="error">* <?php echo $regionOrigenErr;?></span>
    </div>
    <!--comuna origen-->
    <div class="form-group row">
        <label class="control-label" for="comuna-origen">Comuna origen:</label>
        <select class="form-control" id="comuna-origen" name="comuna-origen">
            <?php
            include 'selectComuna.php';
            ?>
        </select>
        <span class="error">* <?php echo $comunaOrigenErr;?></span>
    </div>
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
$sql = "SELECT nombre FROM `region`";
$result = mysqli_query($conn, $sql);
echo "<option value=''>Seleccione Region</option>";
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