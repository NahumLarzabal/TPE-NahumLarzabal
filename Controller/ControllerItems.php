<?php
require_once "./Model/ModelItems.php";
require_once "./View/ViewItems.php";
class ControllerItems{
    private $model;
    private $view;
    function __construct(){
        $this->model = new ModelItems();
        $this->view = new ViewItems();
    }

    function getItems(){
      $item = $this->model->getItems();
        $this->view->getItems($item);

    }
    function getItem($id){
        $item=$this->model->getItem($id);
        $this->view->getItem($item);
    }
    function getHome(){
        $this->view->getHome();
    }
    function searchCategoria(){
        if (!empty($_POST['categoriaINP']) && isset($_POST['categoriaINP'])){
            $item = $this->model->searchCategoria($_POST['categoriaINP']);
            $this->view->getSearchCategorias($item);
        }
    }
}


?>