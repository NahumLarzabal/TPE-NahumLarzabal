"use strict";

let pagina = document.querySelector(".pagina");
let navList = document.querySelector("#nav-menu");
let btnMenu = document.getElementById("btn-menu");
btnMenu.addEventListener("click", changeGrid);

function changeGrid(){
    // pagina.classList.toggle(".nav-collapse");
    pagina.classList.toggle("pagina");
    navList.classList.toggle("invisible");
    navList.classList.toggle("nav-list");
    // console.log(pagina);
};

