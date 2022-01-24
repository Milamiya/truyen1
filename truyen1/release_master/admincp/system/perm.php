<?php
//REQUIERED ALL
//lấy thông tin kết nối tới db
session_start();
    include 'meta.php';
    //if cookies username tồn tại thì nhảy zô típ tục
    if(isset($_COOKIE['username'])) {
    if(isset($_COOKIE['username']) == true && isset($_COOKIE['id']) == true && isset($_COOKIE['password']) == true) {
    $usrcheck = $_COOKIE['username'];
    $secdbusr = mysqli_query($conn,"SELECT * FROM users WHERE `username` = '$usrcheck'");
    $loadcheck = mysqli_fetch_array($secdbusr);
    if($loadcheck['status'] == 1 or $loadcheck['admin'] == 0) { 
        setcookie('username',$username,time()+(-3600));
        setcookie('password',md5($password),time()+(-3600));
        setcookie('id',$row["id"],time()+(-3600));
    header("Location: /login.php");
    die();
    echo "<meta http-equiv='refresh' content='0; url=/login.php'>";
    }
    } else {
    header("Location: /login.php");
    die();
    echo "<meta http-equiv='refresh' content='0; url=/login.php'>";
    }
    }
    
    if(isset($_SESSION['username']) == true) {
    if(isset($_SESSION['username']) == true && isset($_SESSION['id']) == true && isset($_SESSION['password']) == true) {
    $usrcheck1 = $_SESSION['username'];
    $secdbusr1 = mysqli_query($conn,"SELECT * FROM users WHERE `username` = '$usrcheck1'");
    $loadcheck1 = mysqli_fetch_array($secdbusr1);
    if($loadcheck1['status'] == 1 or $loadcheck1['admin'] == 0) { 
        session_destroy();
    header("Location: /login.php");
    die();
    echo "<meta http-equiv='refresh' content='0; url=/login.php'>";
    }
    } else {
    header("Location: /login.php");
    die();
    echo "<meta http-equiv='refresh' content='0; url=/login.php'>";
    }
    }elseif (isset($_COOKIE['username']) == false) {
    header("Location: /login.php");
    die();
    echo "<meta http-equiv='refresh' content='0; url=/login.php'>";
    }
?>