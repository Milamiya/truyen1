document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
});
document.onkeydown = function(e) {
    if (event.keyCode == 123) {
        document.head.remove();
        document.body.remove();
        console.clear();
        return false;
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
        document.head.remove();
        document.body.remove();
        console.clear();
        return false;
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
        document.head.remove();
        document.body.remove();
        console.clear();
        return false;
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
        document.head.remove();
        document.body.remove();
        console.clear();
        return false;
    }
    if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
        document.head.remove();
        document.body.remove();
        console.clear();
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