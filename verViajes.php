<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Viajes</title>
    <link rel="stylesheet" type="text/css" href="css/boostrapV4w3cFix.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="js/regionesYcomunas.js"></script>
    <script src="js/validacionAgregarViajeForm.js"></script>
    <script src="js/clickableRow.js"></script>
    <script>
        $(function(){
            $("#nav-bar").load("barraNavegacion.html");
        });
    </script>
</head>
<body>
<!--barra de navegacion-->
<div id="nav-bar"></div>
<!--DATOS DE VIAJES-->
<div id="verViajes" class="container">
    <h2>Viajes Programados(click en viaje para más detalles)</h2>
    <?php
    include 'datosServidor.php';
    $page_name="verViajes.php"; //  If you use this code with a different page ( or file ) name then change this
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");           // All database details will be included here
    if (empty($_GET['start'])) {
        $start = 0;
    }
    else {
        $start=$_GET['start'];
    }
    if(strlen($start) > 0 and !is_numeric($start)){
        echo "Data Error";
        exit;
    }

    $eu = ($start - 0);
    $limit = 5;         // No of records to be shown per page.
    $this1 = $eu + $limit;
    $back = $eu - $limit;
    $next = $eu + $limit;
    /////////// Now let us print the table headers ////////////////
    $sql = "SELECT r1.nombre, c1.nombre, r2.nombre, c2.nombre, v1.fecha_ida, e1.valor, k1.valor, 
    v1.email_viajero, v1.id
    FROM `viaje` v1, `comuna` c1,`region` r1, `comuna` c2, `region` r2, `kilos_encargo` k1, `espacio_encargo` e1 
    WHERE c1.id=origen 
    AND c2.id=destino 
    AND k1.id=kilos_disponible 
    AND e1.id=espacio_disponible 
    AND r1.id=c1.region_id 
    AND r2.id=c2.region_id
    LIMIT $limit
    OFFSET $eu";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table class='table'>
<thead><tr>
    <th>Origen</th><th>Destino</th><th>Fecha Viaje</th><th>Espacio</th><th>Kilos</th><th>Email</th>
</tr></thead>";
        // output data of each row
        while($row = $result->fetch_row()) {
            echo "<tr class='clickable-row' data-href='http://localhost/Tarea2CC5002/detailViaje.php?id=" .$row[8]. "'><td>" . $row[0]. ", Comuna " . $row[1]. "</td>
<td>" . $row[2]. ", Comuna " . $row[3]. "</td><td>" . $row[4]. "</td><td>" . $row[5]. "</td><td>" . $row[6]. "</td><td>" . $row[7]. "</td></tr>";
        }
        echo "</table>";

    } else {
        echo "0 results";
    }
    $conn->close();
    ////////////////////////////// End of displaying the table with records ////////////////////////
    try {
        $dbo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

    /////////////// Total number of records in our table. We will use this to break the pages///////

    /////// The variable nume above will store the total number of records in the table////
    $sql = "SELECT count(v1.id) AS numero FROM `viaje` v1";
    $nume = $dbo->query($sql)->fetchColumn();
    ///////////////////////////////
    if($nume > $limit ){ // Let us display bottom links if sufficient records are there for paging
/////////////// Start the bottom links with Prev and next link with page numbers /////////////////
        echo "<table align = 'center' width='50%'><tr><td  align='left' width='30%'>";

//// if our variable $back is equal to 0 or more then only we will display the link to move back ////////
        if($back >=0) {
            print "<a href='$page_name?start=$back'>Anterior</a>";
        }
//////////////// Let us display the page links at  center. We will not display the current page as a link ///////////
        echo "</td><td align=center width='30%'>";
        $i=0;
        $l=1;

        for($i=0;$i < $nume;$i=$i+$limit){
            if($i <> $eu){
                echo " <a href='$page_name?start=$i'>$l</a> ";
            }
            else { echo "$l";}        /// Current page is not displayed as link and given font color red
            $l=$l+1;
        }

        echo "</td><td  align='right' width='30%'>";
///////////// If we are not in the last page then Next link will be displayed. Here we check that /////
        if($this1 < $nume) {
            print "<a href='$page_name?start=$next'>Siguiente</a>";}
        echo "</td></tr></table>";

    }// end of if checking sufficient records are there to display bottom navigational link.
    ?>
</div>
</body>
</html>