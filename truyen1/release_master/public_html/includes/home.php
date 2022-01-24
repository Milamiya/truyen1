<?php
$newanimesqldb = mysqli_query($conn, "SELECT * FROM video WHERE hidden=0 ORDER BY id DESC LIMIT 15");
$mvanimesqldb = mysqli_query($conn, "SELECT * FROM video WHERE hidden=0 AND type=1 ORDER BY id DESC LIMIT 15");
?>
<div class="mainhome" style="padding-bottom:20px">
    <div class="slide" id="banner_home">
        <iframe style="z-index:1" src="/bin/pg/index.php"></iframe>
    </div>
    <style>
        .slide iframe {
            outline: none;
            border: none;
            width: 100%;
            height: 500px;
        }

        .mainhome {
            padding-top: 80px
        }


        @media screen and (min-width:1000px) {
            .viditem {
                width: 23%;
                float: left;
                font-size: 16px
            }
        }
    </style>
    <div class="nav_home" id="nav_home">
        <div class="nav_content_button" id="nav_home_home" style="background: #828282;" onclick="nav_home_h()">
            <span class="material-icons-outlined">home</span> <a id="nav_home">Trang chủ</a>
        </div>
        <div class="nav_content_button" id="nav_home_trend" onclick="nav_home_t()">
            <span class="material-icons-outlined">local_fire_department</span> <a id="nav_noi_bat">Nổi bật</a>
        </div>
        <div class="nav_content_button" id="nav_home_movie" onclick="nav_home_m()">
            <span class="material-icons-outlined">movie</span> <a id="nav_phim">Phim</a>
        </div>
        <div class="nav_content_button" onclick="opsearch()">
            <span class="material-icons-outlined">search</span> <a id="nav_tim_kiem">Tìm kiếm</a>
        </div>
        <div style="float:right" class="nav_content_button" onclick="banneropcl()">
            <a id="tat_banner"><span style="float: initial;" id="status_banner"></span> Banner</a> <span class="material-icons-outlined">remove_red_eye</span>
        </div>
    </div>

    <!-- MAIN HOME -->
    <div id="main_home_home" class="main_home_all" style="display: block;">
        <div id="mainvid" style="padding-bottom:15%">
            <h3 id="title11"><i class="fas fa-film" aria-hidden="true"></i> <?php echo $home_new_vid; ?></h3>
            <div class="vidct">
                <?php while ($row = mysqli_fetch_array($newanimesqldb, MYSQLI_ASSOC)) :
                    if (empty($row['thumb'])) {
                        $thumb = "https://cdn.fztfansub.tk/resources/default/bg/chino.jpg";
                    } else {
                        $thumb = $row['thumb'];
                    }
                    if ($row['movie'] == 0) {
                    } else {
                        $mvhomeid = $row['movie'];
                        $mvhomeload = mysqli_query($conn, "SELECT * FROM movie WHERE id='$mvhomeid'");
                        $mvhomeq = mysqli_fetch_array($mvhomeload);
                    }
                ?>
                    <a href="<?php if($data1['username'] == null){?>javascript:open_login_dialog();<?php } else { ?>/xem-video/<?php echo $row['slug']; ?>.html<?php } ?>">
                        <div class="viditem">
                            <div class="type_vid">
                                <h4 style="color:#fff"><?php
                                                        if ($row['type'] == 0) {
                                                            echo 'EP';
                                                        }
                                                        if ($row['type'] == 1) {
                                                            echo 'Movie';
                                                        }
                                                        if ($row['type'] == 2) {
                                                            echo 'OVA';
                                                        }
                                                        if ($row['type'] == 3) {
                                                            echo 'Remake';
                                                        }
                                                        ?> <?php
                                                        if ($row['ep'] == 0) {
                                                        } else {
                                                            echo '- ' . $row['ep'] . '/' . $mvhomeq['ep'];
                                                        } ?></h4>
                            </div>
                            <div class="main_title">
                                <p><?php echo $row['title']; ?></p>
                            </div>
                            <img src="<?php echo $thumb; ?>" class="vidthumb" width="100%">
                            <div class="play_middle">
                                <img src="/assets/play.png" width="50px" height="50px">
                            </div>
                            <p style="font-size:18px"> <?php echo $row['title']; ?> <br><span style="color:#888;font-weight:normal;font-size:14px"><?php echo $row['view']; ?> <?php echo $meta_view; ?></span></p>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>
            <div class="moviessss" style="display:block;width:100%;float:left">
                <h3 id="title11"><i class="fas fa-film" aria-hidden="true"></i> <?php echo $home_movie; ?></h3>
                <div class="vidct">
                    <?php while ($row = mysqli_fetch_array($mvanimesqldb, MYSQLI_ASSOC)) :
                        if (empty($row['thumb'])) {
                            $thumb = "https://cdn.fztfansub.tk/resources/default/bg/chino.jpg";
                        } else {
                            $thumb = $row['thumb'];
                        }
                    ?>
                        <a href="<?php if($data1['username'] == null){?>javascript:open_login_dialog();<?php } else { ?>/xem-video/<?php echo $row['slug']; ?>.html<?php } ?>">
                            <div class="viditem">
                                <img src="<?php echo $thumb; ?>" class="vidthumb" width="100%">
                                <div class="play_middle">
                                    <img src="/assets/play.png" width="50px" height="50px">
                                </div>
                                <p style="font-size:18px"> <?php echo $row['title']; ?> <br><span style="color:#888;font-weight:normal;font-size:14px"><?php echo $row['view']; ?> <?php echo $meta_view; ?></span></p>
                            </div>
                        </a>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    $movie_load = mysqli_query($conn, "SELECT * FROM movie WHERE hidden=0 ORDER BY id DESC LIMIT 15");
    $row1 = mysqli_fetch_array($trending);
    ?>
    <!-- MOVIE -->
    <div id="main_home_movie" class="main_home_all">
        <div id="mainvid">
            <div id="movie_now" style="display:block;width:100%;float:left">
                <h3 id="title11"><i class="fas fa-film" aria-hidden="true"></i> Phim </h3>
                <div class="vidct" id="moviect">
                    <?php while ($row = mysqli_fetch_array($movie_load, MYSQLI_ASSOC)) {
                        if (empty($row['poster'])) {
                            $poster = "https://cdn.fztfansub.tk/resources/default/bg/chino.jpg";
                        } else {
                            $poster = $row['poster'];
                        }
                    ?>
                        <a href="/xem-phim/<?php echo $row['slug']; ?>.html">
                            <div class="viditem">
                                <div class="type_vid">
                                    <h4 style="color:#fff"><?php echo $row['ep']; ?> EP</h4>
                                </div>
                                <div class="main_title">
                                    <p><?php echo $row['name']; ?></p>
                                </div>
                                <img src="<?php echo $poster; ?>" class="vidthumb" width="100%">
                                <p style="font-size:17px"> <?php echo $row['name']; ?> <br>
                                    <span style="color:#888;font-weight:normal;font-size:14px"><?php echo $row['ep']; ?> <?php echo $meta_episode; ?> <?php if ($row['coming_soon'] == 1) {
                                                                                                                                                            echo '- <b>COMING SOON</b>';
                                                                                                                                                        } ?></span>
                                </p>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- TREND -->
    <?php
    $trend_load = mysqli_query($conn, "SELECT * FROM video WHERE hidden=0 ORDER BY view DESC LIMIT 15");
    ?>
    <div id="main_home_trend" class="main_home_all">
        <div id="mainvid">
            <div id="trend_home" style="display:block;width:100%;float:left">
                <h3 id="title11"><i class="fas fa-fire"></i> <?php echo $meta_trend; ?></h3>
                <div class="vidct">
                    <?php $top = 1;
                    while ($row = mysqli_fetch_array($trend_load, MYSQLI_ASSOC) and $top <= 15) {
                        if (empty($row['thumb'])) {
                            $thumb = "https://cdn.fztfansub.tk/resources/default/bg/chino.jpg";
                        } else {
                            $thumb = $row['thumb'];
                        }
                    ?>
                        <a href="<?php if($data1['username'] == null){?>javascript:open_login_dialog();<?php } else { ?>/xem-video/<?php echo $row['slug']; ?>.html<?php } ?>">
                            <div class="viditem">
                                <div class="num">
                                    <h2><?php echo $top;
                                        $top++ ?></h2>
                                </div>
                                <img src="<?php echo $thumb; ?>" class="vidthumb" width="100%">
                                <div class="play_middle">
                                    <img src="/assets/play.png" width="50px" height="50px">
                                </div>
                                <p style="font-size:18px"> <?php echo $row['title']; ?> <br><span style="color:#888;font-weight:normal;font-size:14px"><?php echo $row['view']; ?> <?php echo $meta_view; ?></span></p>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">


function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
    var nav_home_home_btn = document.getElementById("nav_home_home");
    var nav_home_movie_btn = document.getElementById("nav_home_movie");
    var nav_home_trend_btn = document.getElementById("nav_home_trend");

    var main_home_home_page = document.getElementById("main_home_home");
    var main_home_movie_page = document.getElementById("main_home_movie");
    var main_home_trend_page = document.getElementById("main_home_trend");

    function nav_home_h() {
        main_home_home_page.style.display = "block";
        main_home_movie_page.style.display = "none";
        main_home_trend_page.style.display = "none";
        nav_home_home_btn.style.background = "#828282";
        nav_home_movie_btn.style.background = "transparent";
        nav_home_trend_btn.style.background = "transparent";
    }
    function nav_home_m() {
        main_home_home_page.style.display = "none";
        main_home_movie_page.style.display = "block";
        main_home_trend_page.style.display = "none";
        nav_home_movie_btn.style.background = "#828282";
        nav_home_trend_btn.style.background = "transparent";
        nav_home_home_btn.style.background = "transparent";
    }
    function nav_home_t() {
        main_home_home_page.style.display = "none";
        main_home_movie_page.style.display = "none";
        main_home_trend_page.style.display = "block";
        nav_home_trend_btn.style.background = "#828282";
        nav_home_movie_btn.style.background = "transparent";
        nav_home_home_btn.style.background = "transparent";
    }
    function banneropcl() {
        if(document.getElementById("banner_home").style.display === "none") {
            document.getElementById("banner_home").style.animation = "banner_open 0.3s";
            document.getElementById("banner_home").style.height = "500px";
            document.cookie = "banner=on; expires=Thu, 18 Dec 2100 12:00:00 UTC; path=/";
            document.getElementById("banner_home").style.display = "block";
            document.getElementById("nav_home").style.position = "relative";
            var para = document.createElement("style");
            var node = document.createTextNode("#mainvid {padding-top:0px !important}");
            para.appendChild(node);
            var element = document.head;
            element.appendChild(para);
            document.getElementById("status_banner").innerHTML = "Tắt";
        } else {
            document.getElementById("banner_home").style.animation = "banner_close 0.3s";
            document.getElementById("banner_home").style.height = "0px";
            document.cookie = "banner=off; expires=Thu, 18 Dec 2100 12:00:00 UTC; path=/";
            document.getElementById("nav_home").style.position = "fixed";
            var para = document.createElement("style");
            var node = document.createTextNode("#mainvid {padding-top:40px !important}");
            para.appendChild(node);
            var element = document.head;
            element.appendChild(para);
            document.getElementById("status_banner").innerHTML = "Bật";
            setTimeout(
                function() {
                    document.getElementById("banner_home").style.display = "none";
                }
            ,280);
        }
    }
    if(getCookie("banner") === "off") {
        document.getElementById("banner_home").style.display = "none";
        document.getElementById("nav_home").style.position = "fixed";
            var para = document.createElement("style");
            var node = document.createTextNode("#mainvid {padding-top:40px !important}");
            para.appendChild(node);
            var element = document.head;
            element.appendChild(para);
            document.getElementById("status_banner").innerHTML = "Bật";
    } else {
        document.getElementById("banner_home").style.display = "block";
        document.getElementById("nav_home").style.position = "relative";
            var para = document.createElement("style");
            var node = document.createTextNode("#mainvid {padding-top:0px !important}");
            para.appendChild(node);
            var element = document.head;
            element.appendChild(para);
            document.getElementById("status_banner").innerHTML = "Tắt";
    }
    </script>
    <style>
        @keyframes banner_open {
            0% {
                opacity: 0;
                height: 0px;
            }
            100% {
                opacity: 1;
                height: 500px;
            }
        }
        @keyframes banner_close {
            100% {
                opacity: 0;
                height: 0px;
            }
            0% {
                opacity: 1;
                height: 500px;
            }
        }
        .num {
            position: absolute;
            float: left;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            background-color: rgb(20, 20, 20, .4);
            color: #fff;
        }
    </style>
</div>