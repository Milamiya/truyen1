<?php
//disabe 3 cái thằng thông báo lằng nha lằng nhằng của php
error_reporting(0);
session_start();
    //lấy thông tin kết nối tới db
    include '../system/meta.php';
        if(isset($_GET['loguser']) == true && isset($_GET['logpass']) == true && $_GET['adminlogin'] == 1) {
        $usernam = $_GET['loguser'];
        $passwor = $_GET['logpass'];
    	$password = filter_var($passwor, FILTER_SANITIZE_STRING);
    	$username = filter_var($usernam, FILTER_SANITIZE_STRING);
            $selectfdb = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username' AND password = '$password'");
            $row = mysqli_fetch_array($selectfdb);
            //nếu nhập đúng thì sẽ chạy xuống phần setcookie và echo dialog
            //nếu status = 0 thì sẽ tiếp tục, còn nếu =1 thì sẽ tạch
            if ($row["username"] == $username && $row["password"] == $password && $row["status"] == 0) {
                setcookie('username','unload',time()+(-3600));
                setcookie('password','unload',time()+(-3600));
                setcookie('id','unload',time()+(-3600));
                unset($_SESSION["id"]);
                unset($_SESSION["username"]);
                unset($_SESSION["password"]);
                session_destroy();
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['id'] = $row['id'];
                echo "<b>Note:</b> Forwarding!";
                header("Location: /");
                exit();
            } else {
            if ($row["username"] == $username && $row["password"] == $password && $row["status"] == 1 && $row['admin'] == 1) {
                echo "<b>Fatal Error:</b> Tài khoản của bạn đã bị khóa";
                echo "<meta http-equiv='refresh' content='0; url=https://fztfansub.tk'>";
            } else {
            if ($row["username"] == $username && $row["password"] == $password && $row["status"] == 1 && $row['admin'] == 0) {
                echo "<b>Fatal Error:</b> Tài khoản của bạn đã bị khóa";
                echo "<meta http-equiv='refresh' content='0; url=https://fztfansub.tk'>";
            } else {
                echo "<b>Fatal Error:</b> Wrong password or username";
                echo "<meta http-equiv='refresh' content='0; url=https://fztfansub.tk'>";
            } } }
    } else {
    if(isset($_COOKIE['username']) == true or $_SESSION['username'] == true) {
        header("Location: /");
        exit();
    }
    if(isset($_GET['v'])) {
        $errorform = "Đăng nhập để tiếp tục!";
        $linkload = "<meta http-equiv='refresh' content='0; url=/xem-video/?v=".$_GET['v']."'>";
        $loadv = $_GET['v'];
        $secdbvidi4 = mysqli_query($conn,"SELECT * FROM video WHERE `code` = '$loadv'");
        $loadi4 = mysqli_fetch_array($secdbvidi4);
    } else {
        $linkload = "<meta http-equiv='refresh' content='0; url=/dang-tai'>";
    }
    if (isset($_POST["loginbtn"])) {
        $usernam = $_POST['username'];
        $passwor = $_POST['password'];
        
        //chống SQL Injection 
        $usernam = strip_tags($usernam);
    	$usernam = addslashes($usernam);
    	$passwor = strip_tags($passwor);
    	$passwor = addslashes($passwor);
    	$password = filter_var($passwor, FILTER_SANITIZE_STRING);
    	$username = filter_var($usernam, FILTER_SANITIZE_STRING);
    	
        //nếu đéo chịu nhấp user vs pass
        if (empty($username) || empty($password)) {
            $errorform = "<b>Fatal Error:</b> Please fill blank";
        }
        //ngược lại nếu đã nhập
        else {
            if($username == "demouser" && $password == "demouser") {
                $errorform = "<p style='color:red'><i>Lỗi không xác định</i></p>";
            } else {
            $selectfdb = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username' AND password = '$password'");
            $row = mysqli_fetch_array($selectfdb);
            //nếu nhập đúng thì sẽ chạy xuống phần setcookie và echo dialog
            //nếu status = 0 thì sẽ tiếp tục, còn nếu =1 thì sẽ tạch
            if ($row["username"] == $username && $row["password"] == $password && $row["status"] == 0) {
                if(isset($_POST['savepass'])) {
                    setcookie('username',$username,time()+(10 * 365 * 24 * 60 * 60),"/");
                    setcookie('password',md5($password),time()+(10 * 365 * 24 * 60 * 60),"/");
                    setcookie('id',$row["id"],time()+(10 * 365 * 24 * 60 * 60),"/");
                    $errorform = "<p style='color:green'>Đăng nhập thành công! - Đã lưu mật khẩu</p>";
                    echo $linkload;
                } else {
                  $_SESSION['username'] = $username;
                  $_SESSION['password'] = $password;
                  $_SESSION['id'] = $row['id'];
                $errorform = "<p style='color:green'>Đăng nhập thành công!</p>";
                    echo $linkload;
                }
            }
            else {
                $errorform = "<p style='color:red'><i>Sai tên tài khoản hoặc mật khẩu</i></p>";
            }
            //nếu như tk bị disable
            if ($row["status"] == 1) {
                $errorform = "<p style='color:red'><i>Tài khoản của bạn đã bị khóa</i></p>";
            }
        } }
    }
?>

<!DOCTYPE html>
<html lang="vi" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if(isset($_GET['v'])) {
        echo '<title>'.$loadi4['title'].' - Đăng nhập - '.$titlehead.'</title>';
    } else {
        echo '<title>Đăng nhập - '.$titlehead.'</title>';
    }?>
    <link id="light" rel="stylesheet" href="/css/login/light.css">
    <link id="dark" rel="stylesheet" href="/css/login/dark.css">
  </head>
  <body>
    <div class="wrapper">
      <div class="title">
Login to Zutafansub!</div>
<form action="" method="POST">
      <div class="dialog" style="text-align: center;">
 <?php if(isset($errorform) == true){echo $errorform;}?>
  </div>
        <div class="field">
          <input type="text" name="username" required>
          <label>Username</label>
        </div>
<div class="field">
          <input type="password" name="password" required>
          <label>Password</label>
        </div>
<div class="content">
          <div class="checkbox">
            <input type="checkbox" name="savepass" id="remember-me">
            <label for="remember-me">Lưu mật khẩu</label>
          </div>
<div class="forgotpass">
<a href="/quen-mat-khau">Quên mật khẩu?</a></div>
</div>
<div class="field">
          <input name="loginbtn" type="submit" value="Login">
        </div>
<div class="signup">
Don't have an account? <a href="/tao-tai-khoan">Signup now</a></div>
<div class="footer" style="bottom:0;font-size:10px;text-align:center;padding-top:10px">
    Form login by Vodang Phuquy - Dark theme login by Nguyen Anh Duc<br>
    &copy 2020 Zuta Fansub - Developed by Nguyen Anh Duc
</div>
</form>
</div>
    <script type="text/javascript">
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.getElementById("light").remove();
        document.body.style.color = "#fff";
        document.getElementById("lg").remove();
    } else {
        document.getElementById("dark").remove();
        document.getElementById("lk").remove();
    }
    </script>
</body>
</html>
<?php } ?>