<?php
if(isset($_COOKIE['username']) == true or $_SESSION['username'] == true) {
    header("Location: /");
    exit();
}
include '../system/perm.php';
echo '<title>Lấy lại mật khẩu - '.$titlehead.'</title>';
if(isset($_POST['btnsubmit'])) {
    $emailc = $_POST['emailc'];
    $secdb001 = mysqli_query($conn, "SELECT * FROM users WHERE `email` = '$emailc'");
    $secrow = mysqli_fetch_array($secdb001);
    if($secrow['username'] == null) {
        $log = "Địa chỉ email này không khớp với bất kỳ tài khoản nào";
    } else {
        $codeaaa = '0123456789';
        $coderan = substr(str_shuffle($codeaaa), 0, 15);
        $name = $secrow['name'];
        $emailcontent = '
        <div class="main" style="font-family: Arial;margin:0px">
        	<a href="https://fztfansub.tk">
        	<img src="https://fztfansub.tk/assets/images/6102020/logo-w.png" width="200px">
        </a>
        	<br>
        	<p>Xin chào bạn <b>'.$name.'</b>
        	<p>Đây chính là thư lấy lại mật khẩu tài khoản Zuta Fansub</p>
        	<p>Mã xác nhận</p>
        	<h3> '.$coderan.'</h3>
        	<p>Bạn nhận được email này vì gần đây bạn đã yêu cầu lấy lại tài khoản FZT Fansub của bạn. Nếu bạn không làm điều này, vui lòng liên hệ với chúng mình hoặc bỏ qua thư này.</p>
        	<p>Địa chỉ IP: '.$ipload.'</p>
        	<hr>
        	<p>Trân trọng!</p>
        	<p>Đội ngũ Zuta Fansub</p>
        	<p>© 2020 Zuta Fansub - Developed by Nguyen Anh Duc</p>
        </div>
        ';
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $clientidv = substr(str_shuffle($permitted_chars), 0, 50);
            $headers = "MIME-Version: 1.0" . "\r\n";
            $fid = $secrow['id'];
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            mail($emailc,"Lấy lại mật khẩu tài khoản FZT Fansub",$emailcontent,$headers);
            $date = date("Y-m-d h:i:s");
            mysqli_query($conn, "INSERT INTO `forgot_pass` (`client_id`, `code`, `for_id`, `request_date`, `request_email`) VALUES ('$clientidv', '$coderan', '$fid', '$date', '$emailc')");
            echo '<meta http-equiv="refresh" content="0, url=/quen-mat-khau/?client_id='.$clientidv.'">';
    }
}
    $clifor = $_GET['client_id'];
    $secdb002 = mysqli_query($conn, "SELECT * FROM forgot_pass WHERE `client_id` = '$clifor' ");
    $secrow1 = mysqli_fetch_array($secdb002);
if(isset($_GET['client_id'])) {
    if($secrow1['client_id'] == null) {
        header("Location: /quen-mat-khau");
        exit;
    } else {
        if(isset($_POST['btnsubmit1'])) {
            $codev = $_POST['codev'];
            $clientidv1 = $secrow1['client_id'];
            if($codev = $secrow1['code']) {
                mysqli_query($conn, "UPDATE `forgot_pass` SET `accept` = '1' WHERE `forgot_pass`.`client_id` = '$clifor'");
            echo '<meta http-equiv="refresh" content="0, url=/quen-mat-khau/?client_id='.$clientidv1.'">';
            } else {
                $log = "Mã xác nhận không đúng!";
            }
        }
    }
}
if($secrow1['accept'] == 1) {
            if(isset($_POST['btnsubmit2'])) {
                $pass1 = $_POST['pass1'];
                $pass2 = $_POST['pass2'];
                filter_var($pass1, FILTER_SANITIZE_STRING);
                filter_var($pass2, FILTER_SANITIZE_STRING);
                $count_pass = strlen($pass1);
                if ($count_pass < 6 or $count_pass > 20) {
                    $log = "Password phải lớn hơn 6 ký tự và nhỏ hơn 20 ký tự.";
                } else {
                    if($pass1 = $pass2) {
                        $usrid1 = $secrow1 ['for_id'];
                        mysqli_query($conn, "UPDATE `users` SET `password` = '$pass1' WHERE `users`.`id` = '$usrid1'");
                        mysqli_query($conn, "DELETE FROM `forgot_pass` WHERE `forgot_pass`.`for_id` = '$usrid1';");
                        $log = "Đã thay mật khẩu, vui lòng đăng nhập";
                        echo '<meta http-equiv="refresh" content="0, url=/dang-nhap">';
                    } else {
                        $log = "Mật khẩu không trùng khớp";
                    }
                }
            }
        }
include '../includes/header.php';
if($data1['username'] == null) {} else {
    echo '<meta http-equiv="refresh" content="0, url=/">';
}
include '../includes/footer.php';
?>
<style>
    .mainsp {
        padding-top:80px;
        font-family:Quicksand;
    }
    .supportbg {
    background-image: linear-gradient(to right top,rgb(0,0,0,.9),rgb(0,0,0,.0)), url(/image.jpg);
    background-position: center center;
    background-size: cover;
    height: 280px;
    width: 100%;
    position: absolute;
    }
    .titlesp {
        position:absolute;
        padding:20px;
        color:#fff;
        text-shadow: 0 1px 3px rgba(0,0,0,.75);
    }
    .mainctsp {
        margin-top: 290px;
        padding:20px;
        width:75%;
        margin-left:auto;
        margin-right:auto;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58,59,69,.15);
        margin-bottom:20px;
    }
    @media only screen and (max-width:600px) {
        .mainctsp {
            width:90%;
            box-shadow: none;
        margin-left:0;
        margin-right:0;
        }
    }
    .btnfeed {
        width:80%;
        height:40px;
        background: linear-gradient(-135deg, #c850c0, #4158d0);
        transition:0.3s;
        border:none;
        border-radius:3px;
        outline:none;
        color:#fff;
        margin-top:10px;
    }
    #vip {
        width:300px;
        height:30px;
        text-align:center;
        background-color:rgb(200,200,200,.6);
        color:#fff;
        border:none;
        border-radius: 5px;
        
    }
    #bip {
        width:170px;
        height:30px;
        border:none;
        border-radius:3px;
        margin-top:5px;
        background-color:rgb(200,200,200,.6);
    }
</style>
<div class="mainsp">
    <div class="supportbg"></div>
    <div class="titlesp">
        <h1>lấy lại mật khẩu</h1>
        <h3>bạn quên pass rồi ư?!</h3>
    </div>
    <div class="mainctsp">
        <h2>Lấy lại mật khẩu</h2>
        <a style="font-size:13px">Bạn vui lòng nhập địa chỉ Email của bạn (địa chỉ email mà bạn sử dụng để tạo tài khoản Zutafansub)</a><br>
        <div id="challenge1">
            <form action="" method="POST" style="text-align:center;padding-top:20px;padding-bottom:20px">
                <h3>Địa chỉ email của bạn</h3>
                <input id="vip" type="email" name="emailc" required=""><br>
                <button type="submit" name="btnsubmit" id="bip">Submit</button>
                <p><?php if(isset($log) == true) { echo $log;} ?></p>
            </form>
        </div>
        <?php if(isset($_GET['client_id']) == true) { ?>
        <style>
            #challenge1 {
                display:none;
            }
        </style>
        <div id="challenge2">
            <form action="" method="POST" style="text-align:center;padding-top:20px;padding-bottom:20px">
                <h3>Mã xác nhận</h3>
                <p style="font-size:12px">mã xác nhận đã được gửi vào email <?php echo $secrow1['request_email'];?></p>
                <input id="vip" type="number" name="codev" required=""><br>
                <button type="submit" name="btnsubmit1" id="bip">Submit</button>
                <p><?php if(isset($log) == true) { echo $log;} ?></p>
            </form>
            <div style="bottom:0; font-size:10px;text-align:center">
                <a>your client_id: <?php echo $_GET['client_id'];?></a>
            </div>
        </div>
        <?php } if($secrow1['accept'] == 1) { ?>
        <style>
            #challenge1, #challenge2 {
                display:none;
            }
        </style>
        <div id="challenge3">
            <form action="" method="POST" style="text-align:center;padding-top:20px;padding-bottom:20px">
                <h3>Nhập mật khẩu</h3>
                <input id="vip" style="margin-bottom:5px" type="password" name="pass1" placeholder="mật khẩu mới" required=""><br>
                <input id="vip" type="password" name="pass2" placeholder="nhập lại mật khẩu" required=""><br>
                <button type="submit" name="btnsubmit2" id="bip">OK</button>
                <p><?php if(isset($log) == true) { echo $log;} ?></p>
            </form>
            <div style="bottom:0; font-size:10px;text-align:center">
                <a>your client_id: <?php echo $_GET['client_id'];?></a>
            </div>
        </div>
        <?php } ?>
        </div>
    </div>
</div>