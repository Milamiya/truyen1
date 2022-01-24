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

$connn = mysqli_connect($fzthostname,$fztuser,$fztpass) or die($dberror);
mysqli_set_charset($connn, 'UTF8');
mysqli_select_db($connn,$fztdatabase) or die($dberror);
date_default_timezone_set('Asia/Ho_Chi_Minh');
$dba = mysqli_query($connn, "SELECT * FROM movie WHERE hidden=0 ORDER BY id DESC LIMIT 5");
$dbar = mysqli_query($connn, "SELECT * FROM movie WHERE hidden=0 ORDER BY id DESC LIMIT 5");
$dbar1 = mysqli_query($connn, "SELECT * FROM movie WHERE hidden=0 ORDER BY id DESC LIMIT 5");
$x = 1;
function custom_echo($x, $length)
{
    
  if(strlen($x)<=$length)
  {
    echo $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    echo $y;
  }
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <script type="text/javascript">
        document.onkeydown = function(e) {
          if(event.keyCode == 123) {
             return false;
          }
          if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
             return false;
          }
          if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
             return false;
          }
          if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
             return false;
          }
          if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
             return false;
          }
          if(e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)) {
             return false;
          }
          if(e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)) {
             return false;
          }
        }
    </script>
  <meta charset="UTF-8">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://s3-us-west-2.amazonaws.com/s.cdpn.io/1462889/unicons.css'>
<style>
    
@import url('https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&subset=devanagari,latin-ext');


:root {
	--white: #ffffff;
	--black: #000000;
	--dark-blue: #1f2029;
	--dark-light: #424455;
	--red: #da2c4d;
	--yellow: #f8ab37;
	--grey: #ecedf3;
}
body{
	width: 100%;
	height: 100vh;
	background: #202020;
	overflow: hidden;
    font-family: 'Poppins', sans-serif;
	font-size: 16px;
	line-height: 30px;
	-webkit-transition: all 300ms linear;
	transition: all 300ms linear; 
}
p{
    font-family: 'Poppins', sans-serif;
	font-size: 16px;
	line-height: 30px;
	color: var(--white);
	-webkit-transition: all 300ms linear;
	transition: all 300ms linear; 
}
p.small{
	font-size: 12px;
	line-height: 18px;
	letter-spacing: 1px;
}
h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6{
    font-family: 'Poppins', sans-serif;
	margin-bottom: 0.6rem;	
	color: var(--white);
}
h3, .h3 {
	font-size: 38px;
	line-height: 48px;
	font-weight: 700;
	-webkit-transition: all 300ms linear;
	transition: all 300ms linear; 
}
::selection {
	color: var(--white);
	background-color: var(--black);
}
::-moz-selection {
	color: var(--white);
	background-color: var(--black);
}
mark{
	color: var(--white);
	background-color: var(--black);
}
.color-yellow {
    color: var(--yellow);
}
.size-18{
    font-size: 18px;
}
.opacity-40{
	opacity: 0.4;
}
.opacity-60{
	opacity: 0.6;
}
.section {
    position: relative;
	width: 100%;
	display: block;
}
.over-hide {
    overflow: hidden;
}
.full-height {
	height: 100vh;
}
.hero-center-section{
	position: absolute;
	top: 50%;
	left: 0;
	width: 100%;
	z-index: 100;
	transform: translateY(-60%);
	opacity: 0;
	-webkit-transition: all 300ms linear;
	transition: all 300ms linear; 
}
.hero-center-section.show{
	transform: translateY(-50%);
	opacity: 1;
}
.poster-transition.show{
	transform: translateY(0);
	opacity: 1;
	visibility: visible;
}
.z-bigger {
	z-index: 30 !important;
}

.img-wrap {
	position: relative;
	width: 100%;
	overflow: hidden;
	border-radius: 4px;
	box-shadow: 0 8px 25px 0 rgba(0, 0, 0, 0.25);
	display: block;
}
.img-wrap img {
	width: 100%;
	height: auto;
	display: block;
}

.hero-left-section{
	position: absolute;
	top: 50%;
	transform: translateY(-50%);
	left: 30px;
	z-index: 1000;
	-webkit-transition: all 300ms linear;
	transition: all 300ms linear; 
}
.slide-buttons{
	position: relative;
	margin: 0;
	padding: 0;
	list-style: none;
}
.slide-buttons li{
	position: relative;
	display: block;
	margin: 15px 0;
	padding: 0;
	list-style: none;
	cursor: pointer;
	overflow: hidden;
	width: 50px;
	height: 50px;
	border-radius: 4px;
	background-size: cover;
	background-position: center;
	-webkit-transition: all 300ms linear;
	transition: all 300ms linear; 
}
.slide-buttons li:after{
	position: absolute;
	display: block;
	border-radius: 4px;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	content: '';
	background-color: transparent;
	-webkit-transition: all 300ms linear;
	transition: all 300ms linear; 
}
.slide-buttons li.active{
	box-shadow: 0 4px 15px 0 rgba(0, 0, 0, 0.25);
}
.slide-buttons li.active:after{
	background-color: rgba(20,20,20,.4);
}
<?php while($loadcss = mysqli_fetch_array($dba) and $x <= mysqli_num_rows($dba)) {?>
.slide-buttons li:nth-child(<?php echo $x;$x++?>){
	background-image: url('<?php echo $loadcss['poster'];?>');
}
<?php } ?>
.cursor,
.cursor2,
.cursor3{
	position: fixed;
	border-radius: 50%;	
	transform: translateX(-50%) translateY(-50%);
	pointer-events: none;
	left: -100px;
	top: 50%;
	mix-blend-mode: difference;
	-webkit-transition: all 300ms linear;
	transition: all 300ms linear; 
}
.cursor{
	background-color: var(--white);
	height: 0;
	width: 0;
	z-index: 99999;
}
.cursor2,.cursor3{
	height: 36px;
	width: 36px;
	z-index:99998;
	-webkit-transition:all 0.3s ease-out;
	transition:all 0.3s ease-out
}
.cursor2.hover,
.cursor3.hover{
	-webkit-transform:scale(2) translateX(-25%) translateY(-25%);
	transform:scale(2) translateX(-25%) translateY(-25%);
	border:none
}
.cursor2{
	border: 2px solid var(--white);
	box-shadow: 0 0 12px rgba(255, 255, 255, 0.2);
}
.cursor2.hover{
	background: rgba(255,255,255,1);
	box-shadow: 0 0 0 rgba(255, 255, 255, 0.2);
}

.link-to-page {
	position: fixed;
    top: 30px;
    right: 30px;
    z-index: 20000;
    cursor: pointer;
    width: 30px;
}
.link-to-page img{
	width: 100%;
	height: auto;
	display: block;
}
.bottom-right{
	position: absolute;
	bottom: 50px;
	right: 30px;
	z-index: 1000;
}
.switch,
.circle {
	-webkit-transition: all 300ms linear;
	transition: all 300ms linear; 
} 
.switch {
	width: 80px;
	height: 4px;
	border-radius: 27px;
	background-image: linear-gradient(298deg, var(--red), var(--yellow));
	position: relative;
	display: block;
	margin: 0 auto;
	text-align: center;
	opacity: 1;
	transform: translate(0);
    transition: all 300ms linear;
    transition-delay: 1900ms;
}
.circle {
	cursor: pointer;
	position: absolute;
	top: 50%;
	transform: translateY(-50%);
	left: 0;
	width: 40px;
	height: 40px;
	border-radius: 50%;
	background: #404040;
	box-shadow: 0 4px 4px rgba(26,53,71,0.25), 0 0 0 1px rgba(26,53,71,0.07);
}
.circle:hover {
	box-shadow: 0 8px 8px rgba(26,53,71,0.25), 0 0 0 1px rgba(26,53,71,0.07);
}
.circle:before {
	position: absolute;
	font-family: 'unicons';
	content: '\eac1';
	top: 0;
	left: 0;
	z-index: 2;
	font-size: 20px;
	line-height: 40px;
	text-align: center;
	width: 100%;
	height: 40px;
	opacity: 1;
	color: var(--grey);
	-webkit-transition: all 300ms linear;
	transition: all 300ms linear; 
}
.circle:after {
	position: absolute;
	font-family: 'unicons';
	content: '\eb8f';
	top: 0;
	left: 0;
	z-index: 2;
	font-size: 20px;
	line-height: 40px;
	text-align: center;
	width: 100%;
	height: 40px;
	color: var(--yellow);
	opacity: 0;
	-webkit-transition: all 300ms linear;
	transition: all 300ms linear; 
}
.switched {
}
.switched .circle {
	left: 40px;
	box-shadow: 0 4px 4px rgba(26,53,71,0.25), 0 0 0 1px rgba(26,53,71,0.07);
	background: var(--dark);
}
.switched .circle:hover {
	box-shadow: 0 8px 8px rgba(26,53,71,0.25), 0 0 0 1px rgba(26,53,71,0.07);
}
.switched .circle:before {
	opacity: 0;
}
.switched .circle:after {
	opacity: 1;
}
body.light{
	background: var(--white);
}
body.light p{
	color: var(--dark-blue);
}
body.light h3{
	color: var(--dark);
}
body.light .cursor,
body.light .cursor2,
body.light .cursor3{
	mix-blend-mode: difference;
	z-index: 9999999;
}
body.light .cursor{
	background-color: var(--dark-blue);
}
body.light .cursor2{
	border: 2px solid var(--dark-blue);
	box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
}
body.light .cursor2.hover{
	background: rgba(0,0,0,1);
	box-shadow: 0 0 0 rgba(0, 0, 0, 0.2);
}

@media (max-width: 991px) { 
	.hero-center-section{
		left: 50px;
		width: calc(100% - 50px);
	}
	.hero-left-section{
		left: 20px;
	}
	.slide-buttons li{
		width: 30px;
		height: 30px;
	}
}

@media (max-width: 767px) {
	h3, .h3 {
		font-size: 26px;
		line-height: 34px;
	}
  .cursor,
  .cursor2,
  .cursor3{
    display: none;
  }
}

@media (max-width: 575px) {
	h3, .h3 {
		font-size: 22px;
		line-height: 30px;
	}
}
</style>
</head>
<body oncontextmenu="return false;">
<!-- partial:index.partial.html -->
<div class="section full-height over-hide z-bigger">
	<!--Slide 1-->
	<?php while($rowload = mysqli_fetch_array($dbar)) { ?>
		<div class="hero-center-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-sm-5 col-md-5 col-xl-4 align-self-center">
						<div class="img-wrap">
							<img src="<?php echo $rowload['poster'];?>" alt="">
						</div>
					</div>
					<div class="col-12 col-sm-7 col-md-7 col-lg-5 col-xl-4 pl-4 align-self-center mt-4 mt-sm-0 text-center text-sm-left">
						<h3 class="mb-1"><?php echo $rowload['name'];?></h3>
						<p class="small mb-2 opacity-60"><?php echo $rowload['ep'];?> tập<?php if($rowload['coming_soon'] == 1) { echo '<b> - COMING SOON</b>';}?></p>
						<p class="mt-4 pt-2 mb-0 d-none d-sm-block"><?php custom_echo($rowload['description'], 200);?></p>
					</div>
				</div>
			</div>
		</div>
<?php } ?>
		<!--select target-->

		<div class="hero-left-section">
			<ul class="slide-buttons">
			<?php while($li_hover = mysqli_fetch_array($dbar1)) {?>
				<li class="hover-target" onclick="window.open('https://zutafansub.tk/xem-phim/<?php echo $li_hover['slug'];?>.html')"></li>
            <?php } ?>
			</ul>
		</div>

		<!--end select target-->
	</div>

	<!--<div class="bottom-right">								
		<div class="switch">
			<div class="circle hover-target"></div>
		</div>									
	</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script><script  src="./script.js"></script>

</body>
</html>
