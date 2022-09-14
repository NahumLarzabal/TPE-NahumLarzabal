<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';
class ViewItems{
   private $smarty;
    function __construct(){
        $this->smarty=new Smarty();
    }

    function getItems($item){
        $this->smarty->assign('item', $item);
        $this->smarty->display('templates/listItems.tpl');
    }
    function getItem($item){
        $this->smarty->assign('item',$item);
        $this->smarty->display('templates/detailItem.tpl');
    }
    function getHome(){
        $this->smarty->assign('title', 'Bienvenido a nuestro sitio web');
        $this->smarty->display('templates/home.tpl');
    }
    function getSearchCategorias($item){
        $this->smarty->assign('item',$item);
        $this->smarty->display('templates/search.tpl');
    }

    }



?>