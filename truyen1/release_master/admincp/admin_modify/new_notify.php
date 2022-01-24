<?php
include '../system/perm.php';
$other = 1;
include '../includes/header.php';
if(isset($_POST['btnsubmit'])) {
    $title = $_POST['title'];
    $type = $_POST['type'];
    $fid = $_POST['fid'];
    $ct = $_POST['content'];
    $datenow = date("Y-m-d H:i:s");
    $datelog = date("Y-m-d H:i:s");
        $contentlog = "Created notify '" . $title . "' - by: " . $lo11['name'];
        $byid = $lo11['id'];
        mysqli_query($conn, "INSERT INTO `log` (`content`, `date`, `by_id`) VALUES ('$contentlog', '$datelog', '$byid')");
    mysqli_query($conn, "INSERT INTO `notify` (`title`, `content`, `type`, `for_id`, `by_id`, `date`) VALUES ('$title', '$ct', '$type', '$fid', '$usrid', '$datenow')");
    echo '<script>window.location.href="/notify"</script>';
}
?>
<title>Tạo thông báo mới - <?php echo $titlecp; ?></title>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>CHỨC NĂNG QUẢN LÝ KHÁC</h2>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Tạo thông báo mới
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
                                    <li><a href="/notify">Trở về</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                    <form action="" method="POST" class="form-horizontal">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Title</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="title" autocomplete="off" class="form-control" placeholder="Title">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Content</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="content" autocomplete="off" class="form-control" placeholder="Content">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">For id (0 = all, "id" for "id" user)</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number" name="fid" autocomplete="off" class="form-control" placeholder="For user">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Type notify</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control show-tick" name="type">
                                            <option value="0">Notification</option>
                                            <option value="1">Warning</option>
                                            <option value="2">Error</option>
                                            <option value="3">New</option>
                                        </select>
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
<?php
include '../includes/footer.php'; ?>