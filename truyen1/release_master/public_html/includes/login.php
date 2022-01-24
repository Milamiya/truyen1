<?php
if (isset($_POST["login_nowwwwww"])) {
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
        $errorform_login = "<b>Fatal Error:</b> Please fill blank";
        echo "<script>window.onload = open_login_dialog;</script>";
    }
    //ngược lại nếu đã nhập
    else {
        if ($username == "demouser" && $password == "demouser") {
            $errorform_login = "<p style='color:red'><i>Lỗi không xác định</i></p>";
            echo "<script>window.onload = open_login_dialog;</script>";
        } else {
            $selectfdb = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
            $row = mysqli_fetch_array($selectfdb);
            //nếu nhập đúng thì sẽ chạy xuống phần setcookie và echo dialog
            //nếu status = 0 thì sẽ tiếp tục, còn nếu =1 thì sẽ tạch
            if ($row["username"] == $username && $row["password"] == $password) {
                setcookie('username', $username, time() + (10 * 365 * 24 * 60 * 60), "/", 'zutafansub.tk');
                setcookie('password', md5($password), time() + (10 * 365 * 24 * 60 * 60), "/", 'zutafansub.tk');
                setcookie('id', $row["id"], time() + (10 * 365 * 24 * 60 * 60), "/", 'zutafansub.tk');
                $errorform_login = "<p style='color:green'>Đăng nhập thành công!</p>";
                echo "<script>window.onload = location.href=''</script>";
                echo "<script>window.onload = open_login_dialog;</script>";
            } else {
                $errorform_login = "<p style='color:red'><i>Sai tên tài khoản hoặc mật khẩu</i></p>";
                echo "<script>window.onload = open_login_dialog;</script>";
            }
            /*if ($row["status"] == 1) {
                $errorform_login = "<p style='color:red'><i>Tài khoản của bạn đã bị khóa</i></p>";
                echo "<script>window.onload = open_login_dialog;</script>";
            }*/
        }
    }
}
?>
<div id="loginDialog_overlay" onclick="close_login_dialog()"></div>
<div id="loginDialogbruh">
    <div class="loginDialog_times"><a onclick="close_login_dialog()">&times</a></div>
    <div class="loginDialog_main_content">
        <h2>Đăng nhập vào Zuta Fansub</h2>
        <p style="font-size: 12px;">đăng nhập để trải nghiệm hết mọi tính năng trong web Zuta Fansub nhé!</p>
        <span style="font-size:15px;padding:2px"><?php if(isset($errorform_login)) {echo $errorform_login;} ?></span>
        <form style="padding-top: 10px;" action="/" method="POST">
            <input type="text" name="username" placeholder="tên đăng nhập" required>
            <input type="password" name="password" placeholder="mật khẩu" required>
            <span>Chưa có tài khoản? <a style="cursor:pointer" onclick="close_login_dialog(), open_reg_dialog()">Đăng ký ngay</a><br>Login này không hoạt động? <a href="/dang-nhap">Nhấn vào đây nhé</a></span>
            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" name="login_nowwwwww">đăng nhập</button>
        </form>
    </div>
</div>
<style>
    #loginDialogbruh .loginDialog_times {
        float: right;
        width: fit-content;
        padding: 10px;
        margin-top: 0%;
        font-size:50px;
        cursor: pointer;
    }
    .loginDialog_main_content form span {
        font-size: 12px !important;
        padding: 10px;
        float: left;
    }

    .loginDialog_main_content form span a {
        color: rgba(25, 154, 172, 1);
    }

    .loginDialog_main_content form button {
        margin: 5px;
        width: 150px;
        height: 35px;
        float: right;
        color: #fff;
        outline: none;
        border: none;
        border-radius: 4px;
        transition: 0.2s;
    }
    .loginDialog_main_content form input {
        width: 100%;
        padding: 10px;
        height: 40px;
        margin: 10px;
        background: rgb(0, 0, 0, .6);
        color: #fff;
        border: none;
        outline: none;
        border-radius: 5px;
    }

    .loginDialog_main_content {
        float: left;
        width: 50%;
        padding: 30px
    }

    #loginDialog_overlay {
        background-color: rgb(0, 0, 0, .8);
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 2000;
        display: none;
    }

    #loginDialogbruh {
        position: fixed;
        z-index: 2001;
        top: 0;
        width: 85%;
        height: 70%;
        margin-left: auto;
        margin-right: auto;
        left: 50%;
        transform: translate(-50%, 0px);
        background-image: linear-gradient(to right, rgb(0, 0, 0, .9), rgb(0, 0, 0, .7), rgb(0, 0, 0, .0)), url(/login/background.jpg);
        background-position: center right;
        background-repeat: no-repeat;
        background-size: cover;
        display: none;
    }
    @keyframes open_login_dialog {
        0% {
            top:-70%;
            opacity: 0;
        }
        100% {
            top: 0;
            opacity: 1;
        }
    }
    @keyframes close_login_dialog {
        100% {
            top:-70%;
            opacity: 0;
        }
        0% {
            top: 0;
            opacity: 1;
        }
    }
    @media only screen and (max-width:855px) {
        #loginDialogbruh {
            width: 100%;
            background-image: linear-gradient(to right, rgb(0, 0, 0, .7), rgb(0, 0, 0, .7)), url(/login/background.jpg);
        }
        .loginDialog_main_content {
            width: 90%;
        }
    }
    @media only screen and (max-width:500px) {
        .loginDialog_main_content {
            padding: 15px;
        }
        .loginDialog_main_content form button {
            width: 95%;
            margin:3px
        }
    }
</style>