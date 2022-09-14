<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';
class ViewCategorias{
   private $smarty;
    function __construct(){
        $this->smarty=new Smarty();
    }

    function getCategorias($categorias){
        $this->smarty->assign('categorias', $categorias);
        $this->smarty->display('templates/listCategoria.tpl');
    }
 

    }



?>