var slideIndex = 0;
showSlides();
/*Slider Function*/
function showSlides() {
    var i;
    var slides = document.getElementsByClassName("image_container");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    setTimeout(showSlides, 4000);
}


/*Hidden Menu*/
function OpenhiddenMenu() {
    document.getElementById("hiddenNavigationBar").style.display = "block";
}

function ClosehiddenMenu() {
    document.getElementById("hiddenNavigationBar").style.display = "none";
}
/*Open Close search bar on mouse click*/

function openSearch() {
    document.getElementById("searchContainer").style.display = "block";
}

function closeSearch() {
    document.getElementById("searchContainer").style.display = "none";
}