<?php
include '../system/perm.php';
include '../includes/header.php';
include '../includes/footer.php';

$idname=$data1['id'];
if($data1['username'] == null) {
    echo "<meta http-equiv='refresh' content='0; url=/'>";
} else {
?>
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js">
    CKEDITOR.editorConfig  = function( config ) {
	config.language = 'vi';
	config.uiColor = '#202020';
	config.height = 500;
	config.toolbarCanCollapse = true;
    };
</script>
<title>Cài đặt tài khoản <?php echo $titlehead;?></title>
<style>
.uset .coverbg {
        background-image: linear-gradient(to right top,rgb(0,0,0,.6),rgb(0,0,0,.6)), url(<?php echo $cover;?>);
}
</style>
<div onload="passcomfirm()"></div>

<div class="uset" id="prmain">
    <div class="coverbg"></div>
    <div class="coverblursetting"></div>
    <div class="profiles">
        <img src="<?php echo $avatar;?>">
        <div class="usr-info">
            <a style="font-size:30px;font-weight:bolder"><?php custom_echo($data1['name'],20);?></a>
            <br>
            <a>username: <?php echo $data1['username'];?> / id: <?php echo $data1['id'];?></a>
        </div>
    </div>
    <div class="navset">
        <div class="mainset" id="mainset1">
        <h1><i class="fas fa-home"></i> Chính</h1><br>
        <h3 style="cursor:pointer" onclick="users()"><b><i class="fas fa-user"></i> Người dùng</b><a style="font-weight:lighter; font-size:10px;display:block;padding-left:5px">Chỉnh sửa thông tin cá nhân!</a></h3><br>
        <div id="users">
        <p><b><i class="fas fa-signature"></i> Tên</b></p><br>
        <?php
        if(isset($_POST['upname'])) {
            $nam = $_POST['name'];
            $name = filter_var($nam, FILTER_SANITIZE_STRING);
            if(strlen($name) > 25){
                echo '<p style="color:red;padding:10px"><i>Tên của bạn phải nhỏ hơn 25 ký tự!</i></p>';
            } else {
            mysqli_query($conn,"UPDATE `users` SET `name` = '$name' WHERE `users`.`id` = '$idname'");
            echo '<p style="padding:10px"><i>Thay đổi tên thành công! Đang tải lại trang</i></p><script>window.location.href=""</script>';
            }
        }
        ?>
        <form action="" method="POST">
        <div id="main_ip_zfs" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input value="<?php echo $data1['name'];?>" required="" name="name" class="mdl-textfield__input" type="text" id="sample3">
            <label class="mdl-textfield__label" for="sample3">Tên của bạn</label>
        </div>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" name="upname" type="submit">Cập nhật</button>
        </form>
        <br>
        <p><b><i class="fas fa-link"></i> Tên người dùng (@)</b></p>
        <a style="color:gray;font-size:10px">Thay vì <?php echo $url_main_web;?>/nguoi-dung/zid/id-cua-ban thì sẽ như này <?php echo $url_main_web;?>/@ten.moi</a>
        <br>
        <?php
        if(isset($_POST['upslug'])) {
            $slugu = $_POST['slug_url'];
            $url_slug = filter_var($slugu, FILTER_SANITIZE_STRING);
            if(strlen($url_slug) > 30){
                echo '<p style="color:red;padding:10px"><i>Tên người dùng của bạn phải nhỏ hơn 30 ký tự!</i></p>';
            } else {
                $query_slug_load = mysqli_query($conn, "SELECT * FROM users WHERE `users`.`slug` = '$url_slug'");
                if(mysqli_fetch_array($query_slug_load)['username'] == null) { 
                    function slugload($str) {
                        $str = trim(mb_strtolower($str));
                        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
                        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
                        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
                        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
                        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
                        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
                        $str = preg_replace('/(đ)/', 'd', $str);
                        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
                        $str = preg_replace('/([\s]+)/', '.', $str);
                        return $str;
                    }
                    $slugloaduser = slugload($url_slug);
            mysqli_query($conn,"UPDATE `users` SET `slug` = '$slugloaduser' WHERE `users`.`id` = '$idname'");
            echo '<p style="padding:10px"><i>Thay đổi tên thành công! Đang tải lại trang</i></p><script>window.location.href=""</script>';
            } else {
                echo '<p style="padding:10px"><i>Tên người dùng này đã tồn tại :((</i></p>';
            }
        }

        }
        ?>
                    <?php
            if($data1['slug'] == null) {
                $load_user_slug = $url_main_web.'/nguoi-dung/zid/'.$data1['id'];
            } else {
                $load_user_slug = $url_main_web .'/@'. $data1['slug'];
            }
                ?>
        <form action="" method="POST">
            <div id="main_ip_zfs" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input name="slug_url" value="<?php echo $data1['slug'];?>" required="" name="name" class="mdl-textfield__input" type="text" id="sample3">
                <label class="mdl-textfield__label" for="sample3">Tên người dùng</label>
            </div>
            <a style="color:gray;font-size:11px">Link profile của bạn sẽ trông như này: <a target="_blank" href="<?php echo $load_user_slug;?>"><b><?php echo $load_user_slug;?></b></a></a>
            <br>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" name="upslug" type="submit">Cập nhật</button>
        </form>
        <br>
        <p><b><i class="far fa-images"></i> Thay đổi ảnh</b></p>
            <div class="upmain001">
                <div class="container">
                    <div class="row">
                    <form class="col-sm" action="" enctype="multipart/form-data" method="POST">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <select style="color:#000" class="mdl-textfield__input">
                            <option value="avt">Avatar</option>
                            <option value="cover">Ảnh bìa</option>
                        </select>
                        <label class="mdl-textfield__label" for="rating1">Loại</label>
                    </div>
                        <br>
                    <div class="uploader" onclick="$('#filePhoto').click()">
                        <div class="innerUploader">
                            Drag and drop or click to select image UwU
                            <img class="hidden" src="" />
                            <input accept="image/*" type="file" name="img"  id="filePhoto" style="z-index:0" />
                        </div>
                    </div>
                    <p>Powered by <a href="https://www.imgur.com"><svg style="vertical-align: bottom;" class="svg-icon" width="50" height="18" viewBox="0 0 50 18" fill="#fff" xmlns="http://www.w3.org/2000/svg"><path d="M46.1709 9.17788C46.1709 8.26454 46.2665 7.94324 47.1084 7.58816C47.4091 7.46349 47.7169 7.36433 48.0099 7.26993C48.9099 6.97997 49.672 6.73443 49.672 5.93063C49.672 5.22043 48.9832 4.61182 48.1414 4.61182C47.4335 4.61182 46.7256 4.91628 46.0943 5.50789C45.7307 4.9328 45.2525 4.66231 44.6595 4.66231C43.6264 4.66231 43.1481 5.28821 43.1481 6.59048V11.9512C43.1481 13.2535 43.6264 13.8962 44.6595 13.8962C45.6924 13.8962 46.1709 13.2535 46.1709 11.9512V9.17788Z"></path><path d="M32.492 10.1419C32.492 12.6954 34.1182 14.0484 37.0451 14.0484C39.9723 14.0484 41.5985 12.6954 41.5985 10.1419V6.59049C41.5985 5.28821 41.1394 4.66232 40.1061 4.66232C39.0732 4.66232 38.5948 5.28821 38.5948 6.59049V9.60062C38.5948 10.8521 38.2696 11.5455 37.0451 11.5455C35.8209 11.5455 35.4954 10.8521 35.4954 9.60062V6.59049C35.4954 5.28821 35.0173 4.66232 34.0034 4.66232C32.9703 4.66232 32.492 5.28821 32.492 6.59049V10.1419Z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M25.6622 17.6335C27.8049 17.6335 29.3739 16.9402 30.2537 15.6379C30.8468 14.7755 30.9615 13.5579 30.9615 11.9512V6.59049C30.9615 5.28821 30.4833 4.66231 29.4502 4.66231C28.9913 4.66231 28.4555 4.94978 28.1109 5.50789C27.499 4.86533 26.7335 4.56087 25.7005 4.56087C23.1369 4.56087 21.0134 6.57349 21.0134 9.27932C21.0134 11.9852 23.003 13.913 25.3754 13.913C26.5612 13.913 27.4607 13.4902 28.1109 12.6616C28.1109 12.7229 28.1161 12.7799 28.121 12.8346C28.1256 12.8854 28.1301 12.9342 28.1301 12.983C28.1301 14.4373 27.2502 15.2321 25.777 15.2321C24.8349 15.2321 24.1352 14.9821 23.5661 14.7787C23.176 14.6393 22.8472 14.5218 22.5437 14.5218C21.7977 14.5218 21.2429 15.0123 21.2429 15.6887C21.2429 16.7375 22.9072 17.6335 25.6622 17.6335ZM24.1317 9.27932C24.1317 7.94324 24.9928 7.09766 26.1024 7.09766C27.2119 7.09766 28.0918 7.94324 28.0918 9.27932C28.0918 10.6321 27.2311 11.5116 26.1024 11.5116C24.9737 11.5116 24.1317 10.6491 24.1317 9.27932Z"></path><path d="M16.8045 11.9512C16.8045 13.2535 17.2637 13.8962 18.2965 13.8962C19.3298 13.8962 19.8079 13.2535 19.8079 11.9512V8.12928C19.8079 5.82936 18.4879 4.62866 16.4027 4.62866C15.1594 4.62866 14.279 4.98375 13.3609 5.88013C12.653 5.05154 11.6581 4.62866 10.3573 4.62866C9.34336 4.62866 8.57809 4.89931 7.9466 5.5079C7.58314 4.9328 7.10506 4.66232 6.51203 4.66232C5.47873 4.66232 5.00066 5.28821 5.00066 6.59049V11.9512C5.00066 13.2535 5.47873 13.8962 6.51203 13.8962C7.54479 13.8962 8.0232 13.2535 8.0232 11.9512V8.90741C8.0232 7.58817 8.44431 6.91179 9.53458 6.91179C10.5104 6.91179 10.893 7.58817 10.893 8.94108V11.9512C10.893 13.2535 11.3711 13.8962 12.4044 13.8962C13.4375 13.8962 13.9157 13.2535 13.9157 11.9512V8.90741C13.9157 7.58817 14.3365 6.91179 15.4269 6.91179C16.4027 6.91179 16.8045 7.58817 16.8045 8.94108V11.9512Z"></path><path d="M3.31675 6.59049C3.31675 5.28821 2.83866 4.66232 1.82471 4.66232C0.791758 4.66232 0.313354 5.28821 0.313354 6.59049V11.9512C0.313354 13.2535 0.791758 13.8962 1.82471 13.8962C2.85798 13.8962 3.31675 13.2535 3.31675 11.9512V6.59049Z"></path><path d="M1.87209 0.400291C0.843612 0.400291 0 1.1159 0 1.98861C0 2.87869 0.822846 3.57676 1.87209 3.57676C2.90056 3.57676 3.7234 2.87869 3.7234 1.98861C3.7234 1.1159 2.90056 0.400291 1.87209 0.400291Z" fill="#1BB76E"></path></svg></a>
</p>
                    <br>
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" name="submit">Thay ảnh</button>
                    </form>
                    <div class="col-sm">
                    <?php
                    $idup = $data1['id'];
                    if(isset($_POST['submit'])){ 
                        $type = $_POST['sel'];
                        $img=$_FILES['img']; 
                        if($img['name']==''){  
                            echo "<p>Vui lòng chọn ảnh :v</p>";
                        }
                        else {
                            $filename = $img['tmp_name'];
                            $client_id='b54cf411367fb00';
                            $handle = fopen($filename, 'r');
                            $data = fread($handle, filesize($filename));
                            $pvars = array('image' => base64_encode($data));
                            $timeout = 30;
                            $curl = curl_init();
                            curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
                            curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
                            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
                            curl_setopt($curl, CURLOPT_POST, 1);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
                            $out = curl_exec($curl);
                            curl_close ($curl);
                            $pms = json_decode($out,true);
                            $url=$pms['data']['link'];
                            if($url!=''){
                                if($type == "avt"){
                                    mysqli_query($conn,"UPDATE `users` SET `avt` = '$url' WHERE `users`.`id` = '$idname'");
                                        echo '<script type="text/javascript">alert("Thay đổi ảnh đại diện thành công")</script><script>window.location.href=""</script>';
                                    } if($type == "cover") {
                                    mysqli_query($conn,"UPDATE `users` SET `cover` = '$url' WHERE `users`.`id` = '$idname'");
                                        echo '<script type="text/javascript">alert("Thay đổi ảnh bìa thành công")</script><script>window.location.href=""</script>';
                                }
                            } else {
                            echo "<p class='bg-danger'><b>Fatal Error:</b> ".$pms['data']['error']."</p>";
                            } 
                        }
                    }
                    ?>
                    </div>
                </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script>
            var imageLoader = document.getElementById('filePhoto');
            imageLoader.addEventListener('change', handleImage, false);

            function handleImage(e) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    $('.innerUploader img').attr('src',event.target.result).removeClass("hidden" );
                }
                reader.readAsDataURL(e.target.files[0]);
            }
            </script>
            </div>
        </div>
        <p><b>Địa chỉ Email</b></p>
        <p style="padding:10px">Địa chỉ email hiện tại: <?php echo $data1['email'];?><br><a style="font-size:12px"><i>Từ ngày 8/10/2020, bạn sẽ không thể thay đổi được địa chỉ Email (vi lý do dev nhác code OwO)</i></a></p>
        <br>
        <?php if($data1['admin'] == 1) {?>
        <p><b>Mô tả profile của bạn</b></p>
        <a style="color:gray; font-size:11px">Bạn có thể chỉnh sửa profile của bạn theo ý muốn (có thể dùng mã HTML)</a><br>
        <?php
        if(isset($_POST['uppro'])) {
            $prom = $_POST['textmainpro'];
            mysqli_query($conn,"UPDATE `users` SET `profile` = '$prom' WHERE `users`.`id` = '$idname'");
            echo '<p style="padding:10px"><i>Cập nhật thành công! Đang tải lại trang</i></p><script>window.location.href=""</script>';
        }
        ?>
        <form action="" method="POST">
        <button id="usecke" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="useCKE()" type="button">Dùng CKEditor</button>
        <textarea name="textmainpro" style="width:100%;height:400px" id="mainpro" class="iptextarea" name="main_profile"><?php echo $data1['profile'];?></textarea>
        <button name="uppro" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">Cập nhật</button>
    </form>
        <script>
        function useCKE() {
        CKEDITOR.replace('mainpro');
        document.getElementById("usecke").style.display = "none";
        document.getElementById("kuri_progress").style.display = "block";
        setTimeout(function() {document.getElementById("kuri_progress").style.display = "none";},1200);
        }
        </script>
        </div>
    <?php } ?>
        <h3 style="cursor:pointer" onclick="loginme()"><i class="fas fa-lock"></i> Đăng nhập<a style="font-weight:lighter; font-size:10px;display:block;padding-left:5px">Chỉnh sửa thông tin đăng nhập!</a></h3><br>
        <div  id="loginmethod1">
            <p><b><i class="fas fa-user-lock"></i> Tên đăng nhập</b></p><br>
            <?php
            if(isset($_POST['upusr'])) {
                $usernam = $_POST['username'];
                $sqlsec = mysqli_query($conn,"SELECT * FROM users WHERE `username` = '$username'");
                $loaddata = mysqli_fetch_array($sqlsec);
                $username = filter_var($usernam, FILTER_SANITIZE_STRING);
                $pattern = '/^[a-z0-9]{6,20}$/';
                $count_user = strlen($username);
                if (preg_match($pattern, $username) == false) {
                    echo "<p style='color:red;padding:10px'><i>Username phải nhiều hơn 6 ký tự và ít hơn 20 ký tự, không được chứa các ký tự in hoa, ký tự đặc biệt hoặc khoảng cách </i></p>";
                } else {
                    if ($count_user < 6 or $count_user > 20) {
                        echo "<p style='color:red;padding:10px'><i>Username phải lớn hơn 6 ký tự và nhỏ hơn 20 ký tự.</i></p>";
                    } else {
                if(isset($loaddata['username']) == true) {
                    echo '<p style="color:red;padding:10px"><i>Tên tài khoản này đã tồn tại hoặc bạn đã nhập tên cũ</i></p>';
                } else {
                mysqli_query($conn,"UPDATE `users` SET `username` = '$username' WHERE `users`.`id` = '$idname'");
                echo '<p style="padding:10px"><i>Thay đổi tên đăng nhập thành công! Đang tải lại trang</i></p><script>window.location.href=""</script>';
                } } }
            }
            ?>
            <form action="" method="POST">
                <input type="text" name="username" id="mainip1" placholder="Username" value="<?php echo $data1['username'];?>" REQUIERED=""><br><br>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" name="upusr" type="submit">Cập nhật</button>
                <p style="font-size:10px"><i>Bạn sẽ phải đăng xuất để lưu thông tin</i></p>
            </form><br>
            <p><b><i class="fas fa-key"></i> Mật khẩu</b></p>
            <?php
            $idname=$data1['id'];
            if(isset($_POST['uppass'])) {
                $passwor = $_POST['password'];
                $oldpass = $_POST['oldpass'];
                $password = filter_var($passwor, FILTER_SANITIZE_STRING);
                $count_pass = strlen($password);
                if ($count_pass < 6 or $count_pass > 20) {
                echo "<p style='color:red;padding:10px'><i>Password phải lớn hơn 6 ký tự và nhỏ hơn 20 ký tự.</i></p>";
                $err1 = 'style="background-color:#260202"';
                } else {
                if($oldpass == $data1['password']) {
                mysqli_query($conn,"UPDATE `users` SET `password` = '$password' WHERE `users`.`id` = '$idname'");
                echo '<p style="padding:10px"><i>Thay đổi mật khẩu thành công!</i></p><script>window.location.href=""</script>';
                } else {
                    echo '<p style="color:red;padding:10px"><i>Mật khẩu cũ không đúng</i></p>';
                    $err = 'style="background-color:#260202"';
                } }
            }
            ?>
            <form action="" method="POST">
            <p style="font-size:10px">Mật khẩu cũ của bạn</p>
                <input <?php if(isset($err)){echo $err;}?> placeholder="mật khẩu cũ" type="password" name="oldpass" id="mainip1" placholder="Old Password" value="" REQUIERED=""><br>
                <p style="font-size:10px">Mật khẩu mới</p>
                <input <?php if(isset($err1)){echo $err1;}?> placeholder="mật khẩu mới" type="password" name="password" id="mainip1" placholder="New Password" value="" REQUIERED=""><br><br>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" name="uppass" type="submit">Thay mật khẩu</button>
            </form><br>
        </div>
        <style>
            #personalize, #users, #loginmethod1 {
                display:block;
            }
            .navset h3 {
                width:fit-content;
            }
        </style>
        <script type="text/javascript">
        var usr = document.getElementById("users");
            function users() {
                if(usr.style.display === "none") {
                    usr.style.animation = "fade 0.5s";
                    usr.style.display = "block";
                } else {
                    usr.style.animation = "fadecl 0.5s";
                    setTimeout(function() {
                        usr.style.display = "none";
                    },480);
                }
            }
        var log = document.getElementById("loginmethod1");
            function loginme() {
                if(log.style.display === "none") {
                    log.style.animation = "fade 0.5s";
                    log.style.display = "block";
                } else {
                    log.style.animation = "fadecl 0.5s";
                    setTimeout(function() {
                        log.style.display = "none";
                    },480);
                }
            }
        </script>
    </div>
</div>
<style>
    #main_ip_zfs {
        width: 100%;
    }
    </style>
<?php
}
?>