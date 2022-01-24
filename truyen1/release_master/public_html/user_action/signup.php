<?php
//disabe 3 cái thằng thông báo lằng nha lằng nhằng của php
error_reporting(0);
session_start();
    //lấy thông tin kết nối tới db
    include '../system/meta.php';
    if(isset($_COOKIE['username']) == true or $_SESSION['username'] == true) {
        header("Location: /");
        exit();
    }
    //nếu nhấn nút login thì nó sẽ thực hiện code dưới...
    if (isset($_POST["signupbtn"])) {
        $nam = $_POST['name'];
        $usernam = $_POST['username'];
        $passwor = $_POST['password'];
        $repasswor = $_POST['repassword'];
        $emai = $_POST['email'];
        
        $username = filter_var($usernam, FILTER_SANITIZE_STRING);
        $password = filter_var($passwor, FILTER_SANITIZE_STRING);
        $repassword = filter_var($repasswor, FILTER_SANITIZE_STRING);
        $name = filter_var($nam, FILTER_SANITIZE_STRING);
        $email = filter_var($emai, FILTER_SANITIZE_STRING);
        
        $count_user = strlen($username);
        $count_pass = strlen($password);
        $count_name = strlen($name);
        $pattern = '/^[a-z0-9]{6,20}$/';
        if (preg_match($pattern, $username) == false) {
            $errorform = "<p style='color:red;'><i>Username không được chứa các ký tự in hoa, ký tự đặc biệt hoặc khoảng cách</i></p>";
        } else {
        if ($count_user < 6 or $count_user > 20) {
            $errorform = "<p style='color:red;'><i>Username phải lớn hơn 6 ký tự và nhỏ hơn 20 ký tự.</i></p>";
        } else {
            if ($count_pass < 6 or $count_pass > 20) {
                $errorform = "<p style='color:red;'><i>Password phải lớn hơn 6 ký tự và nhỏ hơn 20 ký tự.</i></p>";
            } else {
                if ($count_name > 25) {
                    $errorform = "<p style='color:red;'><i>Tên của bạn phải nhỏ hơn 25 ký tự.</i></p>";
                } else {
                    if (empty($username) || empty($password) || empty($username) || empty($email)) {
                        $errorform = "<p style='color:red;'><i>Vui lòng điền vào chỗ trống</i></p>";
                    } else {
                        if ($password == $repassword) {
                            $sqlsec = mysqli_query($conn,"SELECT * FROM users WHERE `username` = '$username'");
                            $loaddata = mysqli_fetch_array($sqlsec);
                            $sqlsec1 = mysqli_query($conn,"SELECT * FROM users WHERE `email` = '$email'");
                            $loaddata1 = mysqli_fetch_array($sqlsec1);
                            if(isset($loaddata['username']) == true) {
                                $errorform = '<p style="color:red;"><i>Tên tài khoản này đã tồn tại</i></p>';
                            } 
                            if(isset($loaddata1['email']) == true) {
                            $errorform = '<p style="color:red;"><i>Email này đã tồn tại</i></p>'; }
                            else {
                                if(strpos($email, "@gmail.com") !== false or strpos($email, "@yahoo.com") !== false or strpos($email, "@outlook.com") !== false) {
                            	if ( isset( $_POST['g-recaptcha-response'] ) && ! empty( $_POST['g-recaptcha-response'] ) ) {
                            		//your site secret key
                            		$secret = '6LfSJeMZAAAAAAxJ0jA19b_254GudrAoaBeQ5-Gt';
                            		//get verify response data
                            		$verifyResponse = file_get_contents( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response'] );
                            		$responseData   = json_decode( $verifyResponse );
                            		if ( $responseData->success ) {
                                        $join = date("Y-m-d");
                                        $selectfdb = mysqli_query($conn,"INSERT INTO `users` (`username`, `password`, `name`, `email`, `created`) VALUES ('$username', '$password', '$name', '$email', '$join')");
                                        $row = mysqli_fetch_array($selectfdb);
                                        $errorform = "<b>Note:</b> Tạo tài khoản thành công";
                                        echo "<meta http-equiv='refresh' content='0; url=/dang-nhap'>";
                                } } else {
                                    $errorform = '<p style="color:red;"><i>Vui lòng xác thực reCAPTCHA</i></p>';
                                } } else {
                                    $errorform = '<p style="color:red;"><i>Email này không hỗ trợ</i></p>'; 
                                } }
                        } else {
                            $errorform = '<p style="color:red;"><i>Mật khẩu không trùng khớp</i></p>';
                        }
                    } } } } } }
?>
<!DOCTYPE html>
<html lang="vi" dir="ltr">
  <head>
    <link id="light" rel="stylesheet" href="/css/login/light.css">
    <link id="dark" rel="stylesheet" href="/css/login/dark.css">
    <script src="https://www.google.com/recaptcha/api.js?hl=vi"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo tài khoản - <?php echo $titlehead;?></title>
  </head>
  <body>
    <div class="wrapper">
      <div class="title">
Tạo tài khoản<a style="font-size: 10px;padding-left: 10px">Zutafansub</a></div>
<form action="" method="POST">
  <div class="dialog" style="text-align: center;">
 <?php if(isset($errorform) == true){echo $errorform;}?>
  </div>
    <div class="field">
        <input type="text" name="name" required="">
        <label>Tên của bạn</label>
    </div>
    <div class="field">
        <input name="username" type="text" required>
        <label>Tên tài khoản</label>
    </div>
    <div class="field">
        <input name="email" type="email" required>
        <label>Email</label>
    </div>
    <div class="field">
        <input name="password" type="password" required>
        <label>Mật khẩu</label>
    </div>
    <div class="field">
            <input name="repassword" type="password" required>
            <label>Nhập lại mật khẩu</label>
          </div>
<div style="padding-top:20px">
<input type="checkbox" name="privacy"/>
<lable>Tôi đã đọc <a href="https://zutafansub.tk/dieu-khoan-su-dung/">điều khoản sử dụng</a></lable> </div>
        <div class="checkcaptcha" style="padding-top: 40px;padding-bottom:60px;text-align:center;height: 74px;width: 300px;margin-left:auto;margin-right:auto">
            <div id="rcload" class="g-recaptcha" data-sitekey="6LfSJeMZAAAAAIHVg9gNCKecyf3As-C2vlIyowid"></div>
        </div>
          <div class="field">
          <input name="signupbtn" type="submit" value="Tạo tài khoản">
        </div>
        <div class="login" id="logname" style="margin-top:20px">
             Bạn đã có tài khoản? <a href="/dang-nhap">Đăng nhập ngay</a>
            </div>
            <div class="footer" style="bottom:0;font-size:10px;text-align:center;padding-top:10px">
    Form login by Vodang Phuquy - Dark theme login by Nguyen Anh Duc<br>
    &copy 2020 Zuta Fansub- Developed by Nguyen Anh Duc
</div>
            </form>
            </div>
</div>
    <script type="text/javascript">
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches){
          document.getElementById("light").remove();
          document.getElementById("lg").remove();
            document.getElementById("rcload").setAttribute("data-theme", "dark");
            document.getElementById("logname").style.color = "#fff";
            document.body.style.color = "#fff";
    } else {
        document.getElementById("dark").remove();
        document.getElementById("lk").remove();
    }
    </script>
</body>
</html>
