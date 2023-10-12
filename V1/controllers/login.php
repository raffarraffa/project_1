<?php
function loginUser($conn, $post)
{
    $stm = "SELECT `nombres`,`apellido`,`email` FROM `users` WHERE `email` =:user  AND `pass` = :pass";
    $statment = $conn->prepare($stm);
    $user = $post['user'];
    $pass = $post['pass'];
    $statment->bindParam(':user', $user);
    $statment->bindParam(':pass', $pass);
    $statment->execute();
    $result = $statment->fetch((PDO::FETCH_ASSOC));
    if ($result) {
        $result = json_encode($result);
        $_SESSION['user'] = $result;
        header("Content-type: application/json; charset=utf-8");
        header("cache-control: must-revalidate");
        // header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        header('Content-Length: ' . strlen($result));
        header('Vary: Accept-Encoding');
        exit($result);
    }
    return  exit(header("HTTP/1.1 401 Prohibido"));;
}
function logoutUser()
{
    $_SESSION = null;
    session_destroy();
    session_start();
    return true;
}
