/*header function
(c) 2020 FZT Team - Developed by Nguyen Anh Duc
The FZTfansub */
function clsnav() {
    document.getElementById("navope").style.animation = "clfd 0.5s";
    document.getElementById("fillnav").style.animation = "fadecl 0.5s";
    document.body.style.overflow = "auto";
    setTimeout(function() {
        document.getElementById("navope").style.display = "none";
        document.getElementById("fillnav").style.display = "none";
        document.getElementById("mainnav").style.display = "none";
    }, 480);
}

function opnav() {
    document.getElementById("navope").style.animation = "opfd 0.5s";
    document.getElementById("fillnav").style.animation = "fade 0.5s";
    document.getElementById("navope").style.display = "block";
    document.getElementById("fillnav").style.display = "block";
    document.getElementById("mainnav").style.display = "block";
    document.body.style.overflow = "hidden";
}
/*function logout() {
    if (confirm("Bạn có muốn đăng xuất không?\nFZTfansub")) {
        window.location.href='/dang-xuat';
    } else {
        alert("You are so cool ^_^")
    }
}*/
function openusrbox() {
    document.getElementById("usrbox").style.animation = "opusr 0.5s";
    document.getElementById("usrbox").style.display = "block";
    document.getElementById("fillnav1").style.animation = "fade 0.5s";
    document.getElementById("fillnav1").style.display = "block";
    document.body.style.overflow = "hidden";
}

function closeusrbox() {
    document.getElementById("usrbox").style.animation = "clusr 0.5s";
    document.getElementById("fillnav1").style.animation = "fadecl 0.5s";
    document.body.style.overflow = "auto";
    setTimeout(function() {
        document.getElementById("usrbox").style.display = "none";
        document.getElementById("fillnav1").style.display = "none";
    }, 480);
}
document.onkeydown = function() {
        if (event.keyCode == 27) {
            closeusrbox();
            clsnav();
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'Q'.charCodeAt(0)) {
            logout();
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'U'.charCodeAt(0)) {
            openusrbox();
        }
    }
    //move userbox
dragElement(document.getElementById("usrbox"));

function dragElement(elmnt) {
    var pos1 = 0,
        pos2 = 0,
        pos3 = 0,
        pos4 = 0;
    if (document.getElementById(elmnt.id + "header")) {
        /* if present, the header is where you move the DIV from:*/
        document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
    } else {
        /* otherwise, move the DIV from anywhere inside the DIV:*/
        elmnt.onmousedown = dragMouseDown;
    }

    function dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();
        // get the mouse cursor position at startup:
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        // call a function whenever the cursor moves:
        document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        // calculate the new cursor position:
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        // set the element's new position:
        elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
        elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    }

    function closeDragElement() {
        /* stop moving when mouse button is released:*/
        document.onmouseup = null;
        document.onmousemove = null;
    }
}

//move logout


dragElement(document.getElementById("msglg"));

function dragElement(elmnt) {
    var pos1 = 0,
        pos2 = 0,
        pos3 = 0,
        pos4 = 0;
    if (document.getElementById(elmnt.id + "header")) {
        /* if present, the header is where you move the DIV from:*/
        document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
    } else {
        /* otherwise, move the DIV from anywhere inside the DIV:*/
        elmnt.onmousedown = dragMouseDown;
    }

    function dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();
        // get the mouse cursor position at startup:
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        // call a function whenever the cursor moves:
        document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        // calculate the new cursor position:
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        // set the element's new position:
        elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
        elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    }

    function closeDragElement() {
        /* stop moving when mouse button is released:*/
        document.onmouseup = null;
        document.onmousemove = null;
    }
}

function opnotify() {
    document.getElementById("notify_nav").style.display = "block";
    document.getElementById("notify_nav").style.animation = "opfdn 0.5s";
    document.getElementById("fillnav5").style.display = "block";
    document.getElementById("fillnav5").style.animation = "fade 0.5s";
    document.body.style.overflow = "hidden";
}

function clnotify() {
    document.getElementById("notify_nav").style.animation = "clfdn 0.5s";
    document.getElementById("fillnav5").style.animation = "fadecl 0.5s";
    document.body.style.overflow = "auto";
    setTimeout(function() {
        document.getElementById("notify_nav").style.display = "none";
        document.getElementById("fillnav5").style.display = "none";
    }, 480);
}

function clsearch() {
    document.getElementById("search_nav").style.animation = "fadecl 0.5s";
    document.getElementById("fillnav6").style.animation = "fadecl 0.5s";
    setTimeout(function() {
        document.getElementById("search_nav").style.display = "none";
        document.getElementById("fillnav6").style.display = "none";
    }, 480);
}

function opsearch() {
    document.getElementById("search_nav").style.animation = "fade 0.5s";
    document.getElementById("fillnav6").style.animation = "fade 0.5s";
    document.getElementById("fillnav6").style.display = "block";
    document.getElementById("search_nav").style.display = "block";
}

function open_login_dialog() {
    var home_login_dialog = document.getElementById("loginDialogbruh");
    var home_login_overlay = document.getElementById("loginDialog_overlay");
    home_login_dialog.style.display = "block";
    home_login_overlay.style.display = "block";
    home_login_overlay.style.animation = "fade 0.5s";
    home_login_dialog.style.animation = "open_login_dialog 0.5s";
}

function close_login_dialog() {
    var home_login_dialog = document.getElementById("loginDialogbruh");
    var home_login_overlay = document.getElementById("loginDialog_overlay");
    home_login_overlay.style.animation = "fadecl 0.5s";
    home_login_dialog.style.animation = "close_login_dialog 0.5s";
    setTimeout(function() {
        home_login_dialog.style.display = "none";
        home_login_overlay.style.display = "none";
    }, 480);
}

function open_reg_dialog() {
    var home_reg_dialog = document.getElementById("regDialogbruh");
    var home_reg_overlay = document.getElementById("regDialog_overlay");
    home_reg_dialog.style.display = "block";
    home_reg_overlay.style.display = "block";
    home_reg_overlay.style.animation = "fade 0.5s";
    home_reg_dialog.style.animation = "open_reg_dialog 0.5s";
}

function close_reg_dialog() {
    var home_reg_dialog = document.getElementById("regDialogbruh");
    var home_reg_overlay = document.getElementById("regDialog_overlay");
    home_reg_overlay.style.animation = "fadecl 0.5s";
    home_reg_dialog.style.animation = "close_reg_dialog 0.5s";
    setTimeout(function() {
        home_reg_dialog.style.display = "none";
        home_reg_overlay.style.display = "none";
    }, 480);
}