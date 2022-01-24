<div id="network_status">
    <div class="net_stus_main">
        <span class="material-icons">perm_scan_wifi</span>
        <h1>Bạn đang ngoại tuyến (offline) :((</h1>
        <p>Hãy kiểm tra kết nối mạng rồi thử lại nhé! UwU</p>
        <button style="margin-top: 10px;" class="pure-material-button-contained" onclick="window.location.href=''">Refresh lại trang</button>
    </div>
</div>
<div id="network_status_dialog">
    <span class="material-icons" style="font-size: 45px;float: left;">signal_wifi_4_bar</span>
    <h4 style="float:left;padding-left: 10px;padding-top: 15px;">Đang trực tuyến (online) :))</h4>
</div>
<style>
    #network_status_dialog {
        position: fixed;
        z-index: 999999999;
        width: 280px;
        padding: 10px;
        height: 50px;
        background-color: #444444a6;
        display: none;
        bottom: 10px;
        left: 10px;
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        border-radius: 5px;
    }
    
    #network_status {
        position: fixed;
        z-index: 999999999;
        width: 100%;
        height: 100%;
        background-color: #202020;
        display: none;
    }
    
    #network_status .net_stus_main {
        position: fixed;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
        width: 100%;
        text-align: center;
    }
    
    #network_status .net_stus_main span {
        font-size: 100px;
    }
    
    @keyframes open_nw_dialog {
        0% {
            opacity: 0;
            bottom: -70px
        }
        100% {
            opacity: 1;
            bottom: 10px;
        }
    }
    
    @keyframes close_nw_dialog {
        100% {
            opacity: 0;
            bottom: -70px
        }
        0% {
            opacity: 1;
            bottom: 10px;
        }
    }
</style>
<script type="text/javascript">
    window.addEventListener('online', updateStatus);
    window.addEventListener('offline', updateStatus);

    function updateStatus(event) {
        if (navigator.onLine) {
            document.getElementById("network_status").style.animation = "fadecl 0.5s";
            document.getElementById("network_status_dialog").style.display = "block";
            document.body.style.overflow = "auto";
            document.getElementById("network_status_dialog").style.animation = "open_nw_dialog 0.3s";
            setTimeout(
                function() {
                    document.getElementById("network_status").style.display = "none";
                }, 480);
            setTimeout(
                function() {
                    document.getElementById("network_status_dialog").style.animation = "close_nw_dialog 0.3s";
                    setTimeout(
                        function() {
                            document.getElementById("network_status_dialog").style.display = "none";
                        }, 280);
                }, 3500)
        } else {
            document.getElementById("network_status").style.animation = "fade 0.5s";
            document.getElementById("network_status").style.display = "block";
            document.getElementById("network_status_dialog").style.display = "none";
            document.body.style.overflow = "hidden";
        }
    }
</script>