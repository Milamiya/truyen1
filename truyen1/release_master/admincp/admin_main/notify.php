<?php
include '../system/perm.php';
$other = 1;
include '../includes/header.php';
$page = 1;
if (!empty($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    if (false === $page) {
        $page = 1;
    }
}

// set the number of items to display per page
$items_per_page = 100;

$sql = "SELECT * FROM notify";
$result = mysqli_query($conn, $sql);
$row_count = mysqli_num_rows($result);
mysqli_free_result($result);
$offset = ($page - 1) * $items_per_page;
$page_count = 0;
if (0 === $row_count) {
} else {
    $page_count = (int)ceil($row_count / $items_per_page);
    if ($page > $page_count) {
        $page = 1;
    }
}
if (isset($_GET['showall'])) {
    $data = mysqli_query($conn, "SELECT * FROM `notify` ORDER BY id DESC");
    $load = mysqli_num_rows($data);
} else {
    if(!isset($_GET['mynotify'])) {
        $data = mysqli_query($conn, "SELECT * FROM `notify` ORDER BY id DESC LIMIT " . $offset . "," . $items_per_page . "");
        $load = mysqli_num_rows($data);
    } else {
        $data = mysqli_query($conn, "SELECT * FROM `notify` WHERE `for_id` = '$usrid' ORDER BY id DESC");
        $load = mysqli_num_rows($data);
    }
}
if (isset($_POST['clearlog'])) {
    $datelog = date("Y-m-d H:i:s");
        $contentlog = "Đã xóa hết tất cả thông báo - by: " . $lo11['name'];
        $byid = $lo11['id'];
        mysqli_query($conn, "INSERT INTO `log` (`content`, `date`, `by_id`) VALUES ('$contentlog', '$datelog', '$byid')");
    mysqli_query($conn, "DELETE FROM notify");
    mysqli_query($conn, "ALTER TABLE notify AUTO_INCREMENT=1;");
    echo '<script>window.location.href=""</script>';
}
?>
<title>Thông báo - <?php echo $titlecp; ?></title>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>CHỨC NĂNG QUẢN LÝ KHÁC</h2>
        </div>
        <!-- Hover Rows -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Tất cả các thông báo: <?php if(!isset($_GET['mynotify'])) {echo $row_count;} else {echo $load;} ?>
                            <small>Thông báo cho người dùng biết.. bla bla</small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">
                                            <form action="" method="POST"><button type="submit" name="clearlog" class="fztcp_sbutton">Xóa tất cả</button></form>
                                        </a></li>
                                    <?php if (!isset($_GET['showall'])) { ?>
                                        <li><a href="javascript:alearter_log()">Hiện tất cả</a>
                                        <?php } else { ?>
                                        <li><a href="/notify">Trở lại</a>
                                        <?php } ?>
                                        <li><a href="/notify/new">Tạo thông báo mới</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <script type="text/javascript">
                        function alearter_log() {
                            if (confirm("Có chắc là sẽ hiện tất cả không :v\nLag máy đừng có trách :))") == true) {
                                window.location.href = '?showall';
                            }
                        }
                    </script>
                    <div class="body table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Type</th>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) :
                                $notid = $row['id'];
                                if(isset($_POST['delid'.$notid])) {
                                    mysqli_query($conn, "DELETE FROM `notify` WHERE `notify`.`id` = '$notid';");
                                    $datelog = date("Y-m-d H:i:s");
        $contentlog = "Đã xóa thông báo id '" . $notid . "' - by: " . $lo11['name'];
        $byid = $lo11['id'];
        mysqli_query($conn, "INSERT INTO `log` (`content`, `date`, `by_id`) VALUES ('$contentlog', '$datelog', '$byid')");
                                    echo '<script>window.location.href=""</script>';
                                }
                                ?>
                                    <tr>
                                        <td style="text-align: left;"><?php echo $row['title']; ?></td>
                                        <td style="text-align: left;"><?php echo $row['content']; ?></td>
                                        <td><?php if ($row['type'] == 1) {
                                                echo "Warning";
                                            } elseif ($row['type'] == 2) {
                                                echo "Error";
                                            } elseif ($row['type'] == 3) {
                                                echo "New";
                                            } else {
                                                echo "Notification";
                                            } ?></td>
                                        <td><?php if ($row['for_id'] == 0) {
                                                echo "All";
                                            } else {
                                                echo $row['for_id'];
                                            } ?></td>
                                        <td><?php echo $row['date']; ?></td>
                                        <td>
                                            <ul style="list-style-type:none;" class="header-dropdown m-r--5">
                                                <li class="dropdown">
                                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                        <i class="material-icons">keyboard_arrow_down</i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li><a href="javascript:void(0);">
                                                                <form action="" method="POST"><button type="submit" name="delid<?php echo $row['id']; ?>" class="fztcp_sbutton"><span class="material-icons">delete_forever</span>Xóa thông báo này</button></form>
                                                            </a></li>

                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if (empty($_GET['showall']) or empty($_GET['mynotify'])) { ?>
                        <div class="footer">
                            <?php
                            for ($i = 1; $i <= $page_count; $i++) {
                                if ($i === $page) { // this is current page 
                            ?>
                                    <button class="btn btn-primary m-t-15 waves-effect" style="background-color:transparent;cursor:inherit" disabled><?php echo $i; ?></button>
                                <?php } else { // show link to other page  
                                ?>
                                    <button class="btn btn-primary m-t-15 waves-effect" style="background-color:transparent;cursor:pointer" onclick="window.location.href='?page=<?php echo $i; ?>'"><?php echo $i; ?></button>
                            <?php }
                            } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- #END# Hover Rows -->
    </div>
</section>
<?php include '../includes/footer.php'; ?>