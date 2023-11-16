<?php
require_once 'conexion.php';
define('ENTORNO_LOCAL', true);
// set session secure
//session_set_cookie_params(0, "/", "", true, true);
session_start();
// setcookie("PHPSESSID", session_id(),['samesite' => 'none', 'secure' => true]);
// setcookie('mascotas', time(), ['samesite' => 'none', 'secure' => true]);
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
/* headers*/
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
//header("Access-Control-Allow-Headers: *"); 

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: *");
    exit;
}else{
	/*
header("Access-Control-Allow-Origin: http://localhost:8080");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: *"); 
header("Access-Control-Allow-Credentials: true"); 
setcookie("miCookie", "valor", [
    "expires" => time() + 3600,
    "path" => "/",
    "domain" => "/", // Sustituye con tu dominio
    "secure" => true,
    "httponly" => true,
    "samesite" => "None" // Esto permite el envío cross-origin
]);
*/
}
//session_start();