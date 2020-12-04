document.addEventListener('DOMContentLoaded', function() {

var navbar = document.getElementById("nav");
var sticky = navbar.offsetTop;

window.onscroll = function myFunction() {     //(un)stick mobile navigation
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
window.onresize = function changeNavBar(){
  var x = document.getElementById("myLinks");
  var y = document.getElementById("login");
  if (window.screen.width>=850)
  {
    x.style.display = "block";
    y.style.display = "block";
  } else{
    x.style.display = "none";
    y.style.display = "none";
  }
}
})

function navBarfunc() {                       //(un)hide menu options for mobile
  var x = document.getElementById("myLinks");
  var y = document.getElementById("login");
  if (x.style.display === "block") {
    x.style.display = "none";
    y.style.display = "none";
  } else {
    x.style.display = "block";
    y.style.display = "block";
  }
}