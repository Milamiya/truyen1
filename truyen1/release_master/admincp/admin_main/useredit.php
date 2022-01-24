<?php
include '../system/perm.php';
$user = 1;
$idus = intval($_GET['id']);
$loadata = mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '$idus'");
$filldata = mysqli_fetch_array($loadata);
if (intval($_GET['id']) == "1" or $filldata['username'] == null) {
    header("Location: /user");
    exit();
} else {
    include '../includes/header.php';
    if ($filldata['admin'] == "0") {
        $secu = "selected";
    }
    if ($filldata['admin'] == "1") {
        $seca = "selected";
    }
    if (isset($_POST["btnsubmit"])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $avt = $_POST['avt'];
        $email = $_POST['email'];
        $cover = $_POST['cover'];
        $perm = $_POST['perm'];
        $passcon = $_POST['passcon'];
        if (isset($_POST['status'])) {
            $status = "1";
        } else {
            $status = "0";
        }
        if ($passcon == $data1['password']) {
            if (empty($name) || empty($username) || empty($password)) {
                $log = "Please fill the blank";
            } else {
                mysqli_query($conn, "UPDATE `users` SET `username` = '$username', `password` = '$password', `name` = '$name', `email`  = '$email', `avt` = '$avt', `cover` = '$cover', `admin` = '$perm', `status` = '$status' WHERE `users`.`id` = '$idus'");
                $datelog = date("Y-m-d H:i:s");
                $contentlog = "Edited User ID:" . $idus . " - by: " . $lo11['name'];
                $byid = $lo11['id'];
                mysqli_query($conn, "INSERT INTO `log` (`content`, `date`, `by_id`) VALUES ('$contentlog', '$datelog', '$byid')");
                $log = "Edit Complete! <a href='/useredit.php?id=" . $idus . "'><b>NHẤN VÀO ĐÂY ĐỂ REFRESH (BẮT BUỘC)</b></a>";
                echo '<script>window.location.href=""</script>';
            }
        } else {
            $log = "<span style='color:red'>Wrong password</span>";
            $wrong = "#593535";
        }
    }
    if(isset($_POST['del_this_user'])) {
        mysqli_query($conn, "DELETE FROM `users` WHERE `users`.`id` = '$idus'");
        echo '<script>window.location.href=""</script>';
    }
?>
    <title>Chỉnh sửa người dùng ID: <?php echo $_GET['id']; ?> - <?php echo $titlecp; ?></title>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>QUẢN LÝ NGƯỜI DÙNG</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Chỉnh sửa người dùng ID: <?php echo $_GET['id']; ?>
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
                                    <li><a href="javascript:void(0);"><form action="" method="POST"><button type="submit" name="del_this_user" class="fztcp_sbutton">Xóa người dùng này</button></form></a></li>
                                    <li><a href="/user">Trở về</a></li>
                                </ul>
                            </li>
                        </ul>
                        </div>
                        <div class="body">
                            <form action="" method="POST" class="form-horizontal">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Tên</label>
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
                                        <label for="password_2">Username</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="username" value="<?php echo $filldata['username']; ?>" autocomplete="off" class="form-control" placeholder="Usename">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Password</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="password" value="<?php echo $filldata['password']; ?>" placeholder="Password" autocomplete="off" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Email</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="email" value="<?php echo $filldata['email']; ?>" placeholder="Email" autocomplete="off" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Avatar Link</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="avt" value="<?php echo $filldata['avt']; ?>" placeholder="Avatar Link" autocomplete="off" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Cover Link</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="cover" value="<?php echo $filldata['cover']; ?>" placeholder="Cover Link" autocomplete="off" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Permission</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control show-tick" name="perm">
                                            <option value="0" <?php echo $secu; ?>>User</option>
                                            <option value="1" <?php echo $seca; ?>>Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Disable</label>
                                    </div>
                                    <div class="switch">
                                        <label><input name="status" type="checkbox" <?php if ($filldata['status'] == 1) {
                                                                            echo "checked";
                                                                        } ?>><span class="lever"></span></label>
                                    </div>
                                </div>
                                <p>User Last Session (yy-mm-dd hh:mm:ss): <?php echo $filldata['last_ss']; ?></p>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Để lưu, hãy nhập pass của bạn</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" name="passcon" value="" placeholder="Your Password" autocomplete="off" class="form-control">
                                            </div>
                                        </div>
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
<?php include '../includes/footer.php';
} ?>