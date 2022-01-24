<?php
    //nếu nhấn nút login thì nó sẽ thực hiện code dưới...
    if (isset($_POST["reg_signupbtn"])) {
        $reg_nam = $_POST['reg_name'];
        $reg_usernam = $_POST['reg_username'];
        $reg_passwor = $_POST['reg_password'];
        $reg_repasswor = $_POST['reg_repassword'];
        $reg_emai = $_POST['reg_email'];
        $reg_username = filter_var($reg_usernam, FILTER_SANITIZE_STRING);
        $reg_password = filter_var($reg_passwor, FILTER_SANITIZE_STRING);
        $reg_repassword = filter_var($reg_repasswor, FILTER_SANITIZE_STRING);
        $reg_name = filter_var($reg_nam, FILTER_SANITIZE_STRING);
        $reg_email = filter_var($reg_emai, FILTER_SANITIZE_STRING);
        
        $count_user = strlen($reg_username);
        $count_pass = strlen($reg_password);
        $count_name = strlen($reg_name);
        $pattern = '/^[a-z0-9]{6,20}$/';
        if (preg_match($pattern, $reg_username) == false) {
            $errorform_reg = "<p style='color:red;'><i>Username không được chứa các ký tự in hoa, ký tự đặc biệt hoặc khoảng cách</i></p>";
            echo "<script>window.onload = open_reg_dialog;</script>";
        } else {
        if ($count_user < 6 or $count_user > 20) {
            $errorform_reg = "<p style='color:red;'><i>Username phải lớn hơn 6 ký tự và nhỏ hơn 20 ký tự.</i></p>";
            echo "<script>window.onload = open_reg_dialog;</script>";
        } else {
            if ($count_pass < 6 or $count_pass > 20) {
                $errorform_reg = "<p style='color:red;'><i>Password phải lớn hơn 6 ký tự và nhỏ hơn 20 ký tự.</i></p>";
                echo "<script>window.onload = open_reg_dialog;</script>";
            } else {
                if ($count_name > 25) {
                    $errorform_reg = "<p style='color:red;'><i>Tên của bạn phải nhỏ hơn 25 ký tự.</i></p>";
                    echo "<script>window.onload = open_reg_dialog;</script>";
                } else {
                    if (empty($reg_username) || empty($reg_password) || empty($reg_username) || empty($reg_email)) {
                        $errorform_reg = "<p style='color:red;'><i>Vui lòng điền vào chỗ trống</i></p>";
                        echo "<script>window.onload = open_reg_dialog;</script>";
                    } else {
                        if ($reg_password == $reg_repassword) {
                            $sqlsec = mysqli_query($conn,"SELECT * FROM users WHERE `username` = '$reg_username'");
                            $loaddata = mysqli_fetch_array($sqlsec);
                            $sqlsec1 = mysqli_query($conn,"SELECT * FROM users WHERE `email` = '$reg_email'");
                            $loaddata1 = mysqli_fetch_array($sqlsec1);
                            if(isset($loaddata['username']) == true) {
                                $errorform_reg = '<p style="color:red;"><i>Tên tài khoản này đã tồn tại</i></p>';
                                echo "<script>window.onload = open_reg_dialog;</script>";
                            } 
                            if(isset($loaddata1['email']) == true) {
                            $errorform_reg = '<p style="color:red;"><i>Email này đã tồn tại</i></p>';
                            echo "<script>window.onload = open_reg_dialog;</script>";
                         }
                            else {
                                if(strpos($reg_email, "@gmail.com") !== false or strpos($reg_email, "@yahoo.com") !== false or strpos($reg_email, "@outlook.com") !== false) {
                            	if ( isset( $_POST['g-recaptcha-response'] ) && ! empty( $_POST['g-recaptcha-response'] ) ) {
                            		//your site secret key
                            		$secret = '6LfSJeMZAAAAAAxJ0jA19b_254GudrAoaBeQ5-Gt';
                            		//get verify response data
                            		$verifyResponse = file_get_contents( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response'] );
                            		$responseData   = json_decode( $verifyResponse );
                            		if ( $responseData->success ) {
                                        $join = date("Y-m-d");
                                        $selectfdb = mysqli_query($conn,"INSERT INTO `users` (`username`, `password`, `name`, `email`, `created`) VALUES ('$reg_username', '$reg_password', '$reg_name', '$reg_email', '$join')");
                                        $row = mysqli_fetch_array($selectfdb);
                                        $errorform_login = "<b>Note:</b> Tạo tài khoản thành công";
                                        echo "<script>window.onload = open_login_dialog;</script>";
                                } } else {
                                    $errorform_reg = '<p style="color:red;"><i>Vui lòng xác thực reCAPTCHA</i></p>';
                                    echo "<script>window.onload = open_reg_dialog;</script>";
                                } } else {
                                    $errorform_reg = '<p style="color:red;"><i>Email này không hỗ trợ</i></p>'; 
                                    echo "<script>window.onload = open_reg_dialog;</script>";
                                } }
                        } else {
                            $errorform_reg = '<p style="color:red;"><i>Mật khẩu không trùng khớp</i></p>';
                            echo "<script>window.onload = open_reg_dialog;</script>";
                        }
                    } } } } } }
?>
<div id="regDialog_overlay" onclick="close_reg_dialog()"></div>
<div id="regDialogbruh">
    <div class="regDialog_times"><a onclick="close_reg_dialog()">&times</a></div>
    <div class="regDialog_main_content">
        <h2>Tạo tài khoản</h2>
        <p style="font-size: 12px;">tạo tài khoản xong rồi hẵng đăng nhập nhé hihi :>></p>
        <span style="font-size:15px;padding:2px"><?php if(isset($errorform_reg)) {echo $errorform_reg;} ?></span>
        <form style="padding-top: 10px;" action="/" method="POST" autocomplete="off">
            <input type="text" name="reg_name" placeholder="tên của bạn" required autocomplete="false" minlength="3" maxlength="25">
            <input type="text" name="reg_username" placeholder="tên đăng nhập" required autocomplete="false" minlength="6" maxlength="25">
            <input type="email" name="reg_email" placeholder="email" required autocomplete="false">
            <a style="display: block;font-size:8px">email rất quan trọng để bạn có thể lấy lại mật khẩu</a>
            <input type="password" name="reg_password" placeholder="mật khẩu" required autocomplete="false" minlength="6" maxlength="25">
            <input type="password" name="reg_repassword" placeholder="nhập lại mật khẩu" required autocomplete="false" minlength="6" maxlength="25">
            <div class="regDialog_checkcaptcha">
                <div id="rcload" class="g-recaptcha" data-sitekey="6LfSJeMZAAAAAIHVg9gNCKecyf3As-C2vlIyowid"></div>
            </div>
            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" name="reg_signupbtn">đăng ký</button>
        </form>
    </div>
</div>
<style>
    #regDialogbruh .regDialog_times {
        float: right;
        width: fit-content;
        padding: 10px;
        margin-top: 0%;
        font-size: 50px;
        cursor: pointer;
    }
    
    .regDialog_main_content form span {
        font-size: 12px !important;
        padding: 10px;
        float: left;
    }
    
    .regDialog_main_content form span a {
        color: rgba(25, 154, 172, 1);
    }
    
    .regDialog_main_content form button {
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
    
    
    .regDialog_main_content form input {
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
    
    .regDialog_main_content {
        float: left;
        width: 50%;
        padding: 30px
    }
    
    #regDialog_overlay {
        background-color: rgb(0, 0, 0, .8);
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 2000;
        display: none;
    }
    
    #regDialogbruh {
        position: fixed;
        z-index: 2001;
        top: 0;
        width: 85%;
        height: 90%;
        margin-left: auto;
        margin-right: auto;
        left: 50%;
        transform: translate(-50%, 0px);
        background-image: linear-gradient(to right, rgb(0, 0, 0, .9), rgb(0, 0, 0, .7), rgb(0, 0, 0, .0)), url(/login/bg2.jpg);
        background-position: center right;
        background-repeat: no-repeat;
        background-size: cover;
        display: none;
    }
    
    @keyframes open_reg_dialog {
        0% {
            top: -90%;
            opacity: 0;
        }
        100% {
            top: 0;
            opacity: 1;
        }
    }
    
    @keyframes close_reg_dialog {
        100% {
            top: -90%;
            opacity: 0;
        }
        0% {
            top: 0;
            opacity: 1;
        }
    }
    
    @media only screen and (max-width:855px) {
        #regDialogbruh {
            width: 100%;
            height: 100%;
            background-image: linear-gradient(to right, rgb(0, 0, 0, .7), rgb(0, 0, 0, .7)), url(/login/bg2.jpg);
        }
        .regDialog_main_content {
            width: 90%;
        }
    }
    
    @media only screen and (max-width:500px) {
        .regDialog_main_content {
            padding: 15px;
        }
        .regDialog_main_content form button {
            width: 95%;
            margin: 3px
        }
    }
</style>