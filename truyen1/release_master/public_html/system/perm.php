<?php
//REQUIERED ALL
//lấy thông tin kết nối tới db
session_start();
    include 'meta.php';
    //if cookies username tồn tại thì nhảy zô típ tục
    if(isset($_COOKIE['username']) == true) {
    if(isset($_COOKIE['username']) == true && isset($_COOKIE['id']) == true && isset($_COOKIE['password']) == true) {
    $usrcheck = $_COOKIE['username'];
    $secdbusr = mysqli_query($conn,"SELECT * FROM users WHERE `username` = '$usrcheck'");
    $loadcheck = mysqli_fetch_array($secdbusr);
    if($loadcheck['status'] == 1) { 
     /*   setcookie('username',$username,time()+(-3600));
        setcookie('password',md5($password),time()+(-3600));
        setcookie('id',$row["id"],time()+(-3600));
        session_destroy();
    header("Location: /");
    die();
    echo "<meta http-equiv='refresh' content='0; url=/'>";*/
      include 'disabled_acc.php';
      exit();
    }
    }
    }
    if(isset($_SESSION['username']) == true) {
    if(isset($_SESSION['username']) == true && isset($_SESSION['id']) == true && isset($_SESSION['password']) == true) {
    $usrcheck1 = $_SESSION['username'];
    $secdbusr1 = mysqli_query($conn,"SELECT * FROM users WHERE `username` = '$usrcheck1'");
    $loadcheck1 = mysqli_fetch_array($secdbusr1);
    if($loadcheck1['status'] == 1) { 
        /*session_destroy();
    header("Location: /");
    die();
    echo "<meta http-equiv='refresh' content='0; url=/'>";
    */
      include 'disabled_acc.php';
      exit();
    }
    if($loadcheck1['password'] == $_SESSION['password']) {
        
    } else {
    session_destroy();
    header("Location: /");
    die();
    echo "<meta http-equiv='refresh' content='0; url=/'>";
    }
    }
    }
?>