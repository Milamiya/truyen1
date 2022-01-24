<?php
include '../system/perm.php';
$search = "active";
    $querysearch = addslashes($_GET['sq']);
    $search = filter_var($querysearch, FILTER_SANITIZE_STRING);
include '../includes/header.php';
?>

<div class="searchct" id="nava2">
    <div class="headsearch">
        <div class="defaultbgsearch"></div>
        <div class="bgsearch"></div>
        <div class="fill"></div>
        <div class="hmain">
            <form action="/tim-kiem" class="fetch_results">
                <input id="smain" name="sq" type="search" value="<?php echo $search;?>" placeholder="type here to search :>">
                <button id="btnsmain" type="submit"><i class="fas fa-search" aria-hidden="true"></i></button>
                <button type="button" class="bsbtn" id="btnsmain" onclick="backspace()"><i class="fas fa-backspace"></i></button>
            </form>
            <p style="font-size:10px">tips: you can enter to submit :))</p>
        </div>
    </div>
    <script>
  var backspace = function() {
    var rekensom  = document.getElementById('smain').value;
    document.getElementById('smain').value=rekensom.substring(0,rekensom.length -1);
  }
</script>
    <div class="bodysearch">
        <?php
        if($search == null) {
        ?>
        <title>Search - FZTfansub / Anime Vietsub</title>
        <div class="nonesearch" style="text-align:center">
            <img src="/assets/default/default13.png" width="auto" height="auto">
            <h4>search :>></h4>
        </div>
        <style>
            #nothing {
                display:none;
            }
        </style>
        <?php
        } else {
        $query1 = "select * from `video` where hidden=0 and `title` like '%$search%' or hidden=0 and `description` like '%$search%'";
        $result = mysqli_query($conn,$query1);
        $result2 = mysqli_query($conn,$query1);
        $row2 = mysqli_fetch_assoc($result2);
        ?>
        <title>Search "<?php echo $search;?>" - FZTfansub / Anime Vietsub</title>
        <?php
        }
        ?>
        <div class="sbl">
                        <div class="vidct">
        <?php while ($row = mysqli_fetch_assoc($result)) :
            if(empty($row['thumb'])) {
                $thumb = "https://i.imgur.com/VFH6rzf.jpg";
            } else {
                $thumb = $row['thumb'];
            }
        ?>
      <a href="/xem-video/<?php echo $row['slug'];?>.html">
        <div class="viditem">
           <img src="<?php echo $thumb;?>" class="vidthumb" width="100%">
           <div class="play_middle">
               <img src="/assets/play.png" width="50px" height="50px">
           </div>
           <p style="font-size:18px"> <?php echo $row['title'];?> <br><span style="color:#888;font-weight:normal;font-size:14px"><?php echo $row['view'];?> lượt xem</span></p>
        </div>
      </a>
        <?php endwhile;?>
            </div>
        </div>
        <?php if($row2['id'] == null) { ?>
        <div class="nonesearch" id="nothing" style="text-align:center">
            <img src="/assets/default/default12.png" width="auto" height="auto">
            <h4>nothing :((</h4>
        </div>
        <?php } ?>
    </div>
</div>
<style>
.hmain #btnsmain {
    border:1px solid #000;
    border-radius:5px;
    width:40px;
    height:40px;
    background-color:rgb(20,20,20,.7);
    outline:none;
    font-size:20px;
    transition:0.2s;
    color:#FFF;
}
.hmain #btnsmain:hover {
    background-color:rgb(50,50,50,.9);
    color:#fff;
}
.hmain #smain {
    outline:none;
    border:1px solid #000;
    border-radius:5px;
    width:80%;
    height:40px;
    padding:20px;
    background-color:rgb(20,20,20,.7);
    margin-left:auto;
    margin-right:auto;
    color:#fff;
    font-size:20px;
}
.hmain {
    position: absolute;
    width:100%;
    text-align:center;
    padding-top:50px;
}
.fill {
    width:100%;
    height:180px;
    position: absolute;
}
.defaultbgsearch {
    background-image: linear-gradient(to right top,rgb(0,0,0,.6),rgb(0,0,0,.6)), url('https://i.imgur.com/VFH6rzf.jpg');
    background-position: center center;
    background-size: cover;
    width:100%;
    height:180px;
    position: absolute;
}
.bgsearch {
    background-image: linear-gradient(to right top,rgb(0,0,0,.6),rgb(0,0,0,.6)), url('<?php echo $row2['thumb'];?>');
    background-position: center center;
    background-size: cover;
    width:100%;
    height:180px;
    position: absolute;
}
.bodysearch {
    padding:20px;
}
.headsearch {
    width:100%;
    height:180px;
    background-color:#fafafa;
    color:#fff;
}
    .searchct {
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        position: relative;
        top: 100px;
        height: auto;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58,59,69,.15);
    }
    @media only screen and (max-width:800px) {
        .searchct {
            width:97%;
        }
        .bsbtn {
            display:none;
        }
    }
    @media only screen and (max-width:650px) {
        .searchct {
            width:100%;
        }
    }
    .searchct .sbl-item img {
        width:250px;
        height:140px;
    }
    .sbl {

        padding: 10px;
    }
</style>


<?php
include '../includes/footer.php';
?>