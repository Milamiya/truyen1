<?php
//Lấy thông tin video mới nhất
$newanimesqldb = mysqli_query($conn, "SELECT * FROM vid_like WHERE by_id='$usrid' ORDER BY id DESC");
?>
<div class="mainhome" style="padding-bottom:20px">
    <div id="mainvid" style="padding-bottom:15%">
    <h3 id="title11"><i class="fas fa-heart"></i> <?php echo $liked_video_main_cap;?> <a style="font-size:10px;font-weight:lighter">Tổng: <?php echo mysqli_num_rows($newanimesqldb);?></a></h3>
    <div class="vidct">
        <?php 
        $top = 1; while ($row = mysqli_fetch_array($newanimesqldb, MYSQLI_ASSOC) and $top <= 15) {
                    $vididload = $row['video'];
                    $allvidlike = mysqli_query($conn, "SELECT * FROM video WHERE `id` = '$vididload' AND `hidden`= '0' ORDER BY id DESC");
                    $allvidlikeload = mysqli_fetch_array($allvidlike);
                    if(empty($allvidlikeload['thumb'])) {
                        $thumb = "https://cdn.fztfansub.tk/resources/default/bg/chino.jpg";
                    } else {
                        $thumb = $allvidlikeload['thumb'];
                    }
                ?>
      <a <?php if($allvidlikeload['title'] !== null){?>href="/xem-video/<?php echo $allvidlikeload['slug'];?>.html" <?php } ?>>
        <div class="viditem">
            <div class="num">
               <h2><?php echo $top;$top++?></h2>
           </div>
           <div class="main_title">
                            <p><?php if($allvidlikeload['title'] == null){echo 'Deleted :((';} else { echo $allvidlikeload['title'];} ?></p>
                        </div>
           <img src="<?php if($allvidlikeload['title'] == null){echo '/assets/default/notfound.png';} else { echo $thumb;}?>" class="vidthumb" width="100%">
           
           <div class="play_middle">
               <img src="/assets/play.png" width="50px" height="50px">
           </div>
           <p style="font-size:18px"> <?php if($allvidlikeload['title'] == null){echo 'Video đã bị xóa :((((';} else { echo $allvidlikeload['title'];} ?> <br><span style="color:#888;font-weight:normal;font-size:14px"><?php echo $allvidlikeload['view'];?> <?php echo $meta_view;?></span></p>
        </div>
      </a>
                <?php } ?>
    </div>
  </div><br><br>
  </div>
  </div>
</div>
<style>
.num {
    position: absolute;
    float: left;
    padding: 10px;
    margin: 10px;
    border-radius: 5px;
    background-color: rgb(20,20,20,.4);
    color: #fff;
}
</style>