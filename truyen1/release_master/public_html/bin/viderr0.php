
<!DOCTYPE html>
<html>
    <head>
        <script src="/js/bin.js"></script>
        <style>
            @import 'https://fonts.googleapis.com/css?family=Grandstander';
            @import 'https://fonts.googleapis.com/css?family=Roboto';
            @import 'https://fonts.googleapis.com/css?family=Quicksand';
            * {
                margin:0px;
            }
            body {
                margin:0px;
                font-family: Roboto;
                color:#fff;
            }
            .main {
                                transform:translate(-50%, -50%);
                top:50%;
                left:50%;
                position: fixed;
                text-align:center;
            }
            .bg {
                background-image: linear-gradient(to right top,rgb(0,0,0,.8),rgb(0,0,0,.8)), url('https://cdn.fztfansub.tk/resources/default/bg/01.jpg');
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
        <div class="main">
            <img id="imgerror" src="/assets/default/default12.png">
        <h1>Error</h1>
        <p>Vui lòng liên hệ với quản trị viên để fix lỗi hic :((</p>
        </div>
        <div class="fill"></div>
    </body>
</html>