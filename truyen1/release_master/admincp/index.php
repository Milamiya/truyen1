<?php

session_start();
if (isset($_GET['dang-xuat'])) {
    setcookie('username', $username, time() + (-3600), "/", "zutafansub.tk");
    setcookie('password', md5($password), time() + (-3600), "/", "zutafansub.tk");
    setcookie('id', $row["id"], time() + (-3600), "/", "zutafansub.tk");
    session_start();
    unset($_SESSION["id"]);
    unset($_SESSION["username"]);
    unset($_SESSION["password"]);
    header("Location: /");
    exit();
}
if (isset($_SESSION['username']) == true or isset($_COOKIE['username']) == true) {
    $home = 1;
    include 'system/perm.php';
    include 'includes/header.php';
    $data = mysqli_query($conn, 'SELECT * FROM `video`');
    $load = mysqli_num_rows($data);

    $data1 = mysqli_query($conn, "SELECT SUM(view) FROM `video`");
    $loader = mysqli_fetch_row($data1);

    $allview = $loader[0];
    $data2 = mysqli_query($conn, 'SELECT * FROM `users`');
    $load2 = mysqli_num_rows($data2);
    $data3 = mysqli_query($conn, 'SELECT * FROM `movie`');
    $load3 = mysqli_num_rows($data3);


?>
    <!-- #END# Task Info -->
    <!-- Browser Usage -->
    <title><?php echo $titlecp; ?></title>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">remove_red_eye</i>
                        </div>
                        <div class="content">
                            <div class="text">TỔNG LƯỢT XEM</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $allview; ?>" data-speed="100" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">supervisor_account</i>
                        </div>
                        <div class="content">
                            <div class="text">NGƯỜI DÙNG</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $load2; ?>" data-speed="100" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">video_library</i>
                        </div>
                        <div class="content">
                            <div class="text">TỔNG SỐ VIDEO</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $load; ?>" data-speed="100" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">movie</i>
                        </div>
                        <div class="content">
                            <div class="text">TỔNG SỐ PHIM</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $load3; ?>" data-speed="100" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>CPU USAGE (%)</h2>
                                </div>
                                <div class="col-xs-12 col-sm-6 align-right">
                                    <div class="switch panel-switch-btn">
                                        <span class="m-r-10 font-12">REAL TIME</span>
                                        <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                                    </div>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="real_time_chart" class="dashboard-flot-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
            <div class="row clearfix">
                <!-- Visitors -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-pink">
                            <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff" data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)" data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)" data-fill-Color="rgba(0, 188, 212, 0)">
                                <b>TOP VIDEO</b>
                            </div>
                            <ul class="dashboard-stat-list">
                                <?php
                                $data_topvid = mysqli_query($conn, 'SELECT * FROM `video` ORDER BY view DESC LIMIT 5');
                                $top_vid_num = 1;
                                while ($topvid = mysqli_fetch_array($data_topvid) and $top_vid_num <= 5) { ?>
                                    <li style="width: 100%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                                        <?php echo $top_vid_num . ' - ' . $topvid['title'];
                                        $top_vid_num++ ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Visitors -->
                <!-- Latest Social Trends -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-cyan">
                            <div class="m-b--35 font-bold">PHIM GẦN ĐÂY</div>
                            <ul class="dashboard-stat-list">
                                <?php
                                $data_topmv = mysqli_query($conn, 'SELECT * FROM `movie` ORDER BY id DESC LIMIT 5');
                                $top_mv_num = 1;
                                while ($topmv = mysqli_fetch_array($data_topmv) and $top_mv_num <= 5) { ?>
                                    <li style="width: 100%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                                        <?php echo $top_mv_num . ' - ' . $topmv['name'];
                                        $top_mv_num++ ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Latest Social Trends -->
                <!-- Answered Tickets -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35">BÌNH LUẬN GẦN ĐÂY</div>
                            <ul class="dashboard-stat-list">
                                <?php
                                $data_topct = mysqli_query($conn, 'SELECT * FROM `comment` ORDER BY id DESC LIMIT 5');
                                $top_mv_cmt = 1;
                                while ($topct = mysqli_fetch_array($data_topct) and $top_mv_cmt <= 5) { ?>
                                    <li style="width: 100%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                                        <?php echo $top_mv_cmt . ' - ' . $topct['content'];
                                        $top_mv_cmt++ ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Answered Tickets -->
            </div>
    </section>
    <?php
    include 'includes/footer.php';
} else {
    include 'system/meta.php';
    if (isset($_GET['loguser']) == true && isset($_GET['logpass']) == true) {
        $usernam = $_GET['loguser'];
        $passwor = $_GET['logpass'];
        $password = filter_var($passwor, FILTER_SANITIZE_STRING);
        $username = filter_var($usernam, FILTER_SANITIZE_STRING);
        $selectfdb = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
        $row = mysqli_fetch_array($selectfdb);
        //nếu nhập đúng thì sẽ chạy xuống phần setcookie và echo dialog
        //nếu status = 0 thì sẽ tiếp tục, còn nếu =1 thì sẽ tạch
        if ($row["username"] == $username && $row["password"] == $password && $row["status"] == 0 && $row['admin'] == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['id'] = $row['id'];
            $datelog = date("Y-m-d H:i:s");
            $contentlog = "Logged in - by: " . $row['name'] . " - IP: " . $ipload;
            $byid = $row['id'];
            mysqli_query($conn, "INSERT INTO `log` (`content`, `date`, `by_id`) VALUES ('$contentlog', '$datelog', '$byid')");
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
                    if ($row["username"] == $username && $row["password"] == $password && $row["admin"] == 0 && $row['status'] == 0) {
                        echo "<b>Bạn không có quyền truy cập vào đây</b>";
                        echo "<meta http-equiv='refresh' content='0; url=https://fztfansub.tk'>";
                    } else {
                        echo "<b>Fatal Error:</b> Wrong password or username";
                        echo "<meta http-equiv='refresh' content='0; url=https://fztfansub.tk'>";
                    }
                }
            }
        }
    } else {
        //nếu nhấn nút login thì nó sẽ thực hiện code dưới...
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
                $errorform = "Fatal Error: Please fill blank";
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
                    if ($row["username"] == $username && $row["password"] == $password && $row["status"] == 0 && $row["admin"] == 1) {
                        setcookie('username', $username, time() + (10 * 365 * 24 * 60 * 60), "/", "zutafansub.tk");
                        setcookie('password', md5($password), time() + (10 * 365 * 24 * 60 * 60), "/", "zutafansub.tk");
                        setcookie('id', $row["id"], time() + (10 * 365 * 24 * 60 * 60), "/", "zutafansub.tk");
                        header("Location: /");
                        exit();
                        $datelog = date("Y-m-d h:i:s");
                        $contentlog = "Logged in - by: " . $row['name'] . " - IP: " . $ipload;
                        $byid = $row['id'];
                        mysqli_query($conn, "INSERT INTO `log` (`content`, `date`, `by_id`) VALUES ('$contentlog', '$datelog', '$byid')");
                    } else {
                        $errorform = "Sai tên tài khoản hoặc mật khẩu";
                    }
                    //nếu như tk bị disable
                    if ($row["status"] == 1) {
                        $errorform = "Tài khoản của bạn đã bị khóa";
                    }
                }
            }
        }
    ?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>admincp.zutafansub.tk | Login</title>
            <link rel="stylesheet" href="/login/login.css">
        </head>

        <body>
            <section class="Overlay" id="mainoverlay">
                <!---->
                <div class="Login Box">
                    <div class="Box__Header">
                        <h1 class="Box__Header__Heading">
                            Start FZTcp
                        </h1> <span class="Box__Header__Subheading">
                            Manage Zuta Fansub Website - Version v3.1.6-b25112020
                        </span>
                    </div>
                    <form id="LoginForm" action="" method="POST" class="Box__Form" data="[object Object]">
                        <!---->
                        <div class="Input" name="username" placeholder="Please enter username"><input type="text" name="username" placeholder="Please enter username" class="Input__Text">
                            <!---->
                        </div>
                        <div class="Input InputPassword" style="margin-top:30px" name="password" placeholder="Password" autocomplete="current-password"><input type="password" id="password" name="password" placeholder="Password" autocomplete="current-password" class="InputPassword__Input"> <a onclick="unhide()" class="Input__Icon hoverable"><svg version="1.1" viewBox="0 0 48 48" class="svg-icon svg-fill" style="width: 20px;">
                                    <path fill="#8db2be" stroke="none" pid="0" d="M24 8C11.056 8 0 24 0 24s11.048 16 24 16c12.944 0 24-16 24-16S36.952 8 24 8zm0 28c-7.469 0-15.137-7.324-19-12 3.853-4.678 11.502-12 19-12 7.469 0 15.137 7.324 19 12-3.853 4.678-11.502 12-19 12zm0-20a8 8 0 1 0 0 16 8 8 0 0 0 0-16zm0 12c-2.451 0-4-1.549-4-4s1.549-4 4-4 4 1.549 4 4-1.549 4-4 4z"></path>
                                </svg></a></div>
                        <!----> <button type="submit" name="loginbtn" autofocus="autofocus" class="Button"><span name="fade"><span>Sign in to Account</span></span></button>
                    </form>
                </div>
                <!--<div class="ForgotPasswordBlock"><span>Forgot Password?</span> <a href="<?php echo $fztcp_domain; ?>/quen-mat-khau" class="Link"><span>Click here</span></a></div>-->
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
            <script type="text/javascript" src="/login/login.js"></script>
        </body>

        </html>
<?php }
} ?>