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
/*Account Details Function*/
var loginStatus = false;
accountDetails();

function accountDetails() {
  if (loginStatus == true) {

  } else {
    document.getElementById("account_dropdown").innerHTML = "Click Here to Login or Create Account!";
  }
}

/*Cart Details Function*/
var cart = 0;
cartDetails();

function cartDetails() {
  if (cart > 0) {

  } else {
    document.getElementById("cartDropdown").innerHTML = "Your Cart is Empty!";
  }
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
