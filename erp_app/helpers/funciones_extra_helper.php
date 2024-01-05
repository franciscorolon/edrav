<?php

if (!function_exists('fecha_actual')) {
    function fecha_actual() {
        return date('Y-m-d H:i:s');
    }
}

function datetime2textDate($fecha) {
    if ($fecha == null) {
        return '';
    }
    $fecha = explode('-', $fecha);
    $mes = $fecha[1];
    if ($mes == "01")
        $mes = "Ene";
    if ($mes == "02")
        $mes = "Feb";
    if ($mes == "03")
        $mes = "Mar";
    if ($mes == "04")
        $mes = "Abr";
    if ($mes == "05")
        $mes = "May";
    if ($mes == "06")
        $mes = "Jun";
    if ($mes == "07")
        $mes = "Jul";
    if ($mes == "08")
        $mes = "Ago";
    if ($mes == "09")
        $mes = "Sep";
    if ($mes == "10")
        $mes = "Oct";
    if ($mes == "11")
        $mes = "Nov";
    if ($mes == "12")
        $mes = "Dic";
    $fecha[1] = $mes;
    $fecha[2] = explode(' ', $fecha[2]);
    $fecha[2] = $fecha[2][0];
    $fecha = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];
    return $fecha;
}

function datetime2textDatetime($fecha, $mostrarHora = true) {
    if ($fecha == null) {
        return '';
    }

    $fecha = explode('-', $fecha);
    $mes = $fecha[1];
    if ($mes == "01")
        $mes = "Ene";
    if ($mes == "02")
        $mes = "Feb";
    if ($mes == "03")
        $mes = "Mar";
    if ($mes == "04")
        $mes = "Abr";
    if ($mes == "05")
        $mes = "May";
    if ($mes == "06")
        $mes = "Jun";
    if ($mes == "07")
        $mes = "Jul";
    if ($mes == "08")
        $mes = "Ago";
    if ($mes == "09")
        $mes = "Sep";
    if ($mes == "10")
        $mes = "Oct";
    if ($mes == "11")
        $mes = "Nov";
    if ($mes == "12")
        $mes = "Dic";
    $fecha[1] = $mes;
    $fecha[2] = explode(' ', $fecha[2]);
    $hora = $fecha[2][1];
    $fecha[2] = $fecha[2][0];
    $fecha = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0] . ($mostrarHora ? ' ' . $hora : '');
    return $fecha;
}

function textDateTime2DateTime($fecha) {
    $fecha = explode('-', $fecha);
    $mes = $fecha[1];
    if (strtolower($mes) == "ene")
        $mes = "Jan";
    if (strtolower($mes) == "feb")
        $mes = "Feb";
    if (strtolower($mes) == "mar")
        $mes = "Mar";
    if (strtolower($mes) == "abr")
        $mes = "Apr";
    if (strtolower($mes) == "may")
        $mes = "May";
    if (strtolower($mes) == "jun")
        $mes = "Jun";
    if (strtolower($mes) == "jul")
        $mes = "Jul";
    if (strtolower($mes) == "ago")
        $mes = "Aug";
    if (strtolower($mes) == "sep")
        $mes = "Sep";
    if (strtolower($mes) == "oct")
        $mes = "Oct";
    if (strtolower($mes) == "nov")
        $mes = "Nov";
    if (strtolower($mes) == "dic")
        $mes = "Dec";
    $fecha[1] = $mes;
    $fecha = implode('-', $fecha);

    $fecha = explode(' ', $fecha);
    $time = $fecha[1];
    $fecha = $fecha[0];
    $fecha = date_format(
            date_create_from_format('j-M-Y', $fecha), 'Y-m-d');

    return $fecha . ' ' . $time;
}

function meses($index, $short = true) {
    switch ($index) {
        case 1:
            return $short ? 'Ene' : 'Enero';
        case 2:
            return $short ? 'Feb' : 'Febrero';
        case 3:
            return $short ? 'Mar' : 'Marzo';
        case 4:
            return $short ? 'Abr' : 'Abril';
        case 5:
            return $short ? 'May' : 'Mayo';
        case 6:
            return $short ? 'Jun' : 'Junio';
        case 7:
            return $short ? 'Jul' : 'Julio';
        case 8:
            return $short ? 'Ago' : 'Agosto';
        case 9:
            return $short ? 'Sep' : 'Septiembre';
        case 10:
            return $short ? 'Oct' : 'Octubre';
        case 11:
            return $short ? 'Nov' : 'Noviembre';
        case 12:
            return $short ? 'Dic' : 'Diciembre';
    }
}

?>
