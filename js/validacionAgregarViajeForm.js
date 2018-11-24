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

function validateFecha(date) {
    // First check for the pattern
    var regex_date = /^\d{4}\-\d{1,2}\-\d{1,2}$/;
    if(!regex_date.test(date))
    {
        alert("Fecha de viaje incorrecta.");
        return false;
    }
    // Parse the date parts to integers
    var parts   = date.split("-");
    var day     = parseInt(parts[2], 10);
    var month   = parseInt(parts[1], 10);
    var year    = parseInt(parts[0], 10);
    // Check the ranges of month and year
    if(year < 1000 || year > 3000 || month == 0 || month > 12)
    {
        alert("Fecha de viaje incorrecta.")
        return false;
    }
    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    // Adjust for leap years
    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
    {
        monthLength[1] = 29;
    }
    // Check the range of the day
    return day > 0 && day <= monthLength[month - 1];
}

function validateEspacioDisponible(espacio) {
    if (espacio == "--") {
        alert("Debe seleccionar un espacio.");
        return false
    }
    return true
}

function validateKilosDisponibles(kilos) {
    if (kilos == "--") {
        alert("Debe seleccionar una cantidad de kilos.");
        return false
    }
    return true
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
    var regionOrigen = document.forms["formAgregarViaje"]["region-origen"].value;
    var comunaOrigen = document.forms["formAgregarViaje"]["comuna-origen"].value;
    var regionDestino = document.forms["formAgregarViaje"]["region-destino"].value;
    var comunaDestino = document.forms["formAgregarViaje"]["comuna-destino"].value;
    var fechaViaje = document.forms["formAgregarViaje"]["fecha-viaje"].value;
    var espacioDisponible = document.forms["formAgregarViaje"]["espacio-disponible"].value;
    var kilosDisponibles = document.forms["formAgregarViaje"]["kilos-disponibles"].value;
    var email = document.forms["formAgregarViaje"]["email"].value;
    var celular = document.forms["formAgregarViaje"]["celular"].value;
    if (validateRegionComunaOrigen(regionOrigen, comunaOrigen) && validateRegionComunaDestino(regionDestino, comunaDestino) &&
        validateFecha(fechaViaje) && validateEspacioDisponible(espacioDisponible) && validateKilosDisponibles(kilosDisponibles) &&
        validateEmail(email) && validateCelular(celular)){
        alert("Viaje agregado.")
        return true
    }
    alert("Formulario con errores.")
    return false
}



