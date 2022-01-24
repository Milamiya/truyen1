<!--<div onclick="window.location.href='https://fztfansub.tk/?tuyen-thanh-vien'" class="footer-banner">
    <img src="https://cdn.fztfansub.tk/resources/banner/banner01-21102020.png">
</div>-->

<button onclick="runScroll()" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="totop" title="GO TO TOPPPPPPPPPP">
    <i class="fas fa-arrow-up"></i>
</button>
<style>
    .footer-banner {
        position: fixed;
        bottom: -20px;
        background-image: url('https://cdn.fztfansub.tk/resources/nav2-background-hue0.1aba1596.png');
        background-position: bottom;
        background-repeat: repeat-x;
        margin: auto;
        width: 100%;
        z-index: 5;
        opacity: 0.3;
        text-align: center;
        transition: 0.3s;
        -webkit-filter: hue-rotate(var(--base-hue-deg)) saturate(.6);
        filter: hue-rotate(var(--base-hue-deg)) saturate(.6);
    }

    .footer-banner:hover {
        bottom: 0;
        opacity: 1;
    }

    #gobackhome,
    #totop {
        /*position: fixed;
        width: 35px;
        border-radius: 5px;
        height: 35px;
        bottom: 20;
        right: 15px;
        font-size: 25px;
        text-align: center;
        display: none;
        background-color: rgb(40, 40, 40, .5);
        padding: 6px;
        color: #fff;
        transition: 0.2s;
        cursor: pointer;*/
        position: fixed;
        bottom: 20;
        right: 15px;
        z-index: 5;
        display: none;
    }

    /*#gobackhome:hover,
    #totop:hover {
        background-color: rgb(244, 244, 244, .5);
        color: #000;
    }*/
</style>
<script>
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            document.getElementById('totop').style.display = 'block';
            document.getElementById('totop').style.animation = "fade 0.3s";
        } else {
        document.getElementById('totop').style.display = 'none';
        }
    }

    function runScroll() {
        scrollTo(document.body, 0, 200);
    }
    var scrollme;
    scrollme = document.querySelector("#scrollme");
    scrollme.addEventListener("click", runScroll, false)

    function scrollTo(element, to, duration) {
        if (duration <= 0) return;
        var difference = to - element.scrollTop;
        var perTick = difference / duration * 10;

        setTimeout(function() {
            element.scrollTop = element.scrollTop + perTick;
            if (element.scrollTop == to) return;
            scrollTo(element, to, duration - 10);
        }, 1);
    }
</script>
<script>
    var error_loader = '<meta charset="utf-8"><title>Lỗi không xác định - <?php echo $titlehead;?></title><style>@import "https://fonts.googleapis.com/css?family=Google+Sans:100,300,400,500,700,900,100i,300i,400i,500i,700i,900i";* {color:#fff !important;margin: 0px;padding: 0px;font-smooth: always;-khtml-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;font-family: Google Sans !important;text-align:center}body {background:#202020}</style><h1>Lỗi không xác định</h1><a href="">Nhấn vào đây để refresh lại trang</a><a style="position:fixed;bottom:0;font-size:12px;color:#808080 !important;left:10px">&copy 2020 Zuta Fansub - session id: <?php echo $_COOKIE['PHPSESSID'];?></a>';
document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
});
document.onkeydown = function(e) {
    if (event.keyCode == 123) {
        document.head.remove();
        document.body.remove();
        console.clear();
        console.log("Lỗi không xác định --- session id: <?php echo $_COOKIE['PHPSESSID'];?>");
        console.log("Liên hệ với admin Zuta Fansub để được hỗ trợ, email: manager@zutafansub.tk");
        document.write(error_loader);
        return false;
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
        document.head.remove();
        document.body.remove();
        console.clear();
        console.log("Lỗi không xác định --- session id: <?php echo $_COOKIE['PHPSESSID'];?>");
        console.log("Liên hệ với admin Zuta Fansub để được hỗ trợ, email: manager@zutafansub.tk");
        document.write(error_loader);
        return false;
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
        document.head.remove();
        document.body.remove();
        console.clear();
        console.log("Lỗi không xác định --- session id: <?php echo $_COOKIE['PHPSESSID'];?>");
        console.log("Liên hệ với admin Zuta Fansub để được hỗ trợ, email: manager@zutafansub.tk");
        document.write(error_loader);
        return false;
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
        document.head.remove();
        document.body.remove();
        console.clear();
        console.log("Lỗi không xác định --- session id: <?php echo $_COOKIE['PHPSESSID'];?>");
        console.log("Liên hệ với admin Zuta Fansub để được hỗ trợ, email: manager@zutafansub.tk");
        document.write(error_loader);
        return false;
    }
    if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
        document.head.remove();
        document.body.remove();
        console.clear();
        console.log("Lỗi không xác định --- session id: <?php echo $_COOKIE['PHPSESSID'];?>");
        console.log("Liên hệ với admin Zuta Fansub để được hỗ trợ, email: manager@zutafansub.tk");
        document.write(error_loader);
        return false;
    }
}
console.clear();
console.log("%c Zuta Fansub", "font-weight: bold; font-size: 50px;color: red; font-family:Arial");
console.log("%c © 2020 Zuta Team - Developed by Nguyen Anh Duc", "font-family:Arial");
console.log("%c À rế??? Bạn đi đâu đấy :(((, đừng vọc web của mình nhé hic :(((", "font-family:arial");
(function(url) {
    // Create a new `Image` instance
    var image = new Image();

    image.onload = function() {
        // Inside here we already have the dimensions of the loaded image
        var style = [
            // Hacky way of forcing image's viewport using `font-size` and `line-height`
            'font-size: 1px;',
            'line-height: ' + this.height + 'px;',

            // Hacky way of forcing a middle/center anchor point for the image
            'padding: ' + this.height * .5 + 'px ' + this.width * .5 + 'px;',

            // Set image dimensions
            'background-size: ' + this.width + 'px ' + this.height + 'px;',

            // Set image URL
            'background: url(' + url + ');'
        ].join(' ');

        // notice the space after %c
        console.log('%c ', style);
    };

    // Actually loads the image
    image.src = url;
})('https://i.imgur.com/Ig6VKrU.jpg');
</script>
<div id="CSS_FOOTER">
    <link id="auto_light" rel="stylesheet" href="<?php echo $url_main_web; ?>/css/app_auto_light.css">
    <!--<link id="light_css" rel="stylesheet" href="<?php echo $url_main_web; ?>/css/app_light.css">-->
</div>
</div>
</body>