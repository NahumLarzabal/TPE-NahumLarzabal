<?php

require_once "./Model/userModel.php";
require_once "./View/userView.php";
require_once "./helpers/authHelper.php";

// usuario SuperAdmin == 1
// usuario administrador == 2
// usuario normal registrado == 3
// usuario invitado = 4 (hardcodeado)

class UserController{
    private $model;
    private $view;
    private $helper;

    function __construct(){
        $this->helper = new AuthHelpers();
        $this->model = new userModel();
        $this->view = new userView($this->helper->getNombre(), $this->helper->getRol());
        // $this->controller = new userController();
    }

    function login(){
        $this->view->showLogin();
    }

    function getUserHeader(){
        $email= $this->model->getUsers();
        $user=$this->model->getUser($email);
        $this->view->showUser($user);
    }

    function verifyLogin(){
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
     
            // Obtengo el usuario de la base de datos
            $user = $this->model->getUser($email);
     
            // Si el usuario existe y las contraseñas coinciden
            if ($user  && password_verify($password, $user->password)) {
                //inicion session  y le pido datos de la session para poder usarlos en el helper
                session_start();
                $_SESSION["email"] = $email;
                $_SESSION["nombre_apellido"]=$user->nombre_apellido;
                $_SESSION["id"]=$user->id;
                $_SESSION["tipoUser"]=$user->tipoUser;
                $this->view->showHome();
            } else {
                $this->view->showLogin("Acceso denegado");
            }
        }
    }
    
    function logout(){
        session_destroy();  
        $this->view->showLogin("Te Deslogeaste, gracias por tu trabajo");
    }

    function createUser(){
        if(!empty($_POST['email'])&& !empty($_POST['password'])&&!empty($_POST['nombre_apellido'])){
            $userEmail=$_POST['email'];
            if(isset($userEmail) != $this->model->getUser($userEmail)){
                $userPassword=password_hash($_POST['password'],PASSWORD_BCRYPT) ;
                $userNombre=$_POST['nombre_apellido'];
                $this->model->insertUser($userEmail,$userPassword,$userNombre);
                $this->view->showHomeLogin();
                $this->verifyLogin();
            }else{
                $this->view->showCreateLogin("El EMAIL ya existe");

            }
        }
    }

    // funcion para mostrar registro de user
    function createLogin(){
        $this->view->showCreateLogin();  
    }


    // mostrar lista de todos los usuarios
    function mostrarUsuarios(){
        $this->helper->checkLogin();
        $rol=$this->helper->getRol();
        if ($rol == "1" || $rol == "2") {
            $listaUsuarios = $this->model->getUsers();
            $this->view->showUsersList($listaUsuarios, $rol);
        } else {
            $this->view->showHome();
        }
    }

    // MOSTRAR usuario
    function mostrarUsuario($email){
        $this->helper->checkLogin();
        $user = $this->model->getUser($email);
        $this->view->showUsuario($user);
    }

    // modificar usuario
    function editarUsuario(){
        if (isset($_POST['nombre_apellido'],$_POST['tipoUser'],$_POST['email']) && !empty($_POST['nombre_apellido'] && !empty($_POST['tipoUser']) && !empty($_POST['email']))) {
            $this->helper->checkLogin();
            $this->model->editUser($_POST['nombre_apellido'],$_POST['tipoUser'],$_POST['email']);
            $this->mostrarUsuarios();
        } else{
            $this->mostrarUsuarios();
        } 
    }

    function deleteUsuario($id){
        $this->helper->checkLogin();
        $rol=$this->helper->getRol();
        if ($rol == "1" || $rol == "2") {
            $this->model->deleteUsuario($id);
            $this->view->showHomeUsuarios();
        } else {
            $this->view->showHome();
        }
    }
}
?>