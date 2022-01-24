<?php
$trend_load = mysqli_query($conn, "SELECT * FROM video WHERE hidden=0 ORDER BY view DESC LIMIT 15");
?>
<div class="mainhome" style="padding-bottom:20px">
    <div id="mainvid" style="padding-bottom:15%">
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
                <a href="/xem-video/<?php echo $row['slug']; ?>.html">
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
<style>
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