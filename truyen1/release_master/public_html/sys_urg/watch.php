<?php
include '../system/perm.php';
//===============================================
$vidid = $_GET['slug'];
$sqlvid = mysqli_query($conn, "SELECT * FROM video WHERE slug='$vidid'");
$loadvid = mysqli_fetch_array($sqlvid);
$videoid = $loadvid['id'];
if ($loadvid['movie'] == null) {
    $newanimesqldb = mysqli_query($conn, "SELECT * FROM video WHERE hidden=0 ORDER BY id DESC LIMIT 15");
} else {
    $idmv1 = $loadvid['movie'];
    $newanimesqldb = mysqli_query($conn, "SELECT * FROM video WHERE hidden=0 AND movie='$idmv1' ORDER BY id DESC LIMIT 15");
}
$sqlvid = mysqli_query($conn, "SELECT * FROM video WHERE slug='$vidid'");
$loadvid = mysqli_fetch_array($sqlvid);
$videoid = $loadvid['id'];
if ($_GET['slug'] == null or isset($_GET['slug']) == false or $loadvid['hidden'] == 1) {
    header("Location: /xem-video/khong-tim-thay-noi-dung");
    exit;
} else {
    if ($loadvid['hidden'] == 1) {
        header("Location: /xem-video/khong-tim-thay-noi-dung");
        exit;
    } else {
        if ($loadvid['id'] == null) {
            header("Location: /xem-video/khong-tim-thay-noi-dung");
            exit;
        }
        $mviddd = $loadvid['movie'];
        $mvload = mysqli_query($conn, "SELECT * FROM movie WHERE id='$mviddd'");
        $qmv = mysqli_fetch_array($mvload);
        $vidcookie = "vidid" . $videoid;
        $vidcokvalue = "ssid" . $videoid;
        $scv = $vidcokvalue;
        if (isset($_SESSION[$vidcookie]) == false) {
            $_SESSION[$vidcookie] = $vidcokvalue;
            mysqli_query($conn, "UPDATE `video` SET `view` =`view` + '1' WHERE `video`.`id` = '$videoid'");
        }
        $vidrpid = $_COOKIE['id'];
        $datenow = date("Y-m-d h:i:s");
        $ssname = "vidrp" . $videoid . $data1['id'];
        if (isset($_POST['reporting'])) {
            mysqli_query($conn, "INSERT INTO `reporting` (`by_id`, `film_id`, `ip_user`, `date`) VALUES ('$usrid', '$videoid', '$ipload', '$datenow')");
            $_SESSION[$ssname] = "video_reporting";
            header("Refresh:0");
        }
        include '../includes/header.php';
        $cmtcontent = mysqli_query($conn, "SELECT * FROM comment WHERE for_vid='$videoid' ORDER BY id DESC");
        $numcmtct = mysqli_num_rows($cmtcontent);
        $cmtusrid111 = $data1['id'];
        if (isset($_POST['subcmt'])) {
            $cmtct = $_POST['comment'];
            $cmtmainct = filter_var($cmtct, FILTER_SANITIZE_STRING);
            $datecmt = date("Y-m-d H:i:s");
            mysqli_query($conn, "INSERT INTO `comment` (`content`, `by_id`, `for_vid`, `date`) VALUES ('$cmtmainct', '$cmtusrid111', '$videoid', '$datecmt')");
            echo "<script>window.location.href=''</script>";
        }
        $likesql = mysqli_query($conn, "SELECT * FROM vid_like WHERE video='$videoid'");
        $likenum = mysqli_num_rows($likesql);
        $likequery = mysqli_fetch_array($likesql);
        $likeuser = mysqli_query($conn, "SELECT * FROM vid_like WHERE video='$videoid' AND by_id='$cmtusrid111'");
        $likeuserquery = mysqli_fetch_array($likeuser);
        if (isset($_POST['likebtn'])) {
            if ($likeuserquery['video'] == null) {
                mysqli_query($conn, "INSERT INTO `vid_like` (`id`, `video`, `by_id`) VALUES (NULL, '$videoid', '$cmtusrid111')");
                echo "<script>window.location.href=''</script>";
            } else {
                mysqli_query($conn, "DELETE FROM `vid_like` WHERE `vid_like`.`video` = '$videoid'");
                echo "<script>window.location.href=''</script>";
            }
        }
?>
        <title><?php echo $loadvid['title']; ?> - <?php echo $titlehead; ?></title>
        <style>
            .cmtcontent {
                float: left;
                width: fit-content;
            }

            .main-cmt img {
                float: left;
                width: 50px;
                margin: 10px;
                height: 50px;
                border-radius: 5px;
                border: 2px solid #fff;
            }

            .cmtitem {
                width: 100%;
                display: block;
                float: left;
            }

            .cmtitem img {
                float: left;
                width: 50px;
                margin: 10px;
                height: 50px;
                border-radius: 5px;
                border: 2px solid #fff;
            }

            .cmt-root {
                width: 65%;
                float: left;
                padding-top: 10px;
                float: left;
                padding-bottom: 50px
            }

            .vid000 {
                padding: 10px;
                cursor: pointer;
                display: flex;
                transition: 0.2s;
            }

            .vid000:hover {
                background-color: #606060;
            }

            .vid000 a {
                padding: 0px;
                font-weight: bolder;
                font-size: 18px;
                float: left;
                overflow: hidden;
                white-space: nowrap;
                text-overflow: Ellipsis;
                max-width: 100%;
            }

            .vid000 img {
                width: 30%;
                float: left;
                height: inherit;
            }

            .hibtn {
                background: transparent;
                width: 100px;
                height: 100px;
                float: right;
                right: 0;
                position: absolute
            }

            .nvid {
                width: 35%;
                float: right;
            }

            .naimein .vidnaitems img {
                width: 30%;
                float: left;
            }

            .naimein {
                padding: 1px;
                height: 100%;
                overflow: scroll;
                overflow-x: hidden;
            }

            .mainvid {
                padding-top: 100px;
                width: 95%;
                margin: auto;
            }

            .vidnaitems {
                padding: 20px;
                font-size: 20px;
                text-align: left;
                transition: 0.2s;
                cursor: pointer;
                height: 10%;
            }

            .vidnaitems a {
                padding-left: 10px;
            }

            .plmain {
                width: 65%;
                position: relative;
                float: left;
            }

            .player {
                position: relative;
                overflow: hidden;
                padding-bottom: 56.25%;
            }

            .player iframe {
                border: none;
                outline: none;
            }

            .vidtitle {
                padding: 20px;

            }

            #ipcmt {
                width: 87%;
                float: left
            }

            @media only screen and (max-width:900px) {
                #ipcmt {
                    width: 85%;
                    float: right
                }

                .cmt-root {
                    width: 95%;
                    margin-left: auto;
                    margin-right: auto;
                    float: initial;
                    position: relative;
                }

                .nvid {
                    width: 100%;
                    float: left;
                }

                #nainmein {
                    height: 500px;
                }

                .plmain {
                    width: 100%;
                    position: relative;
                    float: left;
                }

                .mainvid {
                    padding-top: 0px;
                    width: 100%;
                    margin: auto;
                }

                .header {
                    display: none
                }
            }

            .fc1 button {
                border: none;
                outline: none;
                background: transparent;
                color: #808080;
                cursor: pointer
            }

            .function_btn {
                float: right;
                padding: 10px;
                color: #808080;
            }

            .fc1 {
                text-align: center;
                cursor: pointer;
                display: inline-grid;
            }

            .fc1 i {
                font-size: 30px;
            }

            .fc1 p {
                font-size: 12px;
                padding: 10px;
            }

            @media only screen and (max-width:515px) {
                #ipcmt {
                    width: 78%
                }
            }

            @media only screen and (max-width:355px) {
                #ipcmt {
                    width: 74%
                }
            }

            #share_vid {
                position: fixed;
                width: 300px;
                height: 200px;
                padding: 10px;
                background-color: rgb(30, 30, 30, .6);
                backdrop-filter: blur(4px);
                -webkit-backdrop-filter: blur(4px);
                top: 50%;
                left: 50%;
                border-radius: 5px;
                transform: translate(-50%, -50%);
                z-index: 1502;
                display: none;
            }
        </style>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0" nonce="zd9n8aJv"></script>
        <link rel="stylesheet" href="/css/idevice.css">
        <div onclick="closeshare()" id="fillnav4">
        </div>
        <div id="share_vid">
            <h2 style="float:left">Chia sẻ video này<h1>
                    <a href="javascript:closeshare()" style="width:fit-content;color:#fff;float:right">&times</a>
                    <div class="fb-share-button" data-href="https://fztfansub.gq/xem-video/<?php echo $loadvid['slug']; ?>" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Ffztfansub.gq%2Fxem-video%2F<?php echo $loadvid['slug']; ?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
        </div>
        <div class="mainvid">
            <div class="plmain">
                <div class="player">
                    <iframe allowfullscreen="" frameborder="0" height="100%" id="player" sname="player" style="position: absolute;" width="100%" src="<?php echo $loadvid['src']; ?>"></iframe>
                    
                </div>
                <div class="vidtitle">
                    <h2><?php echo $loadvid['title']; ?></h2>
                    <p style="font-size:15px; color:gray"><?php echo $loadvid['view']; ?> lượt xem</p>
                    <div class="function_btn">
                        <div class="fc1">
                            <form action="" method="POST" style="display: inline;">
                                <button <?php if ($data1['username'] == null) { ?>type="button" onclick="nonlogin()" <? } else { ?>type="submit" name="likebtn"<?php } ?>>
                                    <i <?php if ($likeuserquery['by_id'] == null) { ?> class="far fa-heart" <?php } else { ?> style="color:#eb348c" class="fas fa-heart" <?php } ?>></i>
                                    <p>Thích - <?php echo $likenum; ?></p>
                                </button>
                            </form>
                        </div>
                        <div class="fc1">
                            <button onclick="openshare()">
                                <i class="fas fa-share-alt"></i>
                                <p>Chia sẻ</p>
                            </button>
                        </div>
                        <div class="fc1">
                          <a href="/xem-video/<?php echo $loadvid['slug']; ?>.html/fullscreen">
                            <button>
                                <i class="fas fa-expand"></i>
                                <p>Toàn màn hình</p>
                            </button>
                          </a>
                        </div>
                        <?php if ($loadvid['sub'] == null) {
                        } else { ?>
                            <div class="fc1">
                                <button onclick="<?php if ($data1['username'] == null) {
                                                        echo 'nonlogin()';
                                                    } else {
                                                        echo "window.open('" . $loadvid['sub'] . "')";
                                                    } ?>">
                                    <i class="fas fa-file-download"></i>
                                    <p>Phụ đề</p>
                                </button>
                            </div>
                        <?php }
                        if (isset($_SESSION[$ssname]) == false) { ?>
                            <div class="fc1">
                                <form action="" method="POST">
                                    <button name="reporting">
                                        <i class="far fa-flag"></i>
                                        <p>Báo lỗi</p>
                                    </button>
                                </form>
                            </div>
                        <?php } ?>
                        <div class="fc1">
                          <a href="/">
                            <button>
                                <i class="fas fa-home"></i>
                                <p>Về trang chủ</p>
                            </button>
                          </a>
                        </div>
                    </div>
                    <script>
                        function nonlogin() {
                            if (confirm("À rế? Bạn chưa đăng nhập kìa :((( \n \n Nhấn OK (hoặc Yes) để đăng nhập nhé")) {
                                window.location.href = '/dang-nhap';
                            }
                        }
                    </script>
                    <div style="width:100%;float:right" class="des">
                    <p style="font-size:12px"><b>Thông báo:</b> Vì server google drive của chúng mình có giới hạn nên chúng mình sẽ qua server hydrax, các quảng cáo xuất hiện trong video đó là quảng cáo của hydrax và web của chúng mình không hề gắn quảng cáo, cảm ơn!</p>
                        <hr>
                        <h3>Mô tả:</h3>
                        <p style="font-size:13px;"><?php echo $loadvid['description']; ?></p>
                    </div>
                </div>
            </div>
            <div class="nvid">
                <h3 style="padding-left:10px">Next</h3>

                <div class="naimein">
                    <?php while ($row = mysqli_fetch_array($newanimesqldb, MYSQLI_ASSOC)) :
                        if (empty($row['thumb'])) {
                            $thumb = "https://i.imgur.com/VFH6rzf.jpg";
                        } else {
                            $thumb = $row['thumb'];
                        }
                    ?>
                        <div class="vid000" onclick="window.location.href='/xem-video/<?php echo $row['slug'] . $movieplay; ?>.html'">
                            <img src="<?php echo $thumb; ?>">
                            <span style="padding-left:10px;float:left;max-width:60%">
                                <a><?php //custom_echo($row['title'], 30); 
                                    echo $row['title'];
                                    ?></a><br>
                                <span style="color:gray;font-size:12px;color:gray;max-width:100%;display:block"><?php echo $row['view']; ?> lượt xem <?php if ($row['id'] == $loadvid['id']) {
                                                                                                                                                            echo '<span style="background:green;font-size:12px;color:#fff">ĐANG XEM</span>';
                                                                                                                                                        } else {
                                                                                                                                                            echo null;
                                                                                                                                                        } ?>
                                </span>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
                 
            <div class="cmt-root">
                <h2 style="float:left">Bình luận: <?php echo $numcmtct; ?> <a style="display:block;font-weight:lighter;font-size:10px">Bạn sẽ phải refresh trang này khi comment xong</a></h2>
                <div class="cmt-main">
                    <?php if ($data1['username'] == null) { ?>
                        <div style="text-align:center">
                            <h3 style="padding: 10px;
    float: left;
    width: 95%;">Bạn cần đăng nhập để bình luận :)) </h3>
                        </div>
                    <?php } else { ?>
                        <div class="main-cmt">
                            <div class="ipcmt">
                                <form action="" method="POST" style="width:100%;float:left">
                                    <img src="<?php echo $data1['avt']; ?>">
                                    <div id="ipcmt" style="margin-left:auto;margin-right:auto" class="material-form-field">
                                        <input autocomplete="off" type="text" name="comment" required name="text" maxlength="1000" id="field-text" />
                                        <label class="material-form-field-label" for="field-text">Viết bình luận của bạn với tên là <?php echo $data1['name']; ?></label>
                                    </div>
                                    <button style="float: right;" name="subcmt" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">Bình luận</button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                    <?php while ($cmtrow = mysqli_fetch_array($cmtcontent)) {
                        $loadcmtidusr = $cmtrow['by_id'];
                        $loadcmtusr = mysqli_query($conn, "SELECT * FROM users WHERE id='$loadcmtidusr'");
                        $querycmtusr = mysqli_fetch_array($loadcmtusr);
                        $namedel = "delcmt" . $cmtrow['id'];
                        $cmtid = $cmtrow['id'];
                        if (isset($_POST[$namedel])) {
                            mysqli_query($conn, "DELETE FROM `comment` WHERE `comment`.`id` = '$cmtid';");
                            echo "<script>window.location.href=''</script>";
                        }
                    ?>
                        <div class="cmtitem">
                            <img src="<?php echo $querycmtusr['avt']; ?>">
                            <div class="cmtcontent">
                                <a href="/nguoi-dung/zid/<?php echo $querycmtusr['id']; ?>"><b><?php echo $querycmtusr['name']; ?></b> <span style="color:gray;font-size:12px"><i class="far fa-clock"></i> <?php echo $cmtrow['date']; ?></span></a>
                                <p><?php echo $cmtrow['content']; ?></p>
                            </div>
                            <?php if ($cmtrow['by_id'] == $usrid) { ?>
                                <form action="" style="float: right; padding:10px" method="POST" id="cmtid<?php echo $cmtrow['id']; ?>">
                                    <button name="delcmt<?php echo $cmtrow['id']; ?>" type="submit" style="border:none;outline:none;background:transparent;color:#808080;cursor:pointer">
                                        <i style="float:right" class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <script>
                function openshare() {
                    document.getElementById("fillnav4").style.display = "block";
                    document.getElementById("share_vid").style.display = "block";
                    document.getElementById("fillnav4").style.animation = "fade 0.5s";
                    document.getElementById("share_vid").style.animation = "fade 0.5s"
                }

                function closeshare() {
                    document.getElementById("fillnav4").style.animation = "fadecl 0.5s";
                    document.getElementById("share_vid").style.animation = "fadecl 0.5s"
                    setTimeout(function() {
                        document.getElementById("fillnav4").style.display = "none";
                        document.getElementById("share_vid").style.display = "none";
                    }, 480);
                }
            </script>
    <?php
    }

    //===============================================
    include '../includes/footer.php';
}
    ?>