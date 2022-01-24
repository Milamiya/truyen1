<?php
$dberror = "
<title></title>
<style>
@import 'https://fonts.googleapis.com/css?family=Google+Sans:100,300,400,500,700,900,100i,300i,400i,500i,700i,900i';
* {
    color:#fff;
    font-family: Google Sans;
}
body {
    background: #202020;
}
</style>
<div style='text-align:center'>
<h1>STOPPED</h1>
<hr>
<p>Copyright&copy ".date("Y")." FZT Fansub Limited
</div>";
$fzthostname = 'localhost';
$fztuser = '';
$fztpass = '';
$fztdatabase = '';

$conn = mysqli_connect($fzthostname,$fztuser,$fztpass) or die($dberror);
mysqli_set_charset($conn, 'UTF8');
mysqli_select_db($conn,$fztdatabase) or die($dberror);
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (isset($_SESSION['id']) == true) {
    $usrid = $_SESSION['id'];
} else {
    $usrid = $_COOKIE['id'];
}
$query_sys_notify = mysqli_query($conn, "SELECT * FROM notify WHERE `for_id` = 0 ORDER BY id DESC");
$query_usr_notify = mysqli_query($conn, "SELECT * FROM notify WHERE `for_id` = '$usrid' ORDER BY id DESC");
?>
<h5 style="
                float: left;
    width: fit-content;font-size:13px;
    padding: 10px;">THÔNG BÁO CHO NGƯỜI DÙNG - <?php echo mysqli_num_rows($query_usr_notify); ?></h5>
<?php while ($sysnof = mysqli_fetch_array($query_usr_notify)) {
                        $notid = $sysnof['id'];
                        $delnotid = 'delnotid' . $sysnof['id'];
                        /*if (isset($_POST[$delnotid])) {
                            mysqli_query($conn, "DELETE FROM `notify` WHERE `notify`.`id` = '$notid'");
                            echo '<script>window.location.href=""</script>';
                        }*/
                    ?>
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
                            <h5><?php echo $sysnof['title']; ?></h5>
                            <form action="" method="POST">
                                <button name="delnotid<?php echo $sysnof['id']; ?>" class="delnotid<?php echo $sysnof['id']; ?>" type="submit" title="Xóa thông báo này" id="delnotbtn"><span class="material-icons">delete_outline</span></button></form>
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
                            $(document).ready(function () {
    $('.delnotid<?php echo $sysnof['id']; ?>').click(function (e) {
      e.preventDefault();
      var idneed = "<?php echo $sysnof['id'];?>";
      $.ajax
        ({
          type: "POST",
          url: "/system/ajax/clear_user_notify.php",
          data: { "idnotify": idneed },
          success: function (data) {
            $("#user_notify").load("/includes/user_notify.php");
          }
        });
    });
  });
                        </script>
                    <?php } ?>