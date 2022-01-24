    var imageLoader = document.getElementById('kuri_filePhoto');
    imageLoader.addEventListener('change', handleImage, false);

    function handleImage(e) {
        var reader = new FileReader();
        reader.onload = function(event) {
            $('.kuri_inner_uploader img').attr('src', event.target.result).removeClass("hidden");
        }
        reader.readAsDataURL(e.target.files[0]);
    }