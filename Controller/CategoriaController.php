<?php
require_once "./Model/CategoriaModel.php";
require_once "./View/CategoriaView.php";
require_once "./helpers/authHelper.php";
require_once "./Model/LibroModel.php";

class CategoriaController{

    private $model;
    private $view;
    private $helper;
    private $modelLibro;


    function __construct(){
        $this->helper = new AuthHelpers();
        $this->modelLibro = new LibroModel();
        $this->model = new CategoriaModel();
        $this->view = new CategoriaView($this->helper->getNombre(),$this->helper->getRol());
    }

    function editCategoria(){
        $this->helper->checkLogin();
        if (!empty($_POST['categoria']) && isset($_POST['categoria'])){
            if($this->helper->getRol()!="3"){
                $this->model->updateCategoriaFromDB($_POST['categoria'],$_POST['id_categoria']);
                $this->view->showCategoriasLocation();
            }
            $this->view->showCategoriasLocation();
        } else {
            $this->view->showCategoriasLocation();
        }
    }

    function viewCategorias(){
        $this->helper->checkLogin();
        $rol=$this->helper->getRol();
        if ($rol !="4") {
            $categorias = $this->model->getGeneros();
            $this->view->showCategorias($categorias);
        }else{
        $this->view->showHome();
        }
    }
    
    function showCategoria(){
        $this->helper->checkLogin();
        $rol=$this->helper->getRol();
        if ($rol == "3" || $rol =="4") {
            $this->view->showCategoriasLocation();
        }else{
        $this->view->agregarCategoria();
        }
    }

    function editarCategoria($id){
        $this->helper->checkLogin();
        $rol=$this->helper->getRol();
        if ($rol != "3" || $rol !="4") {
            $categoria = $this->model->getGenero($id);
            if ($categoria!=NULL) {
                $this->view->viewCategoriaEdit($categoria);
            } else {
                $this->view->error();
            }
        } else {
            $this->view->showCategoriasLocation();
        }
    }

    function agregarCategoria(){
        $this->helper->checkLogin();
        if (!empty($_POST['categoria']) && isset($_POST['categoria'])){
            $categoria = $_POST['categoria'];
            $this->model->insertCategoria($categoria);
            $this->view->showCategoriasLocation();
        } else {
            $this->view->showCategoriasLocation();
        }
    }

    function deleteCategoria($id){
        $this->helper->checkLogin();
        if($this->helper->getRol()!="3"){
            $contador = $this->model->contadorCategoria($id);
            if ($contador == NULL){
                $this->model->deleteCategoriaFromDB($id);
                $this->view->showCategoriasLocation();
            } else {
                $this->view->showCategoriasLocation();
            } 
        }
        $this->view->showCategoriasLocation();
    }
}
