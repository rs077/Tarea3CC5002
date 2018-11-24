function validateDescripcion(descripcion) {
    if (descripcion == "") {
        alert("Debe añadir una descripcion.");
        return false
    }
    return true
}

function validateEspacio(espacio) {
    if (espacio == "--") {
        alert("Debe seleccionar un espacio.");
        return false
    }
    return true
}

function validateKilos(kilos) {
    if (kilos == "--") {
        alert("Debe seleccionar una cantidad de kilos.");
        return false
    }
    return true
}

function validateRegionComunaOrigen(region,comuna) {
    if (region == "sin-region" || comuna == "sin-region" ) {
        alert("Ingrese region de origen.");
        return false
    }
    else if (comuna == "sin-comuna" ) {
        alert("Ingrese comuna de origen.");
        return false
    }
    return true
}

function validateRegionComunaDestino(region,comuna) {
    if (region == "sin-region" || comuna == "sin-region" ) {
        alert("Ingrese region de destino.");
        return false
    }
    else if (comuna == "sin-comuna" ) {
        alert("Ingrese comuna de destino.");
        return false
    }
    return true
}

function validateDescripcion(descripcion) {
    if (descripcion == "") {
        alert("Debe añadir una descripcion.");
        return false
    }
    if (descripcion.length > 250) {
        alert("La descripción no debe exceder los 250 caracteres.");
        return false
    }
    return true
}
function validateFileUpload(foto) {
    var FileUploadPath = foto;
    if (FileUploadPath == '') {
        alert("Debe subir una imagen.");
    } else {
        var Extension = FileUploadPath.substring(
            FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
        if (Extension == "gif" || Extension == "png" || Extension == "bmp"
            || Extension == "jpeg" || Extension == "jpg") {
            return true
        }
        else {
            alert("Imagen solo con los formatos GIF, PNG, JPG, JPEG y BMP.");
            return false
        }
    }
}

function validateEmail(email) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        return true
    }
    alert("Email inválido.")
    return false
}

function validateCelular(phone) {
    var stripped = phone.replace(/[\(\)\.\-\ ]/g, '');
    if (stripped == "") {
        alert("Ingrese un celular.")
        return false
    } else if (isNaN(parseInt(stripped))) {
        phone = "";
        alert("El numero de caracteres no permitidos.");
        return false
    } else if (!(stripped.length == 11)) {
        phone = "";
        alert("El celular tiene un largo incorrecto.")
        return false
    }
    return true
}

function validateForm() {
    var descripcion = document.forms["formAgregarEncargo"]["descripcion"].value;
    var espacio = document.forms["formAgregarEncargo"]["espacio-solicitado"].value;
    var kilos = document.forms["formAgregarEncargo"]["kilos-solicitados"].value;
    var regionOrigen = document.forms["formAgregarEncargo"]["region-origen"].value;
    var comunaOrigen = document.forms["formAgregarEncargo"]["comuna-origen"].value;
    var regionDestino = document.forms["formAgregarEncargo"]["region-destino"].value;
    var comunaDestino = document.forms["formAgregarEncargo"]["comuna-destino"].value;
    var foto = document.forms["formAgregarEncargo"]["foto-encargo"].value;
    var email = document.forms["formAgregarEncargo"]["email"].value;
    var celular = document.forms["formAgregarEncargo"]["celular"].value;
    if (validateDescripcion(descripcion) && validateEspacio(espacio) && validateKilos(kilos) && validateRegionComunaOrigen(regionOrigen, comunaOrigen)
        && validateRegionComunaDestino(regionDestino, comunaDestino) && validateFileUpload(foto) && validateEmail(email) && validateCelular(celular)){
        alert("Encargo agregado.")
        return true
    }
    alert("Formulario con errores.")
    return false
}