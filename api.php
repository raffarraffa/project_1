<?php
require_once 'config.php';
$version_auth = ['v1'];
$class_auth = ['login', 'users', 'user', 'mascotas', 'mascota', 'logout'];
$version_base = null;
$url = ($_SERVER['REQUEST_URI']);
$url_parsed = parse_url($url);
$url_parsed = explode('/', $url_parsed['path']);
if ($url_parsed[0] === '') { // si posicon 0 vacio elimino posicion array
    array_shift($url_parsed);
}

if (in_array(strtolower($url_parsed[0]), $version_auth)) {
    $version_base = './' . strtolower($url_parsed[0]);
} else {
    exit('ERROR');
}
if (in_array(strtolower($url_parsed[1]), $class_auth)) {
    $class_base = '/' . strtolower($url_parsed[1]);
} else {
    exit('ERROR');
}
switch ($class_base) {
    case '/login':
        include $version_base . '/controllers/login.php';
        echo loginUser($conn, $_POST);
        // debug($_SESSION);
        break;
    case '/logout':
        include $version_base . '/controllers/login.php';
        echo logoutUser();
        break;
    case '/users':
        break;
    case '/user':
        if (!empty($_SESSION)) {
          echo ($_SESSION['user']);
        } else {
          echo ('ERROR');
        }

        break;
    case '/mascotas':

        break;
    case '/mascota':

        break;
    default:
        exit('ERROR');
}

//$respuesta = new $class_base();
