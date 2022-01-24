<?php
include '../system/perm.php';
$video = 1;
include '../includes/header.php';
if(isset($_POST['btnsubmit'])) {
    $name = $_POST['name'];
    $des = $_POST['des'];
    $poster = $_POST['poster'];
    $ep = $_POST['ep'];
    if(isset($_POST['hidden'])) {
        $hidden = "1";
    } else {
        $hidden = "0";
    }
    if(isset($_POST['coming_soon'])) {
        $coming_soon = "1";
    } else {
        $coming_soon = "0";
    }
    if(empty($name)){
        $log = "Điền full đê :v";
    } else {
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
        $slug = vidslug($name);
        mysqli_query($conn, "INSERT INTO `movie` (`slug`, `name`, `description`, `poster`,`ep`,`coming_soon`, `hidden`) VALUES ('$slug', '$name', '$des', '$poster','$ep', '$coming_soon', '$hidden')");
        $datelog = date("Y-m-d H:i:s");
        $contentlog = "Created Movie '" . $name . "' - by: " . $lo11['name'];
        $byid = $lo11['id'];
        mysqli_query($conn, "INSERT INTO `log` (`content`, `date`, `by_id`) VALUES ('$contentlog', '$datelog', '$byid')");
        $log = "Publish Complete!";
    }
}
?>
<title>Tạo phim mới - <?php echo $titlecp; ?></title>
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
                            Tạo phim mới
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
                                    <li><a href="/phim">Trở về</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                    <form action="" method="POST" class="form-horizontal">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Tên phim</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="name" value="<?php echo $filldata['name']; ?>" autocomplete="off" class="form-control" placeholder="Name">
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
                                        <label for="email_address_2">Poster (yêu cầu ảnh phải có kích thước 800w x 1135h)</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="poster" value="<?php echo $filldata['poster']; ?>" autocomplete="off" class="form-control" placeholder="Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Tập (episode)</label>
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
                                        <label for="password_2">Hidden</label>
                                    </div>
                                    <div class="switch">
                                        <label><input type="checkbox" name="hidden" <?php echo $hide;?>><span class="lever"></span></label>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Coming soon </label>
                                    </div>
                                    <div class="switch">
                                        <label><input type="checkbox" name="coming_soon" <?php echo $cson;?>><span class="lever"></span></label>
                                    </div>
                                </div>
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
<script src="/js/kuri_uploader.js"></script>
<?php
include '../includes/footer.php'; ?>