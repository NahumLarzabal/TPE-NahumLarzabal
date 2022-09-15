<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';
class userView{
    private $smarty;

    function __construct($email, $rol) {
        $this->smarty = new Smarty();
        $this->smarty->assign('email',$email);
        $this->smarty->assign('rol',$rol);
    }
    
    function showLogin($error=""){
        $this->smarty->assign('titulo','LOG IN');
        $this->smarty->assign('error',$error);
        $this->smarty->display('templates/userLogin.tpl');
    }

    function showHome(){
        header("Location: ".BASE_URL."home");
    }

    function showUserCreate($error=""){
        $this->smarty->assign('error',$error);
        $this->smarty->display('templates/registroUsuario.tpl');
    }
    function showCreateLogin($error=""){
        $this->smarty->assign('titulo','CREAR USUARIO');
        $this->smarty->assign('error',$error);
        $this->smarty->display('templates/createUser.tpl');
    }
    function showHomeLogin(){
        header("Location: ".BASE_URL."login");
    }
    function showHomeCreate(){
        header("Location: ".BASE_URL."createUser");
    }
    
    function showUser($users=null){
        $this->smarty->assign('users',$users);
        $this->smarty->display('templates/header.tpl');
    }

    function showUsuario($user){
        $this->smarty->assign('user', $user);
        $this->smarty->display('templates/editarUsuario.tpl');
    }

    function showUsersList($listaUsuarios){
        $this->smarty->assign('users', $listaUsuarios);
        $this->smarty->display('templates/usuarios.tpl');
    }

    function showHomeUsuarios(){
        header("Location: ".BASE_URL."usuarios");
    }

}