"use strict"
const idApi = document.querySelector("#idApi").value;
const url = "api/libros";

let api = new Vue({
    el: "#apiComentarios",
    data: {
        titulo: "este es el titulo",
        comments: [],
    },
    mounted: function(){
      this.starInput() //cargo el la funcion para que me la tome al iniciar vue
    },
    methods: { // con methods hago instaciar el boton para poder usarlo con vue
        commentDelete:async function (id_comment){
              let id_libro = document.querySelector(".id_libro").value;
              let rol = document.querySelector('.rol').value;
                if(rol == 4 || rol == 3){
                  console.log("No sos Administrador");
                }else{
                try {
                  let res = await fetch(`api/libros/${id_libro}/comentarios/${id_comment}`,{
                  method: "DELETE",
              });
              if( res.status == 204){
                  comments();
                //  console.log("Borrado");
              }
            } catch (error) {
              console.log(error);
            }
          }
        },
        starInput: function(){
            comments();
            let inputStar = document.querySelector(".puntajeInputStar");
        }
          }
          
});

let btnOrder = document.querySelector(".orderby");
btnOrder.addEventListener('click',comments);

async function comments(){
  let order = document.querySelector("#ordenamiento").value;
  let puntaje = document.querySelector("#puntajeInput").value;
  let res;
    try {
      if(puntaje =="NULL"){
        res = await fetch(`${url}/${idApi}/comentarios/orderby/${order}`);
      }else{
        res = await fetch(`${url}/${idApi}/comentarios/orderby/${order}/puntaje/${puntaje}`);
      }
        if(res.status == 200){
            let json = await res.json();
            api.comments = json;
          }else if (res.status == 404){
            document.querySelector(".idcomment").innerHTML = "";
          // console.log("no hay comentarios");
        }
    } catch (e) {
        console.log(e);
    }
}

function campForm(){
    let comentario = document.querySelector(".comentario");
    let id_libro = document.querySelector(".id_libro");
    let nombre_apellido = document.querySelector(".nombreUserID");
    let puntuacion = document.querySelector(".puntuacion");
    return { comentarios: comentario.value,
       id_libro: id_libro.value,
       id_user: nombre_apellido.value,
       puntuacion: puntuacion.value
    }
}

let btn = document.querySelector("#btn-insertComment");
if(btn){
  btn.addEventListener("click",insertComment);
}
function limpiarCampos(){
    let comentario = document.querySelector(".comentario");
    comentario.value = "";
}
 

async function insertComment(event){
  event.preventDefault()
    let comment = campForm();

    console.log(comment);
    try {
    let res = await fetch(`${url}/${idApi}/comentarios`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(comment),
          });
          if (res.status == 201) {
              comments();
              limpiarCampos();
            // console.log("Subido");
          }
    } catch (e) {
        console.log(e)
    }
}