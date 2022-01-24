<?php
include '../system/perm.php';
$setting = 1;
include '../includes/header.php';
if (isset($_POST['about'])) {
    $content = $_POST['content'];
    $datelog = date("Y-m-d H:i:s");
    $contentlog = "Đã chỉnh sửa About - by: " . $lo11['name'];
    $byid = $lo11['id'];
    mysqli_query($conn, "INSERT INTO `log` (`content`, `date`, `by_id`) VALUES ('$contentlog', '$datelog', '$byid')");
    mysqli_query($conn, "UPDATE `setting` SET `about` = '$content' WHERE `setting`.`id` = 1");
    echo '<script>window.location.href=""</script>';
}
if (isset($_POST['change-title'])) {
    $contenttit = $_POST['titlehead'];
    $datelog = date("Y-m-d H:i:s");
    $contentlog = "Đã chỉnh sửa Title Web - by: " . $lo11['name'];
    $byid = $lo11['id'];
    mysqli_query($conn, "INSERT INTO `log` (`content`, `date`, `by_id`) VALUES ('$contentlog', '$datelog', '$byid')");
    mysqli_query($conn, "UPDATE `setting` SET `title` = '$contenttit' WHERE `setting`.`id` = 1");
    echo '<script>window.location.href=""</script>';
}
if ($loadset['maintenance'] == 1) {
    $maintenance = "Tắt trang bảo trì";
} else {
    $maintenance = "Bật trang bảo trì";
}
if (isset($_POST['main-change'])) {
    if (isset($_POST['maintenance'])) {
        $datelog = date("Y-m-d H:i:s");
        $contentlog = "Đã bật trang bảo trì - by: " . $lo11['name'];
        $byid = $lo11['id'];
        mysqli_query($conn, "INSERT INTO `log` (`content`, `date`, `by_id`) VALUES ('$contentlog', '$datelog', '$byid')");
        mysqli_query($conn, "UPDATE `setting` SET `maintenance` = '1' WHERE `setting`.`id` = 1");
        echo '<script>window.location.href=""</script>';
    } else {
        $datelog = date("Y-m-d H:i:s");
        $contentlog = "Đã tắt trang bảo trì - by: " . $lo11['name'];
        $byid = $lo11['id'];
        mysqli_query($conn, "INSERT INTO `log` (`content`, `date`, `by_id`) VALUES ('$contentlog', '$datelog', '$byid')");
        mysqli_query($conn, "UPDATE `setting` SET `maintenance` = '0' WHERE `setting`.`id` = 1");
        echo '<script>window.location.href=""</script>';
    }
}
?>
<title>Cài đặt - <?php echo $titlecp;?></title>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>CÀI ĐẶT</h2>
        </div>
        <!-- Body Copy -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase">
                            Tên trang (Title)
                        </h2>
                    </div>
                    <div class="body">
                        <p>Thay đổi tên trang (tiêu đề or thẻ title bla bla)</p>
                        <form action="" method="POST">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input value="<?php echo $loadset['title']; ?>" name="titlehead" type="text" class="form-control">
                                    <label class="form-label">Tên trang</label>
                                </div>
                            </div>
                            <button type="submit" name="change-title" class="btn btn-primary m-t-15 waves-effect">LƯU LẠI</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Body Copy -->
        <!-- MAINTENANCE -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase">
                            Bảo trì
                        </h2>
                        <!--<ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>-->
                    </div>
                    <div class="body">
                        <p>Thay đổi tên trang (tiêu đề or thẻ title bla bla)</p>
                        <form action="" method="POST">
                            <div class="form-group form-float">
                            <div class="switch">
                                    TẮT <label><input name="maintenance" type="checkbox" <?php if ($loadset['maintenance'] == 1) {echo "checked";} ?>><span class="lever"></span></label> BẬT
                                </div>
                            </div>
                            <button type="submit" name="main-change" class="btn btn-primary m-t-15 waves-effect">LƯU LẠI</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# MAINTENANCE -->
        <!-- Body Copy -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase">
                            About
                        </h2>
                    </div>
                    <div class="body">
                        <p>Thay đổi nội dung trong phần about</p>
                        <form action="" method="POST">
                            <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="content" cols="30" rows="5" class="form-control no-resize"><?php echo $loadset['about'];?></textarea>
                                        <label class="form-label">About</label>
                                    </div>
                                </div>
                            <button type="submit" name="about" class="btn btn-primary m-t-15 waves-effect">LƯU LẠI</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Body Copy -->
    </div>
    </div>
</section>
<?php include '../includes/footer.php'; ?>