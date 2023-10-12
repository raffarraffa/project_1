<?php
require_once 'conexion.php';
define('ENTORNO_LOCAL', true);
if (ENTORNO_LOCAL) {
    if (!defined('DEV')) {
        define('DEV', true);
        define('SERVER', 'localhost');
        define('USER', 'root');
        define('PASS', '');
        define('DB', 'mascotas');
        define('ROOT', 'http://' . $_SERVER['HTTP_HOST'] . '/api/');
        define('OPTIONS', ' array("PDO::ATTR_ERRMODE" => "PDO::ERRMODE_EXCEPTION",
            "PDO::ATTR_DEFAULT_FETCH_MODE" => "PDO::FETCH_ASSOC")');
        session_start();
    }
} else {
    if (!defined('DEV')) {
        define('DEV', false);
        define('SERVER', 'localhost');
        define('USER', '');
        define('PASS', '');
        define('DB', 'mascotas_prod');
        ini_set('display_errors', 1);
        define('ROOT', 'http://' . $_SERVER['HTTP_HOST'] . '/api/');
        define('OPTIONS', ' array("PDO::ATTR_ERRMODE" => "PDO::ERRMODE_EXCEPTION",
            "PDO::ATTR_DEFAULT_FETCH_MODE" => "PDO::FETCH_ASSOC")');
        session_start();
    }
}
if (DEV) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}
function debug($debug)
{
    if (DEV) {
        echo '<pre>';
        //print_r($debug);
        var_dump($debug);
        echo '</pre>';
    }
}

function debugE($debug, $data = ' n/d')
{
    if (DEV) {
        echo '<pre>';
        //print_r($debug);
        var_dump($debug);
        echo '</pre>';
        echo PHP_EOL;
        echo ' Time: ' . time() . PHP_EOL . 'Data : ' . $data;
        exit();
    }
}
/* RUTAS PERMITIDAS */
define('VERSION', array('V1'));
define('CONTROLLER', array('USER', 'USERS', 'MASCOT', 'MASCOTS'));
define('MODEL', array('REGISTER', 'LOGIN', 'ADOPT'));
// conexion db
$conn = Connection::connect();
