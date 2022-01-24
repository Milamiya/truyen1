<?php
include '../system/perm.php';
$video = 1;
$loadmovie = mysqli_query($conn, "SELECT * FROM movie");
include '../includes/header.php';
?>
<title>Tạo video mới - <?php echo $titlecp; ?></title>
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
                            Tạo video mới
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
                                    <li><a href="/video">Trở về</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="email_address_2">Tên video</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="title" value="<?php echo $filldata['title']; ?>" autocomplete="off" class="form-control" placeholder="Title">
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
                                            <input type="text" name="des" value="<?php echo $filldata['description']; ?>" autocomplete="off" class="form-control" placeholder="Description">
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
                                            <input type="text" name="src" value="<?php echo $filldata['src']; ?>" autocomplete="off" class="form-control" placeholder="Link">
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
                                            <input type="text" name="sub" value="<?php echo $filldata['sub']; ?>" autocomplete="off" class="form-control" placeholder="Link file sub">
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
                                            <input type="number" name="ep" value="<?php echo $filldata['ep']; ?>" autocomplete="off" class="form-control" placeholder="Episode">
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
                            <p>Thumbnails (yêu cầu ảnh phải có kích thước 1920w x 1080h)</p>
                            <div class="kuri_uploader">
                                <div class="kuri_main_uploader" onclick="$('#filePhoto').click()">
                                    <div class="kuri_inner_uploader">
                                        Drag and drop or click to select image uwu
                                        <img class="hidden" src="" />
                                        <input accept="image/*" type="file" name="thumbs" id="kuri_filePhoto" />
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="password_2">Hidden</label>
                                </div>
                                <div class="switch">
                                    <label><input type="checkbox" name="hidden" <?php echo $hide; ?>><span class="lever"></span></label>
                                </div>
                            </div>
                            <?php if ($lo11['id'] == 1) { ?>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Lock edit </label>
                                    </div>
                                    <div class="switch">
                                        <label><input type="checkbox" name="lock_edit" <?php echo $ledit; ?>><span class="lever"></span></label>
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
<script src="/js/kuri_uploader.js"></script>
<?php
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
    $img = $_FILES['thumbs'];
    if ($img['name'] == null) {
        echo "<script>alert('Chưa chọn ảnh!');</script>";
    } else {
        $filename = $img['tmp_name'];
        $client_id = 'b54cf411367fb00';
        $handle = fopen($filename, 'r');
        $data = fread($handle, filesize($filename));
        $pvars = array('image' => base64_encode($data));
        $timeout = 30;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);

        $out = curl_exec($curl);
        curl_close($curl);
        $pms = json_decode($out, true);
        $url = $pms['data']['link'];
        if ($url != '') {
            ///here
            if (empty($title)) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin');</script>";
            } else {
                mysqli_query($conn, "INSERT INTO `video` (`slug`, `title`, `thumb`, `description`,`movie`, `type`, `ep`, `src`, `sub`, `lock_edit`, `hidden`) VALUES ('$slug', '$title', '$url','$des','$movie', '$type', '$ep', '$src', '$sub','$ledit', '$hidden')");
                $datelog = date("Y-m-d H:i:s");
                $contentlog = "Created Video: '" . $title . "' - by: " . $lo11['name'];
                $byid = $lo11['id'];
                mysqli_query($conn, "INSERT INTO `log` (`content`, `date`, `by_id`) VALUES ('$contentlog', '$datelog', '$byid')");
                echo "<script>alert('Publish Complete!');</script>";
            }
        } else {
            echo "<script>alert('Lỗi không xác định :((');</script>";
        }
    }
}
include '../includes/footer.php'; ?>