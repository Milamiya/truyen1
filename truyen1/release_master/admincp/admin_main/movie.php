<?php
include '../system/perm.php';
$video = 1;
$movie = 1;
include '../includes/header.php';
$page = 1;
if (!empty($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    if (false === $page) {
        $page = 1;
    }
}

// set the number of items to display per page
$items_per_page = 50;

$sql = "SELECT * FROM movie";
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
$search = addslashes($_GET['q']);
filter_var($search, FILTER_SANITIZE_STRING);
if (isset($_GET['q'])) {
    if (intval($_GET['q'])) {
        $data = mysqli_query($conn, "select * from `movie` WHERE `id` like '%$search%' ORDER BY id DESC");
        $load = mysqli_num_rows($data);
    } else {
        $data = mysqli_query($conn, "select * from `movie` WHERE `name` like '%$search%' ORDER BY id DESC");
        $load = mysqli_num_rows($data);
    }
} else {
    $data = mysqli_query($conn, "SELECT * FROM `movie` ORDER BY id DESC LIMIT " . $offset . "," . $items_per_page . "");
    $load = mysqli_num_rows($data);
}
?>
<title>Phim - <?php echo $titlecp; ?></title>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>QUẢN LÝ VIDEO</h2>
        </div>
        <!-- Hover Rows -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Tất cả phim: <?php echo $row_count; ?>
                            <small>Đống phim nằm đây hết :))</small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="/phim/new">Tạo phim mới</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>POSTER</th>
                                    <th>NAME</th>
                                    <th>EPISODE</th>
                                    <th>TOOLS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) :
                                $idrowsload = $row['id'];
                                if(isset($_POST['del_this_mvid'.$idrowsload])) {
                                    mysqli_query($conn, "DELETE FROM `movie` WHERE `movie`.`id` = '$idrowsload'");
                                    echo '<script>window.location.href=""</script>';
                                }
                                ?>
                                    <tr>
                                        <td id="avt"><img src="<?php echo $row['poster']; ?>" width="50px" height="66.67px"></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td id="name"><?php echo $row['ep']; ?></td>
                                        <td>
                                            <ul style="list-style-type:none;" class="header-dropdown m-r--5">
                                                <li class="dropdown">
                                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                        <i class="material-icons">keyboard_arrow_down</i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                    <li><a href="javascript:void(0);"><form action="" method="POST"><button type="submit" name="del_this_mvid<?php echo $row['id']; ?>" class="fztcp_sbutton"><span class="material-icons">delete_forever</span>Xóa phim này</button></form></a></li>
                                                        <li><a href="/phim/edit/?id=<?php echo $row['id']; ?>"><span class="material-icons">edit</span> Chỉnh sửa</a></li>
                                                        <li><a href="javascript:window.open('<?php echo $fztcp_domain;?>/xem-phim/<?php echo $row['slug']; ?>')"><span class="material-icons">open_in_new</span> Mở trong tab mới</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="footer">
                        <?php
                        for ($i = 1; $i <= $page_count; $i++) {
                            if ($i === $page) { // this is current page 
                        ?>
                                <button class="btn btn-primary m-t-15 waves-effect"  style="background-color:transparent;cursor:inherit" disabled><?php echo $i; ?></button>
                            <?php } else { // show link to other page  
                            ?>
                                <button class="btn btn-primary m-t-15 waves-effect"  style="background-color:transparent;cursor:pointer"  onclick="window.location.href='?page=<?php echo $i; ?>'"><?php echo $i; ?></button>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Hover Rows -->
    </div>
</section>
<?php include '../includes/footer.php'; ?>