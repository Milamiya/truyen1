<?php
include '../system/perm.php';
$video = 1;
$idus = intval($_GET['id']);
$loadmovie = mysqli_query($conn, "SELECT * FROM movie");
$loadata = mysqli_query($conn, "SELECT * FROM `video` WHERE `video`.`id` = '$idus'");
$filldata = mysqli_fetch_array($loadata);
if ($filldata['id'] == null) {
    header("Location: /video");
    exit();
} else {
    include '../includes/header.php';
    if ($filldata['hidden'] == "1") {
        $hide = "checked";
    } else {
        $hide = null;
    }
    if ($filldata['lock_edit'] == "1") {
        $ledit = "checked";
    } else {
        $ledit = null;
    }
    if (isset($_POST['btnsubmit'])) {
        $title = $_POST['title'];
        $des = $_POST['des'];
        $thumb = $_POST['thumb'];
        $src = $_POST['src'];
        $movie = $_POST['movie'];
        $sub = $_POST['sub'];
        $type = $_POST['type'];
        $ep = $_POST['ep'];
        function vidslug($str) {
            $str = trim(mb_strtolower($str));
            $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
            $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
            $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
            $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
            $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
            $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
            $str = preg_replace('/(đ)/', 'd', $str);
            $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
            $str = preg_replace('/([\s]+)/', '-', $str);
            return $str;
        }
        $slug = vidslug($title);
        if (isset($_POST['hidden'])) {
            $hidden = "1";
        } else {
            $hidden = "0";
        }
        if (isset($_POST['lock_edit'])) {
            $ledit = "1";
        } else {
            $ledit = "0";
        }
        if (empty($title)) {
            $log = "Điền full đê :v";
        } else {
            if ($filldata['lock_edit'] == 1) {
                $log = 'Bạn không thể edit video này! (ERROR: EP_READ_ONLY")';
            } else {
                mysqli_query($conn, "UPDATE `video` SET `slug` = '$slug', `title` = '$title', `thumb` = '$thumb',`description` = '$des',`movie` = '$movie',`ep` = '$ep', `src` = '$src', `type` = '$type', `sub` = '$sub', `hidden` = '$hidden' WHERE `video`.`id` = '$idus'");
                $datelog = date("Y-m-d H:i:s");
                $contentlog = "Edited Video ID:" . $idus . " - by: " . $lo11['name'];
                $byid = $lo11['id'];
                mysqli_query($conn, "INSERT INTO `log` (`content`, `date`, `by_id`) VALUES ('$contentlog', '$datelog', '$byid')");
                $log = "Edit Complete!, <a href='/editvid.php?id=" . $idus . "'>NHẤN VÀO ĐÂY ĐỂ REFRESH PLEASEEEEE!</a>";
                echo '<script>window.location.href=""</script>';
            }
            if ($lo11['id'] == 1) {
                mysqli_query($conn, "UPDATE `video` SET `slug` = '$slug', `title` = '$title', `thumb` = '$thumb', `description` = '$des',`movie` = '$movie',`ep` = '$ep', `src` = '$src', `type` = '$type', `sub` = '$sub', `hidden` = '$hidden', `lock_edit` = '$ledit' WHERE `video`.`id` = '$idus'");
                $datelog = date("Y-m-d h:i:s");
                $contentlog = "Edited Video ID:" . $idus . " - by: " . $lo11['name'];
                $byid = $lo11['id'];
                mysqli_query($conn, "INSERT INTO `log` (`content`, `date`, `by_id`) VALUES ('$contentlog', '$datelog', '$byid')");
                $log = "Edit Complete!, <a href='/editvid.php?id=" . $idus . "'>NHẤN VÀO ĐÂY ĐỂ REFRESH PLEASEEEEE!</a>";
                echo '<script>window.location.href=""</script>';
            }
        }
    }
    if(isset($_POST['del_this_vid'])) {
        mysqli_query($conn, "DELETE FROM `video` WHERE `video`.`id` = '$idus'");
        echo '<script>window.location.href=""</script>';
    }
?>
    <title>Sửa video ID: <?php echo $_GET['id']; ?> - <?php echo $titlecp; ?></title>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>QUẢN LÝ VIDEO</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Sửa video ID: <?php echo $_GET['id']; ?>
                                <small><?php if (isset($log)) {
                                            echo $log;
                                        } else {
                                            echo "Không được để trống các thông tin quan trọng, nhớ đấy :v";
                                        } ?></small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">
                                                <form action="" method="POST"><button type="submit" name="del_this_vid" class="fztcp_sbutton">Xóa video này</button></form>
                                            </a></li>
                                        <li><a href="/video">Trở về</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form action="" method="POST" class="form-horizontal">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Tên video</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="title" value="<?php echo $filldata['title']; ?>" autocomplete="off" class="form-control" placeholder="Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Mô tả</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="des" value="<?php echo $filldata['description']; ?>" autocomplete="off" class="form-control" placeholder="Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Thumbnails (yêu cầu ảnh phải có kích thước 1920w x 1080h)</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="thumb" value="<?php echo $filldata['thumb']; ?>" autocomplete="off" class="form-control" placeholder="Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Link video</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="src" value="<?php echo $filldata['src']; ?>" autocomplete="off" class="form-control" placeholder="Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Link file sub (nếu không có để nguyên)</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="sub" value="<?php echo $filldata['sub']; ?>" autocomplete="off" class="form-control" placeholder="Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Tập (episode - nếu video thường thì để 0)</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number" name="ep" value="<?php echo $filldata['ep']; ?>" autocomplete="off" class="form-control" placeholder="Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Movie</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control show-tick" name="movie">
                                            <option value="0">Default</option>
                                            <?php while ($movierow = mysqli_fetch_array($loadmovie)) { ?>
                                                <option value="<?php echo $movierow['id']; ?>" <?php if ($movierow['id'] == $filldata['movie']) {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $movierow['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Hidden</label>
                                    </div>
                                    <div class="switch">
                                        <label><input type="checkbox" name="hidden" <?php echo $hide;?>><span class="lever"></span></label>
                                    </div>
                                </div>
                                <?php if ($lo11['id'] == 1) { ?>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Lock edit </label>
                                    </div>
                                    <div class="switch">
                                        <label><input type="checkbox" name="lock_edit" <?php echo $ledit;?>><span class="lever"></span></label>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" name="btnsubmit" class="btn btn-primary m-t-15 waves-effect">LƯU LẠI</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include '../includes/footer.php';
} ?>