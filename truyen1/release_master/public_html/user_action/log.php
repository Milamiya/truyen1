<?php
//disabe 3 cái thằng thông báo lằng nha lằng nhằng của php
error_reporting(0);
session_start();
//lấy thông tin kết nối tới db
include '../system/meta.php';
if (isset($_GET['loguser']) == true && isset($_GET['logpass']) == true && $_GET['adminlogin'] == 1) {
    $usernam = $_GET['loguser'];
    $passwor = $_GET['logpass'];
    $password = filter_var($passwor, FILTER_SANITIZE_STRING);
    $username = filter_var($usernam, FILTER_SANITIZE_STRING);
    $selectfdb = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    $row = mysqli_fetch_array($selectfdb);
    //nếu nhập đúng thì sẽ chạy xuống phần setcookie và echo dialog
    //nếu status = 0 thì sẽ tiếp tục, còn nếu =1 thì sẽ tạch
    if ($row["username"] == $username && $row["password"] == $password && $row["status"] == 0) {
        setcookie('username', 'unload', time() + (-3600), '/', 'zutafansub.tk');
        setcookie('password', 'unload', time() + (-3600), '/', 'zutafansub.tk');
        setcookie('id', 'unload', time() + (-3600), '/', 'zutafansub.tk');
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
            /*if ($row["username"] == $username && $row["password"] == $password && $row["status"] == 1 && $row['admin'] == 0) {
                echo "<b>Fatal Error:</b> Tài khoản của bạn đã bị khóa";
                echo "<meta http-equiv='refresh' content='0; url=https://fztfansub.tk'>";
            } else {*/
                echo "<b>Fatal Error:</b> Wrong password or username";
                echo "<meta http-equiv='refresh' content='0; url=https://fztfansub.tk'>";
           // }
        }
    }
} else {
    if (isset($_COOKIE['username']) == true or $_SESSION['username'] == true) {
        header("Location: /");
        exit();
    }
    if (isset($_GET['v'])) {
        $errorform = "Đăng nhập để tiếp tục!";
        $linkload = "<meta http-equiv='refresh' content='0; url=/xem-video/?v=" . $_GET['v'] . "'>";
        $loadv = $_GET['v'];
        $secdbvidi4 = mysqli_query($conn, "SELECT * FROM video WHERE `code` = '$loadv'");
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
            if ($username == "demouser" && $password == "demouser") {
                $errorform = "<p style='color:red'><i>Lỗi không xác định</i></p>";
            } else {
                $selectfdb = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
                $row = mysqli_fetch_array($selectfdb);
                //nếu nhập đúng thì sẽ chạy xuống phần setcookie và echo dialog
                //nếu status = 0 thì sẽ tiếp tục, còn nếu =1 thì sẽ tạch
                if ($row["username"] == $username && $row["password"] == $password) {
                    //if (isset($_POST['savepass'])) {
                        setcookie('username', $username, time() + (10 * 365 * 24 * 60 * 60), "/", 'zutafansub.tk');
                        setcookie('password', md5($password), time() + (10 * 365 * 24 * 60 * 60), "/", 'zutafansub.tk');
                        setcookie('id', $row["id"], time() + (10 * 365 * 24 * 60 * 60), "/", 'zutafansub.tk');
                        $errorform = "<p style='color:green'>Đăng nhập thành công! - Đã lưu mật khẩu</p>";
                        header("Location: /");
                        exit();
                    /*} else {
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $password;
                        $_SESSION['id'] = $row['id'];
                        $errorform = "<p style='color:green'>Đăng nhập thành công!</p>";
                        echo $linkload;
                    }*/
                } else {
                    $errorform = "<p style='color:red'><i>Sai tên tài khoản hoặc mật khẩu</i></p>";
                }
                /*nếu như tk bị disable
                if ($row["status"] == 1) {
                    $errorform = "<p style='color:red'><i>Tài khoản của bạn đã bị khóa</i></p>";
                }*/
            }
        }
    }
?>

<!DOCTYPE html>
        <html>

        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Zuta Fansub | Login</title>
            <link rel="stylesheet" href="/login/login.css">
        </head>

        <body>
            <section class="Overlay" id="mainoverlay">
                <!---->
                <div class="Login Box">
                    <div class="Box__Header">
                        <h1 class="Box__Header__Heading">
                            Đăng nhập vào Zuta Fansub
                        </h1> <span class="Box__Header__Subheading">
                            Đăng nhập để trải nghiệm tất cả tính năng trong Zuta Fansub Website :3
                        </span>
                    </div>
                    <form id="LoginForm" action="" method="POST" class="Box__Form" data="[object Object]">
                        <!---->
                        <div class="Input" name="username" placeholder="Please enter username"><input type="text" name="username" placeholder="Tên đăng nhập" class="Input__Text">
                            <!---->
                        </div>
                        <div class="Input InputPassword" style="margin-top:30px" name="password" placeholder="Mật khẩu" autocomplete="current-password"><input type="password" id="password" name="password" placeholder="Password" autocomplete="current-password" class="InputPassword__Input"> <a onclick="unhide()" class="Input__Icon hoverable"><svg version="1.1" viewBox="0 0 48 48" class="svg-icon svg-fill" style="width: 20px;">
                                    <path fill="#8db2be" stroke="none" pid="0" d="M24 8C11.056 8 0 24 0 24s11.048 16 24 16c12.944 0 24-16 24-16S36.952 8 24 8zm0 28c-7.469 0-15.137-7.324-19-12 3.853-4.678 11.502-12 19-12 7.469 0 15.137 7.324 19 12-3.853 4.678-11.502 12-19 12zm0-20a8 8 0 1 0 0 16 8 8 0 0 0 0-16zm0 12c-2.451 0-4-1.549-4-4s1.549-4 4-4 4 1.549 4 4-1.549 4-4 4z"></path>
                                </svg></a></div>
                        <!----> <button type="submit" name="loginbtn" autofocus="autofocus" class="Button"><span name="fade"><span>Đăng nhập</span></span></button>
                    </form>
                </div>
                <div class="ForgotPasswordBlock" style="text-align: center;">
                <span>Bạn chưa có tài khoản? hmm <a href="<?php echo $url_main_web; ?>/tao-tai-khoan" class="Link"><span>Nhấn vào đây nhé!</span></a><br>
                <span>Bạn quên mật khẩu rồi ư :((?</span> <a href="<?php echo $url_main_web; ?>/quen-mat-khau" class="Link"><span>Cũng nhấn vào đây lun :))!</span></a></div>
                <div class="Spacer"></div>
                <!---->
                <div class="DateTimeBlock" id="DateTimeBlock"></div>
            </section>
            <script>
                window.onload = function startTime() {
                    var today = new Date();
                    var dd = today.getDate();
                    var mm = today.getMonth();
                    var yy = today.getFullYear();
                    var hh = today.getHours();
                    var mmm = today.getMinutes();
                    var sss = today.getSeconds();
                    mmm = checkTime(mmm);
                    sss = checkTime(sss);
                    document.getElementById("DateTimeBlock").innerHTML = mm + 1 + "/" + dd + "/" + yy + ", " + hh + ":" + mmm + ":" + sss;
                    var t = setTimeout(startTime, 500);
                    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        document.getElementById("mainoverlay").setAttribute("class", "Overlay --dark");
                    } else {
                        document.getElementById("mainoverlay").setAttribute("class", "Overlay");
                    }
                }

                function checkTime(i) {
                    if (i < 10) {
                        i = "0" + i
                    }; // add zero in front of numbers < 10
                    return i;
                }

                function unhide() {
                    var x = document.getElementById("password");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }
            </script>
        </body>

        </html>
<?php } ?>