<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width" />
  <title>Tài khoản đã bị vô hiệu hoá</title>
  <link rel="stylesheet" href="style.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.min.css">
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
<style>
* {font-family:Google Sans !important}
.material-icons{ font-family:Material Icons !important}
body {background-color:#121212;color:#fff}
#main {position:fixed;width:90%;left:50%;top:50%;transform:translate(-50%,-50%);text-align:left}
  @media only screen and (min-width:900px) {
    #main {
      width:50%
    }
  }
</style>
</head>
<body>
<div id="main">
<a style="display:block" href="https://zutafansub.tk"><img style="float: left;-webkit-filter: brightness(0) invert(1);
        filter: brightness(0) invert(1);" src="https://zutafansub.tk/assets/images/111120/favicon/zutafs-favicon.png" width="70px"></a><br><br><br>
<h5>Tài khoản của bạn đã bị khoá</h5>
Hiện tại, tài khoản của bạn đã bị khoá do vi phạm điều khoản sử dụng hoặc do clone acc, để mở tài khoản, vui lòng liên hệ với admin Zuta Fansub (hoặc qua mail: manager@zutafansub.tk)
<div id="mdl-btn-bottom" style="width:100%;text-align:center;margin-top:10px">
<button id="logout" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
  <span class="material-icons">exit_to_app</span>&#x20;&#x20;Đăng xuất
</button>
</div>
</div>
<div id="dialog_bottom" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>
<script>
(function() {
  'use strict';
  window['counter'] = 0;
  var snackbarContainer = document.querySelector('#dialog_bottom');
  var showToastButton = document.querySelector('#logout');
  showToastButton.addEventListener('click', function() {
    'use strict';
    var data = {message: 'Bạn sẽ được chuyển hướng sau giây lát :>'};
setTimeout(function(){
window.location.href="/dang-xuat";
},2200);
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
  });
}());
</script>
</body>
</html>