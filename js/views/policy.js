var url = document.URL;
var section = url.split("#");
if (section.length > 1)
    changingSlide = setTimeout(function(){
        location.href = "#" + section[1];
        window.scrollBy(0, -175);
    }, 3000);