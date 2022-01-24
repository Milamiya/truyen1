<?php
include '../system/perm.php';
//===============================================
$vidid = $_GET['slug'];
$sqlvid = mysqli_query($conn, "SELECT * FROM video WHERE slug='$vidid'");
$loadvid = mysqli_fetch_array($sqlvid);
$videoid = $loadvid['id'];
if ($_GET['slug'] == null or isset($_GET['slug']) == false or $loadvid['hidden'] == 1) {
    header("Loaction: /");
    exit();
} else {
        $vidcookie = "vidid" . $videoid;
        $vidcokvalue = "ssid" . $videoid;
        $scv = $vidcokvalue;
        if (isset($_SESSION[$vidcookie]) == false) {
            $_SESSION[$vidcookie] = $vidcokvalue;
            mysqli_query($conn, "UPDATE `video` SET `view` =`view` + '1' WHERE `video`.`id` = '$videoid'");
        }
include '../includes/header.php';
?>
        <title><?php echo $loadvid['title']; ?> - <?php echo $titlehead; ?></title>
        <style>
        .header {
            display:none;
        }
        #social-left {
            display:none;
        }
        #plmainfull {
            width:100%;
            height:100%;
            position:fixed;
        }
        #plmainfull iframe {
            width:100%;
            height:100%;
            border:none;
            outline:none;
        }
        .hibtn {
            background:transparent;
            width:100px;
            height:100px;
            position:absolute;
            float:right;
            right:0;
            top:0;
        }
        #gobackaa {
    opacity: 0.5;
    transition: 0.3s;
        }
        #gobackaa:hover {
            opacity: 1;
        }
        </style>
        <div id="plmainfull">
            <iframe allowfullscreen="" frameborder="0" height="100%" id="player" sname="player" width="100%" src="<?php echo $loadvid['src']; ?>"></iframe>
            <div class="hibtn"></div>
            <a href="/xem-video/<?php echo $loadvid['slug'];?>.html">
            <button id="gobackaa" style="position: fixed; top:13px;left:13px" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
                <i class="fas fa-chevron-left"></i>
            </button>
            </a>
        </div>
        <script>
            var elem = document.getElementById("plmainfull");
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.webkitRequestFullscreen) { /* Safari */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE11 */
    elem.msRequestFullscreen();
  }
}
  window.openFullscreen();
        </script>
    <?php
   include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; } 
    ?>