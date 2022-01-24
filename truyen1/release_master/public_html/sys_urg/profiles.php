<?php
include '../system/perm.php';
if (isset($_GET['profile']) == false) {
    if (isset($_GET['id']) == false) {
        echo '<meta http-equiv="refresh" content="0, url=/">';
        header("Location: /");
        exit();
    }
}
if (isset($_GET['id'])) {
    $profiles_id = $_GET['id'];
    $profilesdata = mysqli_query($conn, "SELECT * FROM users WHERE `id` = '$profiles_id'");
} else {
    $profiles_id = $_GET['profile'];
    $profilesdata = mysqli_query($conn, "SELECT * FROM users WHERE `slug` = '$profiles_id'");
}
$profilesload = mysqli_fetch_array($profilesdata);
$profileid = $profilesload['id'];
if ($profilesload['username'] == null) {
    header("Location: /");
    exit();
}
include '../includes/header.php';
echo '<title>'.$profilesload['name']. ' - ' . $titlehead . '</title>';
$profilesvideolike = mysqli_query($conn, "SELECT * FROM vid_like WHERE by_id='$profileid' ORDER BY id DESC");
/*if($profilesload['cover'] == null) {
    $profilescover = "https://cdn.fztfansub.tk/resources/default/bg/01.jpg";
} else { */
$profilescover = $profilesload['cover'];
//}
if ($profilesload['avt'] == null) {
    $profilesavt = "/assets/default/avt.png";
} else {
    $profilesavt = $profilesload['avt'];
}
?>
<div class="mainprofiles">
    <div class="profiles_cover"></div>
    <div class="profiles_avt">
        <img src="<?php echo $profilesavt; ?>">
        <h2><?php echo $profilesload['name']; ?> <?php if ($profilesload['admin'] == 1) { ?>
                <i style="color:#0384fc" class="fas fa-check-circle"></i> <?php } ?>
            <a style="display: block;font-size:12px;color:gray"><?php if ($profilesload['slug'] == null) {
                                                                    } else {
                                                                        echo '@'.$profilesload['slug'];
                                                                    } ?></a>
        </h2>
        <?php if ($profilesload['id'] == $data1['id']) { ?>
            <button style="margin-top: 10px;" class="pure-material-button-contained" onclick="window.location.href='/cai-dat'">Cài đặt tài khoản</button>
        <?php } ?>
    </div>
    <div class="profiles_nav">
        <button style="background-color: #323232;" id="mainbtn" onclick="opmain()">Chính</button>
        <button id="vidlikebtn" onclick="opvidlike()">Video đã thích</button>
        <button id="i4btn" onclick="opi4pro()">Thông tin</button>
    </div>
    <div id="profiles_main">
        <?php if ($profilesload['profile'] == null) { ?>
            <div class="profiles_main_nothing" style="text-align: center;color:gray">
                <span style="font-size: 200px;" class="material-icons">
                    warning
                </span>
                <p>nothing :((</p>
            </div>
        <?php } else {
            echo $profilesload['profile'];
        } ?>
    </div>
    <div id="profiles_like_vid" class="profiles_mainder">
        <h2>Video đã thích</h2>
        <div class="vidct">
            <?php while ($row = mysqli_fetch_array($profilesvideolike, MYSQLI_ASSOC)) {
                $vididload = $row['video'];
                $allvidlike = mysqli_query($conn, "SELECT * FROM video WHERE `id` = '$vididload' AND `hidden`= '0' ORDER BY id DESC");
                $allvidlikeload = mysqli_fetch_array($allvidlike);
                if (empty($allvidlikeload['thumb'])) {
                    $thumb = "/assets/default/bg/chino.jpg";
                } else {
                    $thumb = $allvidlikeload['thumb'];
                }
            ?>
      <a <?php if($allvidlikeload['title'] !== null){?>href="/xem-video/<?php echo $allvidlikeload['slug'];?>.html" <?php } ?>>
        <div class="viditem">
           <div class="main_title">
                            <p><?php if($allvidlikeload['title'] == null){echo 'Deleted :((';} else { echo $allvidlikeload['title'];} ?></p>
                        </div>
           <img src="<?php if($allvidlikeload['title'] == null){echo '/assets/default/notfound.png';} else { echo $thumb;}?>" class="vidthumb" width="100%">
           
           <div class="play_middle">
               <img src="/assets/play.png" width="50px" height="50px">
           </div>
           <p style="font-size:18px"> <?php if($allvidlikeload['title'] == null){echo 'Video đã bị xóa :((((';} else { echo $allvidlikeload['title'];} ?> <br><span style="color:#888;font-weight:normal;font-size:14px"><?php echo $allvidlikeload['view'];?> lượt xem</span></p>
        </div>
      </a>
            <?php } ?>
        </div>
    </div>
    <div id="profiles_info" class="profiles_mainder" style="display:none">
        <h2 style="width:fit-content">Thông tin cá nhân</h2>
        <div class="profiles_info_main">
            <h4 style="text-transform: uppercase; color: #616161"><i class="far fa-clock"></i> Ngày tham gia</h4>
            <h3 style="font-weight: lighter;">Đã tham gia: <?php echo $profilesload['created']; ?></h3>
        </div>
    </div>
</div>
<script>
    var mainpro = document.getElementById("profiles_main");
    var vidlikedpro = document.getElementById("profiles_like_vid");
    var infopro = document.getElementById("profiles_info");

    var mainprobtn = document.getElementById("mainbtn");
    var vidlikedprobtn = document.getElementById("vidlikebtn");
    var infoprobtn = document.getElementById("i4btn");
    function opmain() {
        mainpro.style.display = "block";
        vidlikedpro.style.display = "none";
        infopro.style.display = "none";
        mainprobtn.style.backgroundColor = "#323232";
        vidlikedprobtn.style.backgroundColor = "#404040";
        infoprobtn.style.backgroundColor = "#404040";
    }
    function opvidlike() {
        mainpro.style.display = "none";
        vidlikedpro.style.display = "block";
        infopro.style.display = "none";
        mainprobtn.style.backgroundColor = "#404040";
        vidlikedprobtn.style.backgroundColor = "#323232";
        infoprobtn.style.backgroundColor = "#404040";
    }
    function opi4pro() {
        mainpro.style.display = "none";
        vidlikedpro.style.display = "none";
        infopro.style.display = "block";
        mainprobtn.style.backgroundColor = "#404040";
        vidlikedprobtn.style.backgroundColor = "#404040";
        infoprobtn.style.backgroundColor = "#323232";
    }
</script>
<style>
    #profiles_like_vid, #profiles_info {
        display: none;
    }
    .profiles_nav {
        width: 100%;
        height: 40px;
        background-color: #404040;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .profiles_nav button {
        border: none;
        outline: none;
        background: transparent;
        width: fit-content;
        height: 40px;
        padding: 10px;
        font-size: 16px;
        color: #fff;
        cursor: pointer;
        transition: 0.2s;
    }

    .profiles_nav button:hover {
        background-color: #808080 !important;
    }

    .profiles_info_main {
        padding: 10px
    }

    .mainprofiles {
        padding-top: 80px;
        width: 80%;
        margin: auto;
        padding-bottom: 80px;
    }

    .profiles_cover {
        position: absolute;
        width: 80%;
        height: 300px;
        z-index: -1;
        background-image: linear-gradient(to top, rgb(0, 0, 0, .6), rgb(0, 0, 0, .0)), url('<?php echo $profilescover; ?>');
        background-position: center;
    }

    .profiles_avt {
        width: 100%;
        height: auto;
        padding-top: 220px;
        z-index: 5;
        text-align: center;
    }

    .profiles_avt img {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        border: 2px solid #242526
    }

    .profiles_avt h3 {
        padding-top: 5px;
    }
    @media only screen and (max-width:750px) {
        .mainprofiles {
            width: 95%;
        }
        .mainprofiles .profiles_cover{
            width: 95%;
        }
    }
</style>
<?php
include '../includes/footer.php';
?>