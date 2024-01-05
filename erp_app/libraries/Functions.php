<?php

class Functions {

    function url($url){
        $page = 'http://';
        $tmp = parse_url($url);
        if(array_key_exists('scheme',$tmp) && !empty($tmp['scheme'])){
            $page = $tmp['scheme'];
        }
        if(array_key_exists('host', $tmp) && !empty($tmp['host'])){
            $page .= $tmp['host'];
        }
        if(array_key_exists('path', $tmp) && !empty($tmp['path'])){
            $page .= $tmp['path'];
        }
        return $page;
    }

    function fecha_actual(){
        return  date("Y-m-d H:i:s");
    }

    function short_fecha_es($fecha){
        $date = strtotime($fecha);
        $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        return $dias[date('w', $date)]." ".date('d', $date)." ".$meses[date('n', $date)-1]. " ".date('Y', $date);
    }

    function fecha_es($fecha){
        $date = strtotime($fecha);
        $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        return $dias[date('w', $date)]." ".date('d', $date)." ".$meses[date('n', $date)-1]. " ".date('Y', $date). ' | '.date('H', $date).':'.date('i', $date).' hrs.';
    }

    function fecha_incidencia($fecha){
        $date = strtotime($fecha);
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        return date('j', $date).' '.$meses[date('n', $date)-1].' '.date('Y', $date).', '.date('g', $date).':'.date('i',$date).' '.date('A', $date);
    }

    function solo_fecha_incidencia($fecha){
        $date = strtotime($fecha);
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        return date('j', $date).' '.$meses[date('n', $date)-1].' '.date('Y', $date);
    }

    function sanear_string($string)
    {

        $string = trim($string);

        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );

        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $string
        );

        //Esta parte se encarga de eliminar cualquier caracter extraño
        $string = str_replace(
            array("\\", "¨", "º", "-", "~",
                 "#", "@", "|", "!", "\"",
                 "·", "$", "%", "&", "/",
                 "(", ")", "?", "'", "¡",
                 "¿", "[", "^", "`", "]",
                 "+", "}", "{", "¨", "´",
                 ">", "< ", ";", ",", ":",
                 "."),
            '',
            $string
        );


        return $string;
    }

    function getYoutubeImage($e){
        //GET THE URL
        $url = $e;

        $queryString = parse_url($url, PHP_URL_QUERY);

        parse_str($queryString, $params);

        $v = $params['v'];
        //DISPLAY THE IMAGE
        if(strlen($v)>0){
            echo "http://i3.ytimg.com/vi/$v/mqdefault.jpg";
        }
    }

    function getYoutubeEmbed($e){
        //GET THE URL
        $url = $e;

        $queryString = parse_url($url, PHP_URL_QUERY);

        parse_str($queryString, $params);

        $v = $params['v'];
        //DISPLAY THE IMAGE
        if(strlen($v)>0){
            echo "https://www.youtube.com/embed/$v/";
        }
    }

    function formas_pago(){
        $formas = [
            '01'    => 'EFECTIVO',
            '02'    => 'CHEQUE NOMINATIVO',
            '03'    => 'TRANSFERENCIA ELECTRÓNICA DE FONDOS',
            '04'    => 'TARJETA DE CRÉDITO',
            '05'    => 'MONEDERO ELECTRÓNICO',
            '06'    => 'DINERO ELECTRÓNICO',
            '08'    => 'VALES DE DESPENSA',
            '28'    => 'TARJETA DE DÉBITO',
            '29'    => 'TARJETA DE SERVICIO',
            '99'    => 'OTROS'
        ];

        return $formas;
    }
}