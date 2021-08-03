// code for hover activation of the video player controls 
var video1 = document.getElementById('video1');
var video2 = document.getElementById('video2');
var video3 = document.getElementById('video3');

video1.onmouseenter = function() {
    video1.setAttribute("controls", "controls")
}
video1.onmouseleave = function() {
    video1.removeAttribute("controls", "controls")
}
video2.onmouseenter = function() {
    video2.setAttribute("controls", "controls")
}
video2.onmouseleave = function() {
    video2.removeAttribute("controls", "controls")
}
video3.onmouseenter = function() {
    video3.setAttribute("controls", "controls")
}
video3.onmouseleave = function() {
    video3.removeAttribute("controls", "controls")
}

// Code for gallery
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n){
    showSlides(slideIndex += n);
}
function currentSlide(n){
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("thumbnails");
//   var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
//   captionText.innerHTML = dots[slideIndex-1].alt;
}