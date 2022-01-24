<?php
$movie_load = mysqli_query($conn, "SELECT * FROM movie WHERE hidden=0 ORDER BY id DESC LIMIT 15");
$row1 = mysqli_fetch_array($trending);
?>
<div class="mainhome" style="padding-bottom:20px">
    <div id="mainvid" style="padding-bottom:15%">
    <h3 id="title11"><i class="fas fa-film" aria-hidden="true"></i> Phim </h3>
    <div class="vidct" id="moviect">
        <?php while ($row = mysqli_fetch_array($movie_load, MYSQLI_ASSOC)) {
                    if(empty($row['poster'])) {
                        $poster = "https://cdn.fztfansub.tk/resources/default/bg/chino.jpg";
                    } else {
                        $poster = $row['poster'];
                    }
                ?>
      <a href="/xem-phim/<?php echo $row['slug'];?>.html">
        <div class="viditem">
        <div class="type_vid">
            <h4 style="color:#fff"><?php echo $row['ep'];?> EP</h4></div>
            <div class="main_title">
                            <p><?php echo $row['name']; ?></p>
                        </div>
           <img src="<?php echo $poster;?>" class="vidthumb" width="100%">
           <p style="font-size:17px"> <?php echo $row['name'];?> <br>
           <span style="color:#888;font-weight:normal;font-size:14px"><?php echo $row['ep'];?> <?php echo $meta_episode;?> <?php if($row['coming_soon'] == 1) {echo '- <b>COMING SOON</b>';}?></span>
           </p>
        </div>
      </a>
                <?php } ?>
    </div>
  </div><br><br>
  </div>
  </div>
</div>
<style>

@media screen and (min-width:1000px) {
     .viditem {
         width:23%;
         float:left;
         font-size:16px
         
     }
}
</style>