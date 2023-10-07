
<?php
class Connection
{
    private static $usuario = 'root';
    private static $contrasena = '';
    private static $driver = "mysql:host=localhost;dbname=mascotas";
    public static $conn = null;


    public static function connect()
    {
        try {
            self::$conn = new PDO(self::$driver, self::$usuario, self::$contrasena);
            echo 'Conectado';
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return self::$conn;
    }
}
