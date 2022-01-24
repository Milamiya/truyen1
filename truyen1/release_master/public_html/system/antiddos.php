<?php
/*
////////////////////////////////////////////////////////////
Antiddos php module, powered by XakNet.Ru – S(r1pt
Work on IPTABLES!!!
Paste into the beginning of a script via include
For the anti-ddos to operate, you need to have access to the ’system‘ function and an iptables command. If it’s not available, all blocked ips go into ‚banned_ips‘.
It’s the best to put anti-ddos on VPS or dedicated server.
Going to work against an average DDOS. (If it works through iptables)
Comments translated by –Î£–
\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
*/
$debug = false; // debug mode, disabled ban, simply shows a message if the IP was banned or not.
if ($debug) error_reporting(E_ALL);
else error_reporting(0);

/* Possible values – $ddos 1-5:
| 1. Check using cookies(recommended)
| 2. Double check using $_GET antiddos and meta refresh
| 3. Authorization request WWW-Authenticate
| 4. Disables the site completely, bots aren’t being blocked!!!
| 5. Turn the site off if the load is too high, bots aren’t being blocked!!!
*/

$ddos = 1;
$log = false;
$dir = dirname(__file__) . ‚/cyki_bots/‘; //DDOS log directory, create it and chmod 777
$ddos_redirect_host = "http://google.com/"; // Host to which redirect DDOS
$icq = "123456"; //Admins ICQ
$off_message = "We are experiencing technical difficulties."; //Message if website is down.
$anticyka = md5(sha1(‚botik‘ . strrev(getenv(‚HTTP_USER_AGENT‘))));
$ban_message = ‚You have been blocked. If you believe this is a mistake, contact an administrator, icq of admin:‘ .
$icq . ‚<hr>(c)XakNet antiddos module‘; // Ban message
$exec_ban = "iptables -A INPUT -s " . $_SERVER["REMOTE_ADDR"] . " -j DROP";
$load = sys_getloadavg(); // Function for retrieving load average \=\
$ddosuser = ‚lol_ddos‘;
$ddospass = substr(ip2long($_SERVER[‚REMOTE_ADDR‘]), 0, rand(2, 4));
//not tested //checks if those are crawlers:

$google = strpos(gethostbyaddr($_SERVER[‚REMOTE_ADDR‘]), "googlebot.com") !== false;
$yandex = strpos(gethostbyaddr($_SERVER[‚REMOTE_ADDR‘]), "yandex.ru") !== false;
$rambler = strpos(gethostbyaddr($_SERVER[‚REMOTE_ADDR‘]), "ramtel.ru") !== false;
$rambler2 = strpos(gethostbyaddr($_SERVER[‚REMOTE_ADDR‘]), "rambler.ru") !== false;
$aport = strpos(gethostbyaddr($_SERVER[‚REMOTE_ADDR‘]), "aport.ru") !== false;
$sape = strpos(gethostbyaddr($_SERVER[‚REMOTE_ADDR‘]), "sape.ru") !== false;
$msn = strpos(gethostbyaddr($_SERVER[‚REMOTE_ADDR‘]), "msn.com") !== false;
$yahoo = strpos(gethostbyaddr($_SERVER[‚REMOTE_ADDR‘]), "yahoo.net") !== false;
//
if(!file_exists($dir . ‚banned_ips‘)) file_put_contents($dir . ‚banned_ips‘, “);
if (strstr(file_get_contents($dir . ‚banned_ips‘), $_SERVER[‚REMOTE_ADDR‘]))
die($ban_message); //GTFO )

if (! $google || ! $yandex || ! $rambler || ! $rambler2 || ! $aport || ! $sape ||
! $msn || ! $yahoo) {

$f = fopen($dir . $_SERVER["REMOTE_ADDR"], "a");
fwrite($f, "zapros cyka\n");
fclose($f);
function ban()
{
if (! system($exec_ban)) {
$f = fopen($dir . ‚banned_ips‘, "a");
fwrite($f, $_SERVER[‚REMOTE_ADDR‘] . ‚|‘);
fclose($f);
}
echo $ban_message;
header(‚Location: ‚ . $ddos_redirect_host . “);
die();
}
switch ($ddos) {
///////////////////////////
case 1:
if (empty($_COOKIE[‚ddos‘]) or ! $_COOKIE[‚ddos‘]) {
$counter = @file($dir . $_SERVER["REMOTE_ADDR"]);
setcookie(‚ddos‘, $anticyka, time() + 3600 * 24 * 7 * 356); // Ð½Ð° Ð³Ð¾Ð´ Ð½Ð°Ñ….
if (count($counter) > 10) {
if (! $debug) ban();

else die("Blocked");

}
if (! $_COOKIE[‚ddos_log‘] == ‚bil‘) {
if (! $_GET[‚antiddos‘] == 1) {
setcookie(‚ddos_log‘, ‚bil‘, time() + 3600 * 24 * 7 * 356); 
header("Location: ./?antiddos=1");
}
}
} elseif ($_COOKIE[‚ddos‘] !== $anticyka) {
if (! $debug) ban();

else die("Blocked.");

}
break;
/////////////////////////
case 2:
if (empty($_COOKIE[‚ddos‘])) {
if (empty($_GET[‚antiddos‘])) {
if (! $_COOKIE[‚ddos_log‘] == ‚bil‘)
//Checking cookies for request
die(‚<meta http-equiv="refresh" content="0;URL=?antiddos=‘ . $anticyka . ‚" />‘);

} elseif ($_GET[‚antiddos‘] == $anticyka) {
setcookie(‚ddos‘, $anticyka, time() + 3600 * 24 * 7 * 356);
setcookie(‚ddos_log‘, ‚bil‘, time() + 3600 * 24 * 7 * 356);
}
else {

if (! $debug) {
ban();
die("May be shall not transform address line?");
}
else {
echo "May be shall not transform address line?";
die("Blocked.");
}
}
}
break;
case 3:
if (! isset($_SERVER[‚PHP_AUTH_USER‘]) || $_SERVER[‚PHP_AUTH_USER‘] !== $ddosuser ||
$_SERVER[‚PHP_AUTH_PW‘] !== $ddospass) {
header(‚WWW-Authenticate: Basic realm="Vvedite parol\‘: ‚ . $ddospass .
‚ | Login: ‚ . $ddosuser . ‚"‘);
header(‚HTTP/1.0 401 Unauthorized‘);
if (! $debug) ban();

else die("Blocked");

die("<h1>401 Unauthorized</h1>");
}
break;
case 4:
die($off_message); //site disabled
break;
case 5:
if ($load[0] > 80) {
header(‚HTTP/1.1 503 Too busy, try again later‘);
die(‚<center><h1>503 Server too busy.</h1></center><hr><small><i>Server too busy. Please try again later. Apache server on ‚ .
$_SERVER[‚HTTP_HOST‘] .
‚ at port 80</a></i></small>‘);
}
break;
default:
break;
//////////////////////////
}
if ($_COOKIE[‚ddos‘] == $anticyka) @unlink($dir . $_SERVER["REMOTE_ADDR"]);
}
//////////////////////////////
//powered by xaknet.ru

?>