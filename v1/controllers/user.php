<?php
include './v1/models/user.php';

function perfilUser()
{
    if (isset($_SESSION['user'])) {
        return $_SESSION['user'];
    }
    return null;
}
function loginUser($conn, $post)
{
    /**
     * @param $conn
     * @param $post
     * @return array
     */
    try {
        /**
         * login controller autoriza o rechaza usuario
         */
        if (array_key_exists('user', $post) && array_key_exists('pass', $post)) {
            $user = $post['user'];
            $pass = $post['pass'];
            $user_auth = getLoginUser($conn, $user, $pass);
            if ($user_auth) {
                // session usuario auth 
                $_SESSION['user'] = json_encode($user_auth);
                // session jwt user
                $jwt = createJWT($user_auth['id'], $user_auth['nombres'], 'copa-4');
                $_SESSION['jwt'] = json_encode(['token' => $jwt]);
                // set cookie jwt
                setcookie('token', $_SESSION['jwt'], ['samesite' => 'none', 'secure' => true]);
                return json_encode($user_auth);
            }
        }
        return  exit(header("HTTP/1.1 403 Prohibido"));
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
function logOutUser()
{
    $_SESSION['user'] = null;
    $_SESSION['jwt'] = null;
    session_destroy();
    setcookie('token', '', ['samesite' => 'none', 'secure' => true]);
    return true;
}
function createJWT($userId, $username, $secret_key, $expirationTime = 3600)
{
    /**
     * @param $userId
     * @param $username
     * @param $secret_key
     * @param $expirationTime
     * @return token jwt
     */
    $header = base64_encode(json_encode([
        'typ' => 'JWT',
        'alg' => 'HS256'
    ]));
    $payload = base64_encode(json_encode([
        'sub' => $userId,
        'username' => $username,
        'exp' => time() + $expirationTime
    ]));
    $signature = hashJWT($header, $payload, $secret_key);
    $encodedSignature = base64_encode($signature);
    $jwt = "$header.$payload.$encodedSignature";
    return $jwt;
}
function verifyJWT($jwt, $secret_key)
{
    /**
     * @param $jwt
     * @param $secret_key
     * @return bool
     */
    // agrego dia al secret key
    $token_parts = explode('.', $jwt);
    // Decodificar las partes Base64
    $header = base64_decode($token_parts[0]);
    $payload = base64_decode($token_parts[1]);
    $signature = base64_decode($token_parts[2]);
    return (hashJWT($header, $payload, $secret_key) === $signature);
}
function hashJWT($header, $payload, $secret_key)
{
    /**
     * @param $header
     * @param $payload
     * @param $secret_key
     * @return string
     */
    $secret_key = $secret_key . date('d');
    return  hash_hmac('sha256', "$header.$payload", $secret_key, true);
}
function createUser($conn, $post)
{

    // data obligatoria en el form
    $data = ['nombres', 'apellido', 'email', 'telefono', 'fecha_nacimiento', 'pass', 'domicilio', 'ciudad', 'pais'];
    $validData = true;
    //  print_r(__FILE__ . '-' . __LINE__ . '-' .  $data);

    foreach ($post as $key => $value) {
        if (!in_array($key, $data)) {
            $validData = false;
            break;
        }
    }


    if ($validData) {
        // Construir consulta 
        $sqlKeys = implode(', ', array_keys($post));
        $sqlDataPosicion = implode(', ', array_fill(0, count($post), '?'));
        return insertUser($conn, $sqlKeys, $sqlDataPosicion, $post);
    }
}

/*
nombres	
apellido	
email	
telefono	
fecha_nacimiento	
pass	
domicilio	
ciudad	
pais	
genero	(null)
foto (null)
*/
