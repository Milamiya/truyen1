<?php
include '/home/pgybseis/domains/zutafansub.tk/public_html/system/lib/mobiledetect.php';
$url_main_web = "https://zutafansub.tk";
$url_main_web2 = "zutafansub.tk";
if (isset($_SESSION['id']) == true) {
    $usrid = $_SESSION['id'];
} else {
    $usrid = $_COOKIE['id'];
}
$dbs = mysqli_query($conn, "SELECT * FROM users WHERE `id` = '$usrid'");
$data1 = mysqli_fetch_array($dbs);
$dbset = mysqli_query($conn, "SELECT * FROM setting WHERE `id` = '1'");
$dataset = mysqli_fetch_array($dbset);
//   AVATAR CONFIG
if (empty($data1['avt'])) {
    $avatar = "/assets/images/user/default/default.png";
} else {
    $avatar = $data1['avt'];
}
//IP USER LOGGER 
if ($data1['username'] !== null) {
    $query_user_ipp = mysqli_query($conn, "SELECT * FROM user_ip WHERE `for_user` = '$usrid' ORDER BY id DESC");
    $load_user_ipp = mysqli_fetch_array($query_user_ipp);
    if ($ipload !== $load_user_ipp['ip']) {
        $datenow = date("Y-m-d H:i:s");
        $mbl_detect = new Mobile_Detect;
        //tab = 2; mobile = 1; pc = 0 :))
        $mbl_deviceType = ($mbl_detect->isMobile() ? ($mbl_detect->isTablet() ? '2' : '1') : '0');
        $mbl_name = htmlentities($_SERVER['HTTP_USER_AGENT']);
        if ($mbl_deviceType['type'] == 2) {
            $dv_typea = 'máy tính bảng';
        } elseif ($mbl_deviceType['type'] == 1) {
            $dv_typea = 'điện thoại';
        } else {
            $dv_typea = 'máy tính';
        }
        mysqli_query($conn, "INSERT INTO `user_ip` (`ip`, `for_user`, `date`, `type`, `name`) VALUES ('$ipload', '$usrid', '$datenow', '$mbl_deviceType', '$mbl_name')");
    }
}
// END AVATAR CONFIG
// COVER CONFIG
if (empty($data1['cover'])) {
    $cover = "https://i.imgur.com/VFH6rzf.jpg";
} else {
    $cover = $data1['cover'];
}

// END COVER CONFIG

if ($data1['admin'] == 1) {
    $fztcp1 = "inline";
    $fztcp = "block";
    $fztcppass = '?loguser=' . $data1['username'] . '&logpass=' . $data1['password'];
    $usrperm = '<span style="background-color:red;border-radius:5px;color:#fff">Admin</span>';
} else {
    if ($_COOKIE['username'] == null) {
        $fztcppass = null;
        $fztcp = "none";
        $fztcp1 = "none";
        $usrperm = '<a href="<?php echo $url_main_web;?>/dang-nhap"><span style="background-color:green;border-radius:5px;color:#fff">Đăng nhập</span></a>';
    }
}
function custom_echo($x, $length)
{
    if (strlen($x) <= $length) {
        echo $x;
    } else {
        $y = substr($x, 0, $length) . '...';
        echo $y;
    }
}
if ($data1['username'] == null) {
} else {
    $datelast = date("Y-m-d H:i:s");
    mysqli_query($conn, "UPDATE `users` SET `last_ss` = '$datelast' WHERE `users`.`id` = '$usrid'");
}
$query_sys_notify = mysqli_query($conn, "SELECT * FROM notify WHERE `for_id` = 0 ORDER BY id DESC");
$query_usr_notify = mysqli_query($conn, "SELECT * FROM notify WHERE `for_id` = '$usrid' ORDER BY id DESC");
include '/home/pgybseis/domains/zutafansub.tk/public_html/lang/vi.php';
?>

<!DOCTYPE html>
<html>

<head>
    <!--<link rel="stylesheet" href="<?php /*echo $url_main_web; ?>/css/loaddk.css">
    <script src="<?php echo $url_main_web;*/ ?>/js/pace.min.js"></script>-->
    <?php if (isset($qmv)) { ?>
        <meta name="description" content="<?php echo $qmv['description']; ?>">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?php echo $url_main_web; ?>">
        <meta property="og:title" content="">
        <meta property="og:description" content="<?php echo $qmv['description']; ?>">
        <meta property="og:image" content="<?php echo $loadvid['thumb']; ?>">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="<?php echo $url_main_web; ?>">
        <meta property="twitter:title" content="">
        <meta property="twitter:description" content="<?php echo $qmv['description']; ?>">
        <meta property="twitter:image" content="<?php echo $loadvid['thumb']; ?>">
    <?php } ?>
    <?php 
    if (isset($movies)) { ?>
        <meta name="description" content="<?php echo $desa ?>, Zuta Fansub - Xem anime Vietsub online chất lượng cao nhất và miễn phí.">
        <meta name="keywords" content="<?php echo $titkey; ?>, anime vietsub, zuta team, zuta fansub, zutafansub, anime hay nhat">
    <?php } elseif (isset($qmv) == false) { ?>
        <meta name="description" content="Zuta Fansub - Xem anime Vietsub online chất lượng cao nhất và miễn phí.">
        <meta name="keywords" content="anime vietsub, zuta team, zuta fansub, zutafansub, anime hay nhat">
    <?php } ?>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-T2KVPSF');
    </script>
    <!-- End Google Tag Manager -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
    <script src="https://www.google.com/recaptcha/api.js?hl=vi"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e43ea47069.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pagecdn.io/lib/font-awesome/5.14.0/css/all.css">
    <script defer src="https://pagecdn.io/lib/font-awesome/5.14.0/js/all.js"></script>
    <script src="/js/browser.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo $url_main_web; ?>/css/material-r.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="<?php echo $url_main_web; ?>/js/function.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            // Set trigger and container variables
            var trigger = $('#nav ul li a'),
                container = $('#content');

            // Fire on click
            trigger.on('click', function() {
                // Set $this for re-use. Set target from data attribute
                var $this = $(this),
                    target = $this.data('target');

                // Load target page into container
                container.load(target + '.php');

                // Stop normal link behavior
                return false;
            });
        });
    </script>
    <style>
        .usrbox .bgabox {
            background-image: linear-gradient(to right top, rgb(0, 0, 0, .6), rgb(0, 0, 0, .6)), url('<?php echo $cover; ?>');
        }
    </style>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-177060284-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-177060284-2');
    </script>
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.light_blue-blue.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <link rel="stylesheet" href="<?php echo $url_main_web; ?>/css/blur.css">
    <link rel="stylesheet" href="<?php echo $url_main_web; ?>/css/keyframes.css">
    <link id="iflight" rel="stylesheet" href="<?php echo $url_main_web; ?>/css/fztfsapp.css">
</head>

<body>
    <!--(c) 2020 Zuta Fansub !!!-!!! Developed by Nguyen Anh Duc-->
    <!-- Main web-->
    <?php 
    if (isset($_COOKIE['username']) == true or $_SESSION['username'] == true) {} else {
    include 'login.php';
    include 'user_reg.php';
    }
    include 'internet_status.php';
    ?>
    <div id="kuri_progress">
        <div class="indeterminate"></div>
    </div>
    <div id="application">
        <?php if ($data1['username'] == null) {
        } else { ?>
            <!--LOGOUT DIALOG-->
            <div id="logoutmsg">
                <div id="msglg">
                    <h3>Bạn có muốn đăng xuất không?</h3>
                    <a style="font-size:10px">Bạn sẽ phải đăng nhập lại để sử dụng các chức năng trên web Zuta Fansub</a>
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="window.location.href='<?php echo $url_main_web; ?>/dang-xuat'">Đăng xuất</button>
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="clslg()">Hủy</button>
                </div>
            </div>
            <script>
                function clslg() {
                    document.getElementById("msglg").style.animation = "logoutc 0.5s";
                    document.getElementById("logoutmsg").style.animation = "fadecl 0.5s";
                    setTimeout(function() {
                        document.getElementById("msglg").style.display = "none";
                        document.getElementById("logoutmsg").style.display = "none";
                    }, 480);
                }

                function logout() {
                    document.getElementById("msglg").style.animation = "logout 0.5s";
                    document.getElementById("logoutmsg").style.animation = "fade 0.5s";
                    document.getElementById("msglg").style.display = "block";
                    document.getElementById("logoutmsg").style.display = "block";
                }
            </script>
        <?php } ?>
        <?php if (isset($_SESSION['fztcpitem']) == false) {
            $_SESSION['fztcpitem'] = "fztcp2020"; ?>
            <!--LOADING PAGE-->
            <div id="loading">
                <div id="mainload">
                    <!--<i style="font-size:80px" class="fas fa-circle-notch"></i>-->
                    <svg class="material-spinner-pure-custom" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                        <circle class="material-spinner-pure-custom-path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                    </svg>
                    <p style="padding-top:10px"><?php echo $loading_wrapper;?></p>
                </div>
            </div>
            <script>
                function load() {
                    setTimeout(function() {
                        document.getElementById("loading").style.animation = "timeout 0.5s";
                    }, 2100)
                    setTimeout(function() {
                        document.getElementById("loading").style.display = "none";
                    }, 2580)
                }
                window.load();
            </script>
        <?php } ?>
        <?php if (isset($qmv)) { ?>
            <img style="display:none" src="<?php echo $loadvid['thumb']; ?>">
        <?php } ?>
        <!--HEADER-->
        <div class="header" id="headpreload">
            <div id="headleft" class="left">
                <img id="logo" onclick="opnav()" src="<?php echo $url_main_web; ?>/assets/images/111120/favicon/zutafs-favicon.png<?php// /assets/images/111120/logo/zutafs-512.png?>" style="/*width: 130px*/ width:47px;float:left;cursor:pointer">
                <span id="lmenu">
                    <a id="ssicon" onclick="opsearch()" id="
                <?php if (isset($search) == true) {
                    echo $search;
                } ?>"><i class="fas fa-search"></i></a>
                    <a href='<?php echo $url_main_web; ?>/' id="
                <?php if (isset($home) == true) {
                    echo $home;
                } ?>"><i class="fas fa-home"></i><span id="hometext"> Trang chủ</span></a>
                    <div class="lmenu1">

                    </div>
                </span>
            </div>
            <?php if ($data1['username'] == null) { ?>
                <a onclick="open_login_dialog()">
                    <div id="headunlog" class="right">
                        <p id="headunlogp" style="float:right;padding-top:13px;padding-bottom:7px">ĐĂNG NHẬP</p>
                    </div>
                </a>
                <style>
                    #headunlog {
                        padding: 10px
                    }
                </style>
            <?php } else { ?>
                <div id="headright" class="right" onclick="openusrbox()">
                    <img id="headavt" src="<?php echo $avatar; ?>">
                </div>
                <div onclick="opnotify()" id="headusr" style="cursor:pointer;padding-top: 20px;float:right" class="usrname"><a><span class="material-icons">
                            <?php if(mysqli_num_rows($query_usr_notify) > 0 ) {echo "notifications_active";} else { echo "notifications_none";}?>
                        </span></a></div>
            <?php } ?>
        </div>
        <div onclick="closeusrbox()" id="fillnav1"></div>
        <div class="usrbox" id="usrbox" style="position:fixed">
            <div class="bgabox"></div>
            <div onclick="window.location.href='/nguoi-dung/zid/<?php echo $data1['id']; ?>'" class="coverblurusrbox" style="
    height: 105px;
    position: absolute;
    width: 94%;
    border-radius: 10px;
    z-index: 10;
    cursor:pointer
"></div>
            <div class="usrboxmain">
                <img src="<?php echo $avatar; ?>">
                <div class="usrname1"><a style="font-size:20px;font-weight:bolder"><?php echo $data1['name']; ?></a><br><a style="font-size:10px">username: <?php echo $data1['username']; ?> / id: <?php echo $data1['id']; ?></a></div>
            </div>
            <div class="btnmenu">
              <button onclick="window.location.href='<?php echo $url_main_web; ?>/nguoi-dung/zid/<?php echo $data1['id']; ?>'" id="btnmain"><i class="fas fa-user"></i></button>
                <?php if ($data1['admin'] == 1) { ?>
                    <button style="display:<?php echo $fztcp1; ?>" onclick="window.open('https://admincp.<?php echo $url_main_web2; ?>')" id="btnmain"><i class="fas fa-sliders-h"></i></button>
                <?php } ?>
                <button onclick="window.location.href='<?php echo $url_main_web; ?>/'" id="btnmain"><i class="fas fa-home"></i></button>
                <button onclick="logout()" id="btnmain"><i class="fas fa-sign-out-alt"></i></button>
                <button onclick="window.location.href='<?php echo $url_main_web; ?>/cai-dat'" id="btnmain"><i class="fas fa-user-cog"></i></button>
                <button onclick="opnav();closeusrbox()" id="btnmain"><i class="fas fa-bars"></i></button>
                <a style="font-size:7px;display:block"><b>Tips:</b> you can move this box :))</a>
            </div>
        </div>
        <div onclick="clsnav()" id="fillnav"></div>
        <div class="navop" id="navope">
            <div id="mainnav">
                <a id="clsnav" onclick="clsnav()">&times</a>
                <div class="avatar">
                    <img style="float: left;" src="<?php echo $avatar; ?>" width="100px" height="100px">
                    <h3 style="display: inline;float:right;padding:10px">
                        <?php if ($data1['username'] == null) {
                            echo "<a href='/dang-nhap'>Đăng nhập</a>";
                        } else {
                            custom_echo($data1['name'], 25);
                        } ?> <?php if ($data1['admin'] == 1) { ?>
                            <i style="color:#0384fc" class="fas fa-check-circle"></i> <?php } ?></h3>
                </div>
                <div class="menu">
                    <?php if ($data1['admin'] == 1) { ?>
                        <a style="display:<?php echo $fztcp; ?>" onclick="window.open('https://admincp.<?php echo $url_main_web2; ?><?php //if (isset($fztcppass) == true) {
                                                                                                                                        //echo $fztcppass;
                                                                                                                                    //} ?>')"><i class="fas fa-sliders-h"></i> FZTcp</a>
                    <?php } ?>
                    <a href="<?php echo $url_main_web; ?>/"><i class="fas fa-home"></i> Trang chủ</a>
                    <a onclick="opsearch()"><i class="fas fa-search"></i> Tìm kiếm</a>
                    <?php if ($data1['username'] == null) {
                    } else { ?>
                        <a href='<?php echo $url_main_web; ?>/cai-dat'><i class="fas fa-user-cog"></i> Cài đặt</a>
                        <a href='<?php echo $url_main_web; ?>/video-da-thich'><i class="fas fa-heart"></i> Video đã thích</a>
                    <?php
                    } ?>
                    <a onclick="nav_home_m()"><i class="fas fa-film"></i> Phim</a>
                    <a onclick="nav_home_t()"><i class="fas fa-fire"></i> Nổi bật</a>
                    <?php if ($data1['username'] == null) {
                    } else { ?>
                        <a href='<?php echo $url_main_web; ?>/lich-su-dang-nhap'><i class="far fa-clock"></i> Lịch sử đăng nhập</a>
                        <a onclick="logout();"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div id="social-left">
            <a target="_blank" href="https://www.youtube.com/channel/UCEFCOc_o5E-u6suUVguUniQ" style="background-color: rgb(255,0,0,.8);">YouTube <i class="fab fa-youtube"></i></a>
            <a target="_blank" href="https://www.facebook.com/zutafs/" style="background-color: rgb(25, 116, 236,.8);">Facebook <i class="fab fa-facebook"></i></a>
        </div>
        <script>
            $(document).ready(function() {
                $.ajax({
                    success: function() {
                        $("#kuri_progress").css("display", "none");
                    }
                });
            });
        </script>
        <div id="fillnav5" onclick="clnotify()"></div>
        <div id="notify_nav">
            <a id="notify_closer" onclick="clnotify()" style="display:none;cursor:pointer;font-size:24px;float:left;padding:3px">&times</a>
            <h4 style="
            float: left;
    width: fit-content;font-size:14px;
    padding: 10px;"> <?php echo $notify_main_cap;?></h4>
            <?php /* if (isset($_POST['rmall'])) {
                mysqli_query($conn, "DELETE FROM `notify` WHERE `notify`.`for_id` = '$usrid'");
                echo '<script>window.location.href=""</script>';
            }*/
            ?>
            <form action="" method="POST">
                <button name="rmall" id="btnclear" type="submit"><?php echo $notify_clearall;?></button>
            </form>
            <script>
  $(document).ready(function () {
    $('#btnclear').click(function (e) {
      e.preventDefault();
      $.ajax
        ({
          type: "POST",
          url: "/system/ajax/clear_all_notify.php",
          success: function (data) {
            $("#user_notify").load("/includes/user_notify.php");
          }
        });
    });
  });
</script>
            <div class="allnotify">
                <div class="system_notify">
                    <h5 style="
                float: left;
    width: fit-content;font-size:13px;
    padding: 10px;"><?php echo $notify_from_system;?> - <?php echo mysqli_num_rows($query_sys_notify); ?></h5>
                    <?php while ($sysnof = mysqli_fetch_array($query_sys_notify)) { ?>
                        <div class="notify_content" onclick="expendnotid<?php echo $sysnof['id']; ?>()" id="notid<?php echo $sysnof['id']; ?>">
                            <div class="notify_icon">
                                <span class="material-icons">
                                    <?php if ($sysnof['type'] == 1) {
                                        echo 'warning';
                                    } elseif ($sysnof['type'] == 2) {
                                        echo 'error_outline';
                                    } elseif ($sysnof['type'] == 3) {
                                        echo 'new_releases';
                                    } else {
                                        echo 'notifications_none';
                                    } ?>
                                </span>
                            </div>
                            <h5 title="<?php echo $sysnof['title']; ?>"><?php echo $sysnof['title']; ?></h5>
                            <a style="color:rgb(180,180,180);font-size:10px;float:left"><i class="far fa-clock"></i> <?php echo $sysnof['date']; ?></a>
                            <p><?php echo $sysnof['content']; ?></p>
                        </div>
                        <script>
                            function expendnotid<?php echo $sysnof['id']; ?>() {
                                if (document.getElementById("notid<?php echo $sysnof['id']; ?>").style.height == "140px") {
                                    document.getElementById("notid<?php echo $sysnof['id']; ?>").style.animation = "notexpendzz 0.3s";
                                    setTimeout(function() {
                                        document.getElementById("notid<?php echo $sysnof['id']; ?>").style.height = "80px";
                                    }, 280);
                                } else {
                                    document.getElementById("notid<?php echo $sysnof['id']; ?>").style.animation = "notexpendpp 0.3s";

                                    document.getElementById("notid<?php echo $sysnof['id']; ?>").style.height = "140px";
                                }
                            }
                        </script>
                    <?php } ?>
                </div>
                <div id="user_notify">
                    <?php include 'user_notify.php';?>
                </div>
            </div>
        </div>
        <div id="fillnav6" onclick="clsearch()"></div>
        <div id="search_nav">
            <a onclick="clsearch()" style="cursor:pointer;font-size: 40px;float:right;width:fit-content">&times;</a>
            <h2 style="float: left;width:fit-content;padding:20px"><i class="fas fa-search"></i> Search</h2>
            <form action="<?php echo $url_main_web; ?>/tim-kiem" style="display:inline">
            <input type="search" name="sq" placeholder="type here to seach :))">
            </form>
        </div>
        <!--END HEADER-->