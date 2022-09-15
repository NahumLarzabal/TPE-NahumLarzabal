<?php
    session_start();
class AuthHelpers{
    // private $key;
    function __construct() {
        // $this->key = "NAHUMyAGUSTIN";
    }

    function checkLogin(){
        if (!isset($_SESSION['email'])) {
            header("Location: ".BASE_URL."login");
        }
    }

    //ver como hacer un objeto para traer dotas de roles
    function getNombre(){
        if (isset($_SESSION['nombre_apellido'])) {
            $user = $_SESSION['nombre_apellido'];
            return  $user;
        }
    }

    function getID(){
        if (isset($_SESSION['id'])) {
            return $_SESSION['id'] ;
        }
    } 
    
    function getRol(){
        if (isset($_SESSION['tipoUser'])) {
            return $_SESSION['tipoUser'] ;
        }

    }
}