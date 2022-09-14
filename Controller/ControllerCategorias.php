<?php
require_once "./Model/ModelCategorias.php";
require_once "./View/ViewCategorias.php";
class ControllerCategorias{
    private $model;
    private $view;
    function __construct(){
        $this->model = new ModelCategorias();
        $this->view = new ViewCategorias();
    }

    function getCategorias(){
      $item = $this->model->getCategorias();
        $this->view->getCategorias($item);

    }
}


?>