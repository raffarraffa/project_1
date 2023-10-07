<?php
$version_auth = ['v1', 'v2', 'v3'];
$class_auth = ['users', 'user', 'mascotas', 'mascota'];
$version_base = null;
$url = ($_SERVER['REQUEST_URI']);
$url_parsed = parse_url($url);
$url_parsed = explode('/', $url_parsed['path']);
if ($url_parsed[0] === '') {
    array_shift($url_parsed);
}
if (in_array($url_parsed[0], $version_auth)) {
    $version_base = './' . $url_parsed[0];
} else {
    exit('ERROR');
}
if (in_array($url_parsed[1], $class_auth)) {
    $class_base = '/' . $url_parsed[1];
} else {
    exit('ERROR');
}
include $version_base . '/controllers/' . $class_base . '.php';

require_once 'conexion.php';
$conne = Connection::connect();
