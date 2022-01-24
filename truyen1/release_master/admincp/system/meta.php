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
<h1>ERROR 2003 (HY000): Can't connect to MySQL server on localhost (10061)</h1>
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
$titlecp = "Zuta Fansub - zutafansub.tk | FZTcp v3.1.6";
$fztcp_version = "fztcp-material.3.1.6-b221120316";
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
$fztcp_domain = "https://zutafansub.tk";
$fztcp_domain1 = "zutafansub.tk";
?>