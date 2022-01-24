<?php
include 'perm.php';
echo '<title>404 Not Found - '.$titlehead.'</title>';
$home = "active";
include '../includes/header.php';
?>
        <style>
            .main {
                                transform:translate(-50%, -50%);
                top:50%;
                left:50%;
                position: fixed;
                text-align:center;
width:100%
            }
            .bg {
                background-image: linear-gradient(to right top,rgb(0,0,0,.8),rgb(0,0,0,.8)), url('/assets/default/bg/01.jpg');
                background-position: center center;
                background-size: cover;
                position:fixed;
                width:100%;
                height:100%
            }
            .fill {
                background:transparent;
                position: fixed;
                width:100%;
                height:100%;
            }
        </style>
         <div class="bg"></div>
        <div class="fill"></div>
        <div class="main">
            <img id="imgerror" src="/assets/default/default12.png">
        <h1>404 Not Found</h1>
        <p>Không tìm thấy nội dung :((</p>
        <a style="color:gray;font-size:10px">404_NOT_FOUND_CANNOT_REQUEST_APACHE</a>
        </div>
<?php include '../includes/footer.php';?>