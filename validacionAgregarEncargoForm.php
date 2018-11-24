<?php
/**
 * Created by PhpStorm.
 * User: rodro077
 * Date: 28-10-18
 * Time: 2:52
 */
// define variables and set to empty values
$descripcionEncargoErr = $espacioErr = $kilosErr = $regionOrigenErr
    = $comunaOrigenErr = $regionDestinoErr = $comunaDestinoErr = $fotoEncargoErr
    = $emailEncargadorErr = $numeroCelularEncargadorErr = "";
$descripcionEncargo = $espacio = $kilos = $regionOrigen
    = $comunaOrigen = $regionDestino = $comunaDestino = $fotoEncargo
    = $emailEncargador = $numeroCelularEncargador = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["descripcion"])) {
        $descripcionEncargoErr = "Descripción es requerida.";
    } elseif (strlen($_POST["descripcion"]) > 250) {
        $descripcionEncargoErr = "La descripción no debe exceder los 250 caracteres.";
    } else {
        $descripcionEncargo = test_input($_POST["descripcion"]);
    }
    if (!(strcmp($_POST["espacio-solicitado"],"--"))) {
        $espacioErr = "Espacio es requerido.";
    } else {
        $espacio = test_input($_POST["espacio-solicitado"]);
    }
    if (!(strcmp($_POST["kilos-solicitados"],"--"))) {
        $kilosErr = "Especificar kilos.";
    } else {
        $kilos = test_input($_POST["kilos-solicitados"]);
    }
    if (!(strcmp($_POST["region-origen"],"sin-region"))) {
        $regionOrigenErr = "Region es requerida.";
    } else {
        $regionOrigen = test_input($_POST["region-origen"]);
    }
    if (!(strcmp($_POST["comuna-origen"],"sin-region"))) {
        $comunaOrigenErr = "Region es requerida.";
    } else if (!(strcmp($_POST["comuna-origen"],"sin-comuna"))) {
        $comunaOrigenErr = "Comuna es requerida.";
    } else {
        $comunaOrigen = test_input($_POST["comuna-origen"]);
    }
    if (!(strcmp($_POST["region-destino"],"sin-region"))) {
        $regionDestinoErr = "Region es requerida.";
    } else {
        $regionDestino = test_input($_POST["region-destino"]);
    }
    if (!(strcmp($_POST["comuna-destino"],"sin-region"))) {
        $comunaDestinoErr = "Region es requerida.";
    } else if (!(strcmp($_POST["comuna-destino"],"sin-comuna"))) {
        $comunaDestinoErr = "Comuna es requerida.";
    } else if (!(strcmp($_POST["comuna-origen"], $_POST["comuna-destino"]))) {
        $comunaDestinoErr = "Comuna de destino no puede ser igual a la de origen.";
    } else {
        $comunaDestino = test_input($_POST["comuna-destino"]);
    }
    if (empty($_POST["email"])) {
        $emailEncargadorErr = "Email es requerido.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailEncargadorErr = "Email inválido.";
    } else {
        $emailEncargador = test_input($_POST["email"]);
    }
    if (empty($_POST["celular"])) {
        $numeroCelularEncargadorErr = "Número celular es requerido.";
    } elseif (!(preg_match('/^[0-9]{11}+$/', $_POST["celular"]))) {
        $numeroCelularViajeroErr = "Número celular con formato incorrecto.";
    } else {
        $numeroCelularEncargador = test_input($_POST["celular"]);
    }
    // CONDICION QUE VERIFICA QUE EL FORMULARIO ES VALIDO ANTES DE INSERTAR LOS DATOS
    if(!empty($descripcionEncargo) && !empty($regionOrigen) && !empty($comunaOrigen) && !empty($regionDestino) &&
        !empty($comunaDestino) && !empty($espacio) && !empty($kilos) && !empty($emailEncargador) &&
        !empty($numeroCelularEncargador)) {
        include 'insertarDatosEncargo.php';
    }
}

function test_input($data) {
    $data = trim($data); // elimina los caracteres innecesarios (espacio extra, tabulador, nueva línea)
    $data = stripslashes($data); // elimina las barras diagonales inversas
    $data = htmlspecialchars($data);
    return $data;
}
?>