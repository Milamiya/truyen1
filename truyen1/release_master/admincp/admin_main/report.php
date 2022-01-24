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

$sql = "SELECT * FROM reporting";
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
    $data = mysqli_query($conn, "SELECT * FROM `reporting` ORDER BY id DESC");
    $load = mysqli_num_rows($data);
} else {
    $data = mysqli_query($conn, "SELECT * FROM `reporting` ORDER BY id DESC LIMIT " . $offset . "," . $items_per_page . "");
    $load = mysqli_num_rows($data);
}
if (isset($_POST['clearlog'])) {
    mysqli_query($conn, "DELETE FROM session");
    mysqli_query($conn, "ALTER TABLE reporting AUTO_INCREMENT=1;");
    echo '<script>window.location.href=""</script>';
}
?>
<title>Báo lỗi - <?php echo $titlecp; ?></title>
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
                            Tất cả lượt báo lỗi từ user: <?php echo $row_count; ?>
                            <small>Báo lỗi từ user gửi về</small>
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
                                        <li><a href="/session">Trở lại</a>
                                        <?php } ?>
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
                                    <th>Date</th>
                                    <th>Content</th>
                                    <th>by User</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
                                    $idvidrp = $row['film_id'];
                                    $loadrp = mysqli_query($conn, "SELECT * FROM video WHERE id='$idvidrp'");
                                    $datarp = mysqli_fetch_array($loadrp);
                                    $idusrrp = $row['by_id'];
                                    $loadurp = mysqli_query($conn, "SELECT * FROM users WHERE id='$idusrrp'");
                                    $dataurp = mysqli_fetch_array($loadurp);
                                    $idrowsload = $row['id'];
                                    if(isset($_POST['del_this_rpid'.$idrowsload])) {
                                    mysqli_query($conn, "DELETE FROM `reporting` WHERE `reporting`.`id` = '$idrowsload'");
                                    echo '<script>window.location.href=""</script>';
                                }
                                ?>
                                    <tr>
                                        <td><?php echo $row['date']; ?></td>
                                        <td><?php echo $datarp['title']; ?></td>
                                        <td><?php echo $dataurp['name']; ?></td>
                                        <td>
                                        <ul style="list-style-type:none;" class="header-dropdown m-r--5">
                                                <li class="dropdown">
                                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                        <i class="material-icons">keyboard_arrow_down</i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                    <li><a href="javascript:void(0);"><form action="" method="POST"><button type="submit" name="del_this_rpid<?php echo $row['id']; ?>" class="fztcp_sbutton"><span class="material-icons">delete_forever</span>Xóa báo lỗi này</button></form></a></li>
                                                        <li><a href="javascript:window.open('<?php echo $fztcp_domain;?>/xem-video/<?php echo $datarp['slug']; ?>.html')"><span class="material-icons">open_in_new</span> Mở trong tab mới</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php }; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if (!isset($_GET['showall'])) { ?>
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