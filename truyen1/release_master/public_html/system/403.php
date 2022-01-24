<?php
include 'perm.php';
echo '<title>403 Forbidden - FZTfansub / Anime Vietsub</title>';
$home = "active";
include '../includes/header.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="/js/bin.js"></script>
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
        <meta charset="utf-8">
        <script src="https://kit.fontawesome.com/1900d94ea7.js" crossorigin="anonymous"></script>
    </head>
    <body>
         <div class="bg"></div>
                 <div class="fill"></div>
        <div class="main">
            <img id="imgerror" src="https://cdn.fztfansub.tk/resources/default/default12.png">
        <h1>403 Forbidden</h1>
        <p>Bạn không có quyền truy cập vào đây :((</p>
        <a style="color:gray;font-size:10px">403_FORBIDDEN_RESOURCE_CANNOT_ACCESS_APACHE</a>
        </div>
    </body>
</html>
<?php include '../includes/footer.php';?>