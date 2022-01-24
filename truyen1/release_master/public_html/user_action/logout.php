<?php
    setcookie('username',$username,time()+(-3600), "/", "zutafansub.tk");
    setcookie('password',md5($password),time()+(-3600), "/", "zutafansub.tk");
    setcookie('id',$row["id"],time()+(-3600), "/", "zutafansub.tk");
session_start();
unset($_SESSION["id"]);
unset($_SESSION["username"]);
unset($_SESSION["password"]);
header("Location: /");
exit();
?>