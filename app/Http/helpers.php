<?php

function date_to_datedb($date, $delimiter = "-") {
    list($d, $m, $y) = explode($delimiter, $date);
    if(strlen($y) != 4) {
        throw new \Exception("Formato de fecha inválido.");
    }
    return "$y-$m-$d";
}

function date_from_datedb($date, $delimiter = "-") {
    list($y, $m, $d) = explode($delimiter, $date);
    if(strlen($y) != 4) {
        throw new \Exception("Formato de fecha inválido.");
    }
    return "$d/$m/$y";
}
