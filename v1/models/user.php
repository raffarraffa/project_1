<?php
function getLoginUser($conn, $user, $pass)
{
    try {
        $stm = "SELECT users.id,
        		     nombres,
                     apellido,
                     email,
                     telefono,
                    fecha_nacimiento,
                    domicilio,
                    ciudades.ciudad,
                    paises.pais,
                    foto
                FROM `users` 
                JOIN 
                    ciudades ON ciudades.id = users.ciudad 
                JOIN
                    paises ON ciudades.id_pais = paises.id_pais
                WHERE `email` =:user  AND `pass` = :pass;";
        //        $stm = "SELECT `id`,`nombres`,`apellido`,`email` FROM `users` WHERE `email` =:user  AND `pass` = :pass";
        $statment = $conn->prepare($stm);
        $statment->bindParam(':user', $user);
        $statment->bindParam(':pass', $pass);
        $statment->execute();
        return $statment->fetch((PDO::FETCH_ASSOC));
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
function insertUser($conn, $sqlkey, $sqlDataPosicion, $post)
{
    /**
     * @param $conn
     * @param $sqlkey
     * @param $sqlDataPosicion
     * @param $post
     * @return PDOStatement
     * atributos requeridos: ['nombres', 'apellido', 'email', 'telefono', 'fecha_nacimiento', 'pass', 'domicilio', 'ciudad', 'pais'];
     */
    try {
        $i = 0;
        $stm = "INSERT INTO `users` ($sqlkey) VALUES ($sqlDataPosicion);";
        $statment = $conn->prepare($stm);
        foreach ($post as $value) {
            $i++;
            echo  $i . ':' . $value . ',';
            $statment->bindValue($i, $value);
        }
        $statment->debugDumpParams();
        $statment->execute();
        return $statment;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return $e->getMessage();
    }
}
/*
    function logoutUser()
    {
        $_SESSION = null;
        session_destroy();
        session_start();
        return true;
    }

    function crearJWT($userId, $username, $secretKey, $expirationTime = 3600)
    {
        $secretKeyFull = $secretKey . date('d');
        $header = base64_encode(json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]));
        $payload = base64_encode(json_encode([
            'sub' => $userId,
            'username' => $username,
            'exp' => time() + $expirationTime
        ]));
        $signature = hash_hmac('sha256', "$header.$payload", $secretKey, true);
        $encodedSignature = base64_encode($signature);
        $jwt = "$header.$payload.$encodedSignature";
        return $jwt;
    }
*/