<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
    <link rel="stylesheet" type="text/css" href="css/boostrapV4w3cFix.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="js/regionesYcomunas.js"></script>
    <script src="js/validacionAgregarViajeForm.js"></script>
</head>
<body>
    <!--barra de navegacion-->
    <?php include 'barraNavegacion.html';?>
    <div id="index" class="container">
    <h1>Bienvenido al portal de viajes y envíos.</h1>
    <!--barra de busqueda-->
    <?php include 'searchBar.php';?>
    <!--mapa-->
    <?php include 'mapaPortada.php';?>
<br>
<footer>
    <p>
        <a href="http://jigsaw.w3.org/css-validator/check/referer">
            <img style="border:0;width:88px;height:31px"
                 src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
                 alt="¡CSS Válido!" />
        </a>
    </p>
</footer>
</div>
</body>
</html>