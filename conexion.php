
<?php
class Connection
{
 /*    private static $usuario = '321087_mascota';
    private static $contrasena = 'mascotitas';
    private static $driver = "mysql:host=mysql-raffarraffa.alwaysdata.net;dbname=raffarraffa_mascotas";
    public static $conn = null; */
	private static $usuario = 'root';
    private static $contrasena = '';
    private static $driver = "mysql:host=localhost;dbname=mascotas";
    public static $conn = null;


    public static function connect()
    {
        try {
            self::$conn = new PDO(self::$driver, self::$usuario, self::$contrasena);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return self::$conn;
    }
}
