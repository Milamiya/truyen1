<?php
include '../system/perm.php';
echo '<title>' . $titlehead . '</title>';
$home = "active";
include '../includes/header.php';
if ($data1['username'] == null) {
    echo "<meta http-equiv='refresh' content='0; url=/'>";
    exit();
}
$query_user_ip_page = mysqli_query($conn, "SELECT * FROM user_ip WHERE `user_ip`.`for_user` = '$usrid' ORDER BY id DESC");
?>
<div class="mainip">
    <h1>Lịch sử đăng nhập</h1>
    <table style="width:100%;background:#404040" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
        <thead>
            <th>IP</th>
            <th>Thời gian</th>
            <th>Loại thiết bị</th>
            <th>Tên trình duyệt</th>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($query_user_ip_page)) { ?>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric"><?php echo $row['ip']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php
                        if ($row['type'] == 2) {
                            echo '<span class="material-icons">tablet_mac</span> Máy tính bảng (tablet)';
                        } elseif ($row['type'] == 1) {
                            echo '<span class="material-icons">phone_iphone</span> Điện thoại (phone)';
                        } else {
                            echo '<span class="material-icons">computer</span> Máy tính (pc)';
                        } ?></td>
                    <td><?php echo $row['name']; ?></td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
    <a><b>LƯU Ý:</b> Nếu như bạn thấy địa điểm đăng nhập mới nhưng mà lại đăng nhập trên cùng 1 mạng (wifi,lan - non fake vpn :v) thì đó là do IPv6 của mỗi máy khác nhau!</a>
</div>
<style>
    .mainip {
        padding: 100px 20px 20px;
    }
</style>
<?php
include '../includes/footer.php';
?>