<?php
if(isset($_GET['slug']) == false or empty($_GET['slug'])) {
    header("Location: /");
    exit;
} 
include '../system/perm.php';
$movies = "active";
$mvid = $_GET['slug'];
$loadmv = mysqli_query($conn, "SELECT * FROM movie WHERE slug='$mvid' AND `hidden` = 0");
$rowmv = mysqli_fetch_array($loadmv);
$mviddd = $rowmv['id'];
$rowmv11 = mysqli_query($conn, "SELECT * FROM video WHERE `movie` = '$mviddd' AND `hidden` = 0 ORDER BY id DESC");
$numrowmv = mysqli_num_rows($rowmv11);
if($rowmv['id'] == null) {
    header("Location: /");
    exit;
}
$desa = $rowmv['description'];
$titkey = $rowmv['name'];
include '../includes/header.php';
?>
<title><?php echo $meta_movie;?>: <?php echo $rowmv['name'];?> - <?php echo $titlehead;?></title>
<div class="bgmovie"></div>
<div class="bgcolorm"></div>
<style>
    .bgmovie {
        position:fixed;
        width:100%;
        height:100%;
        z-index:0;
        background: rgb(0,0,0,.4) url(<?php echo $rowmv['poster'];?>);
        filter:blur(20px);
        background-position:center;
    }
    .bgcolorm {
        position:fixed;
        width:100%;
        height:100%;
        z-index:0;
        background:rgb(20,20,20,.6);
    }
</style>
<div class="mvmain">
    <div class="headmv">
        <div id="poster">
            <img src="<?php echo $rowmv['poster'];?>">
            <a target="_blank" href="<?php echo $rowmv['poster'];?>" style="color:#fff" download="PosterImage.jpg">
                <div class="download_poster">
                    <span id="titdwposter">Open Image in New Tabs </span>
                    <i class="far fa-image"></i>
                </div>
            </a>
        </div>
        <div id="ctmv">
            <h1><?php echo $rowmv['name'];?></h1>
            <?php if($rowmv['coming_soon'] == 1) { ?>
            <h3 id="coming" style="background-color: green;width: fit-content;">COMING SOON</h3>
<?php } ?>
            <p style="padding:5px;color:gray"><?php echo $rowmv['description'];?></p>
            <div class="episode">
                <a><?php echo $movie_all_episode;?></a>
                <h1><?php echo $rowmv['ep'];?></h1>
            </div>
            <div class="comepisode">
                <a><?php echo $movie_completed_episode;?></a>
                <h1><?php echo $numrowmv;?></h1>
            </div>
        </div>
    </div>
</div>
<?php if($rowmv['coming_soon'] == 0) { ?>
<div class="allfilm">
    <div class="vidct">
            <?php while ($row = mysqli_fetch_array($rowmv11, MYSQLI_ASSOC)) :
                        if(empty($row['thumb'])) {
                            $thumb = "https://i.imgur.com/VFH6rzf.jpg";
                        } else {
                            $thumb = $row['thumb'];
                        }
                        if($row['movie'] == 0) {} else {
                            $mvhomeid = $row['movie'];
                            $mvhomeload = mysqli_query($conn, "SELECT * FROM movie WHERE id='$mvhomeid'");
                            $mvhomeq = mysqli_fetch_array($mvhomeload);
                        }
                    ?>
          <a href="/xem-video/<?php echo $row['slug'];?>.html">
            <div class="viditem">
            <div class="type_vid">
            <h4 style="color:#fff"><?php
        if($row['type'] == 0) {
            echo 'EP';
        }
        if($row['type'] == 1) {
            echo 'Movie';
        }
        if($row['type'] == 2) {
            echo 'OVA';
        }
        if($row['type'] == 3) {
            echo 'Remake';
        }
        ?> <?php
        if($row['ep'] == 0) {} else {
            echo '- '.$row['ep'].'/'.$mvhomeq['ep'];
        }?></h4></div>
        <div class="main_title">
                            <p><?php echo $row['title']; ?></p>
                        </div>
               <img src="<?php echo $thumb;?>" class="vidthumb" width="100%">
               <div class="play_middle">
               <img src="/assets/play.png" width="50px" height="50px">
           </div>
               <p style="font-size:18px"> <?php echo $row['title'];?> <br><span style="color:#888;font-weight:normal;font-size:14px"><?php echo $row['view'];?> <?php echo $meta_view;?></span></p>
            </div>
          </a>
          <?php endwhile; ?>
    </div>
</div>
<?php } ?>
<style>
        .download_poster {
            position: absolute;
    background-color: rgb(0,0,0,.6);
    top: 0;
    padding: 7px;
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    font-size: 10px;
    transition: 0.2s;
    }
    #titdwposter {
        display: none;
        animation: fade 0.2s;
    }
    @keyframes opdwposter {
        0% {
            width: 10px;
        }
        100% {
            width: 130px;
        }
    }
    .download_poster:hover {
        width: 130px;
        animation: fade 0.2s;
    }
    .download_poster:hover #titdwposter {
        display: inline;
    }
.allfilm {
    padding:20px;
    width:auto;
    display:inline-block;
}
    .mvmain {
        padding-top:100px;
    }
    .headmv {
        width:100%;
        height:40%;
        display:block;
        position: relative
    }
    #poster {
        width:20%;
        float:left;
        padding-left:3%;
    }
    #poster img {
        width:100%;
    }
    #ctmv {
        float:left;
        width:70%;
        padding:20px;
    }
    .episode, .comepisode {
        padding:20px;
        width:30%;
        float:left;
        display:inline-block;
        text-align:center;
        background-color:rgb(0,0,0,.5);
        margin:5px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58,59,69,.15);
        transition:0.5s
    }
    .episode:hover, .comepisode:hover {
        cursor:pointer;
        transform:scale(1.1);
    }

@media only screen and (max-width:900px) {
        #poster {
        width:90%;
        float:initial;
        padding-left:0;
        margin-left:auto;
        margin-right:auto;
    }
    #coming {
        margin: auto;
    }
    .episode, .comepisode {
        width:90%;
        margin-left:auto;
        margin-right:auto;
        float: initial;
    }
    #ctmv {
        float:left;
        width:90%;
        text-align:center;
        padding:20px;
        display:block;
    }
    .allfilm {
        width:85%;
        margin-left:auto;
        margin-right:auto;
    }
}
@media only screen and (min-width:600px) {
    #ttp {
        display:none;
    }
    .allfilm {
        display: inherit;
    }
}
@media only screen and (min-width:900px) {
        #ttp {
        display:block;
    }
    .allfilm {
        display: inline-block;
    }
}
</style>
<?php include '../includes/footer.php'; ?>