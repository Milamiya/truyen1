<?php
if (isset($_SESSION['id']) == true) {
    $usrid = $_SESSION['id'];
} else {
    $usrid = $_COOKIE['id'];
}
$dbs = mysqli_query($conn, "SELECT * FROM users WHERE `id` = '$usrid'");
$data1 = mysqli_fetch_array($dbs);
$lo11 = $data1;
//   AVATAR CONFIG
if (empty($data1['avt'])) {
    $avatar = "https://redpervn.ga/assets/user.jpg";
} else {
    $avatar = $data1['avt'];
}
// END AVATAR CONFIG
function custom_echo($x, $length)
{
    if (strlen($x) <= $length) {
        echo $x;
    } else {
        $y = substr($x, 0, $length) . '...';
        echo $y;
    }
}
if (isset($_POST['btnautof5'])) {
    if (isset($_COOKIE['autorefresh']) == false) {
        setcookie("autorefresh", "nope", time() + (10 * 365 * 24 * 60 * 60));
        echo '<meta http-equiv="refresh" content="0, url=/">';
    } else {
        setcookie('autorefresh', 'nope', time() + (-3600));
        echo '<meta http-equiv="refresh" content="0, url=/">';
    }
}
$secdbsetting = mysqli_query($conn, "SELECT * FROM setting WHERE `id` = '1'");
$loadset = mysqli_fetch_array($secdbsetting);
$query_usr_notify = mysqli_query($conn, "SELECT * FROM notify WHERE `for_id` = '$usrid' ORDER BY id DESC");
if (isset($_POST['darkmode'])) {
    if (isset($_COOKIE['darkmode']) == false) {
        setcookie("darkmode", "good a day", time() + (10 * 365 * 24 * 60 * 60), "/");
        echo "<script>window.location.href=''</script>";
    } else {
        setcookie("darkmode", "good a day", time() + (-3600), "/");
        echo "<script>window.location.href=''</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono" rel="stylesheet">
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap Core Css -->
    <link href="/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="/css/themes/all-themes.css" rel="stylesheet" />
    <?php
    if (isset($_COOKIE['darkmode'])) { ?>
        <link rel="stylesheet" href="/css/dark_u.css">
    <?php } ?>
    <link rel="stylesheet" href="/css/dark.css">
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="/plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <!-- Light Gallery Plugin Css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.10.0/css/lightgallery.css" rel="stylesheet">
    <!-- FZTcp CSS -->
    <link href="/css/fztcp.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $fztcp_domain;?>/css/keyframes.css">
</head>
<body class="theme-red">
    <!-- Page Loader
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
</div>
    <!-- #END# Page Loader -->
    <?php if(isset($_COOKIE['fztcpwelcome']) == false) {
            setcookie(
                "fztcpwelcome",
                "new",
                time() + (24*3600)
              );
            ?>
    <div id="fztcp_overlay"></div>
    <div id="fztcp_welcome">
        <button id="reloader" onclick="reloadimg()" class="fztcp_sbutton"><span class="material-icons">loop</span></button>
        <img id="imgGIF" src="/assets/welcome.gif" width="100%">
        <div class="main_welcome">
        <h3>Welcome to new FZTcp :))</h3>
        <p>Đỡ thô + Dễ dàng tiếp cận :)))</p>
        <button type="button" onclick="closewel()" class="btn btn-primary m-t-15 waves-effect">GETTING START</button>
        <p style="font-size: 10px; position:absolute;bottom:0"><?php echo $fztcp_version;?></p>
        </div>
    </div>
    <script>
        function reloadimg() {
            document.getElementById("imgGIF").setAttribute("src", "/assets/welcome.gif");
        }
        function closewel() {
            document.getElementById("fztcp_overlay").style.animation = "fadecl 0.5s";
            document.getElementById("fztcp_welcome").style.animation = "fadecl 0.5s";
            setTimeout(
                function() {
                    document.getElementById("fztcp_overlay").style.display = "none";
            document.getElementById("fztcp_welcome").style.display = "none";
                },480
            )
        }
    </script>
    <?php } ?>
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar <?php if(isset($_GET['q'])) {echo "open";}?>">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <?php if(isset($user)) {?>
        <form action="/user" class="fetch_results">
            <input type="text" name="q" value="<?php if(isset($_GET['q'])) {echo $_GET['q'];}?>" placeholder="TYPE USER NAME/ID HERE">
        </form>
        <?php } elseif(isset($movie)) {?>
        <form action="/phim" class="fetch_results">
            <input type="text" name="q" value="<?php if(isset($_GET['q'])) {echo $_GET['q'];}?>" placeholder="TYPE MOVIE NAME/ID HERE">
        </form>
        <?php } else { ?>
        <form action="/video" class="fetch_results">
            <input type="text" name="q" value="<?php if(isset($_GET['q'])) {echo $_GET['q'];}?>" placeholder="TYPE VIDEO NAME/ID HERE">
        </form>
        <?php } ?>
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="/" style="font-family:Roboto Mono !important">ZUTA FANSUB | ADMINCP</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count"><?php echo mysqli_num_rows($query_usr_notify); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                <?php while ($sysnof = mysqli_fetch_array($query_usr_notify)) { ?>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons"><?php if ($sysnof['type'] == 1) {
                                        echo 'warning';
                                    } elseif ($sysnof['type'] == 2) {
                                        echo 'error_outline';
                                    } elseif ($sysnof['type'] == 3) {
                                        echo 'new_releases';
                                    } else {
                                        echo 'notifications_none';
                                    } ?></i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><?php echo $sysnof['title']; ?></h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> <?php echo $sysnof['date']; ?>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                                    <li class="footer">
                                        <a href="/notify/me">View All Notifications</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?php echo $avatar; ?>" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $data1['name']; ?></div>
                    <div class="email">id: <?php echo $data1['id']; ?> / username: <?php echo $data1['username']; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?php echo $fztcp_domain; ?>/nguoi-dung/zid/<?php echo $data1['id']; ?>"><i class="material-icons">person</i>Trang cá nhân</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo $fztcp_domain; ?>/cai-dat"><i class="material-icons">group</i>Cài đặt tài khoản</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/?dang-xuat"><i class="material-icons">input</i>Đăng xuất</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <style>
                .sidebar .user-info {
                    background-image: linear-gradient(to right top, rgb(0, 0, 0, .5), rgb(0, 0, 0, .5)), url(<?php echo $data1['cover']; ?>);
                    background-position: center center;
                    background-size: cover;
                }
            </style>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU</li>
                    <li <?php if (isset($home)) {
                            echo 'class="active"';
                        } ?>>
                        <a href="/">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li <?php if (isset($setting)) {
                            echo 'class="active"';
                        } ?>>
                        <a href="/cai-dat">
                            <i class="material-icons">settings</i>
                            <span>Cài đặt</span>
                        </a>
                    </li>
                    <li <?php if (isset($user)) {
                            echo 'class="active"';
                        } ?>>
                        <a href="/user">
                            <i class="material-icons">supervisor_account</i>
                            <span>Quản lý người dùng</span>
                        </a>
                    </li>
                    <li <?php if (isset($video)) {
                            echo 'class="active"';
                        } ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">movie</i>
                            <span>Quản lý video</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/phim">Phim</a>
                            </li>
                            <li>
                                <a href="/raw">Raw</a>
                            </li>
                            <li>
                                <a href="/video">Video</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php if (isset($image)) {
                            echo 'class="active"';
                        } ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">collections</i>
                            <span>Ảnh</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/">Tải ảnh lên</a>
                            </li>
                            <li>
                                <a href="/image">Thư viện</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php if (isset($other)) {
                            echo 'class="active"';
                        } ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">settings_applications</i>
                            <span>Chức năng quản lý khác</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/history">Lịch sử hoạt động</a>
                            </li>
                            <li>
                                <a href="/report">Báo lỗi</a>
                            </li>
                            <li>
                                <a href="/notify">Thông báo</a>
                            </li>
                            <li>
                                <a href="/session">Session Logger</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php if (isset($chat)) {
                            echo 'class="active"';
                        } ?>>
                        <a href="/chat"><i class="material-icons">
                            chat
                    </i><span>Chat</span></a>
                    </li>
                    <li>
                   <a href="javascript:void(0);" class="waves-effect waves-block">
                   <i class="material-icons">brightness_6</i>
                    <form action="" method="POST" style="display: inline-block;" id="darkmode">
                        <button class="fztcp_sbutton" type="submit" name="darkmode">
                            <?php if(isset($_COOKIE['darkmode'])) {echo 'Tắt';} else {echo 'Bật';}?> chế độ tối<span id="dark_auto_on" style="display: none;">(Đã bật theo hệ thống)</span>
                        </button>
                       </form>
                    </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2020 Zuta Fansub AdminCP<br> Developed by Nguyen Anh Duc.
                </div>
                <div class="version">
                    <b>Version: </b> fztcp-material.3.1.6-b221120316
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <!-- #END# Right Sidebar -->
    </section>