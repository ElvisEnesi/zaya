// script file
// Navbar function
let openbar = document.querySelector("#open");
let closebar = document.querySelector("#close");
let nav = document.querySelector(".nav");
function openNav() {
    openbar.style.display = "none";
    closebar.style.display = "block";
    nav.style.right = "-50px"
}
function closeNav() {
    closebar.style.display = "none";
    openbar.style.display = "block";
    nav.style.right = "-250px"
}