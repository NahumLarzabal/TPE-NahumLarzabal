"use strict";

let selectFilter = document.getElementById("filter-table");
let selectGenero = document.getElementById("select-genero");
let selectAutor = document.getElementById("select-autor");
let selectTitulo = document.getElementById("select-titulo");
console.log(selectFilter);
selectFilter.addEventListener("change", filtrarTabla);


function filtrarTabla(){
    console.log(selectFilter.value);
    if (selectFilter.value == "nombre_libro") {
        selectTitulo.classList.toggle("invisible");
        selectGenero.classList.add("invisible");
        selectAutor.classList.add("invisible");
    } else if (selectFilter.value == "id_categoria") {
        selectTitulo.classList.add("invisible");
        selectGenero.classList.toggle("invisible");
        selectAutor.classList.add("invisible");
    } else if (selectFilter.value == "autor") { 
        selectTitulo.classList.add("invisible");
        selectGenero.classList.add("invisible");
        selectAutor.classList.toggle("invisible");
    }
}

