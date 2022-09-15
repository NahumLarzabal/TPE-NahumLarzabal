"use strict"

let invitado = document.querySelector(".invitado");

invitado.addEventListener('click', loginInvitado);

// funcion para hardcodear el usuario invitado en los inputs para logearse.
function loginInvitado(){
    console.log("entre")
    let email = document.querySelector(".email");
    let invitado = document.querySelector(".password");
    email.value="invitado@gmail.com";
    invitado.value="invitado";
    console.log(email.value, invitado.value)

}
