$(function() {
    $("a").click(function(e) {
        e.preventDefault(); //so the browser doesn't follow the link

        $("#application").load(this.href, function() {
            //execute here after load completed
        });
    });
});