<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';
class CategoriaView{
    private $smarty;

    function __construct($email,$rol) {
        $this->smarty = new Smarty();
        $this->smarty->assign('email',$email);
        $this->smarty->assign('rol',$rol);
    }

    function showCategorias($categorias){
        $this->smarty->assign('categorias', $categorias);
        $this->smarty->display('templates/listadoCategorias.tpl');
    }
    function agregarCategoria(){
        $this->smarty->assign('titulo','Crear Categoria');
        $this->smarty->display('./templates/crearCategoria.tpl');
    }
    function viewCategoriaEdit($categoria){
        $this->smarty->assign('titulo','Editar Categoria');
        $this->smarty->assign('categorias', $categoria);
        $this->smarty->display('templates/editCategoria.tpl');
    }
    
    function showCategoriasLocation(){
        header("Location: ".BASE_URL."generos");
    }

    function showHome(){
        header("Location: ".BASE_URL."home");

    }

    function error(){
        $this->smarty->assign('Error','error');
        $this->smarty->display('templates/errorLibro.tpl');
    }


}