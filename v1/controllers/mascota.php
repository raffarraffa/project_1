<?php
include './v1/models/mascota.php';

function listMascotaEspecie($conn, $url_parsed)
{

    $raza = false;
    if (array_key_exists(3, $url_parsed)) {
        $especie = $url_parsed[3];
    } else {
        return  exit(header("HTTP/1.1 403 Prohibido"));
    }
    if (array_key_exists(4, $url_parsed)) {
        $raza = $url_parsed[4];
    }

    $result = getMascotaEspecieRaza($conn, $especie, $raza);

    return  json_encode($result);
}
