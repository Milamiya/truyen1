
<link rel="icon" href="/assets/images/111120/favicon/zutafs-favicon.png" type="image/png">
<?php
$dberror = "
<title></title>
<style>
@import 'https://fonts.googleapis.com/css?family=Google+Sans:100,300,400,500,700,900,100i,300i,400i,500i,700i,900i';
* {
    color:#fff;
    font-family: Google Sans;
}
body {
    background: #202020;
}
</style>
<div style='text-align:center'>
<h1>STOPPED</h1>
<hr>
<p>Copyright&copy ".date("Y")." FZT Fansub Limited
</div>";
$fzthostname = 'localhost';
$fztuser = '';
$fztpass = '';
$fztdatabase = '';

$conn = mysqli_connect($fzthostname,$fztuser,$fztpass) or die($dberror);
mysqli_set_charset($conn, 'UTF8');
mysqli_select_db($conn,$fztdatabase) or die($dberror);
date_default_timezone_set('Asia/Ho_Chi_Minh');

$date_current = '';

$date_current = date("Y-m-d H:i:sa");
//====Get IP ======//
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
$ipload = get_client_ip();
if(isset($_COOKIE['PHPSESSID']) == false ){
        $ssida = date("Ymd").$_COOKIE['PHPSESSID'];
        $daters = date("Y-m-d H:i:s");
        $date_requester = date("Y-m-d");
        if(isset($_COOKIE['id'])) {
            $loginid = $_COOKIE['id'];
        } if(isset($_SESSION['id'])) {
            $loginid = $_SESSION['id'];
        } else {
            $loginid = null;
        }
        mysqli_query($conn, "INSERT INTO `session` (`ip`, `request`, `date`, `login`, `ssid`) VALUES ('$ipload', '$daters','$date_requester', '$loginid', '$ssida')");
    }
$dbset1 = mysqli_query($conn,"SELECT * FROM setting WHERE `id` = '1'");
$dataset1 = mysqli_fetch_array($dbset1);
if($dataset1['maintenance'] == 1) {
    include 'maintenance.html';
    exit;
}
//$titlehead = "zuta fansub / Anime Vietsub";
$titlehead = $dataset1['title'];
$url_main_web = "https://zutafansub.tk";
?>