<?php
require_once "./Controller/ControllerItems.php";
require_once "./Controller/ControllerCategorias.php";

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');


// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home'; // acción por defecto si no envían
}


$params = explode('/', $action);

//$itemsController = new ControllerItems();
$categoriaController = new ControllerCategorias();
$itemsController= new ControllerItems();

// determina que camino seguir según la acción
 switch ($params[0]) {
    case 'home': 
        $itemsController->getHome();
        break;
    case 'categorias': 
      $categoriaController->getCategorias();
      break;
    case 'items':
        if(isset($params[1])){
            $itemsController->getItem($params[1]);
        }else{

            $itemsController->getItems();
        }
        break;
    case 'search':
        if(($params[1]=="categoria")){
            $itemsController->searchCategoria();
        }
        break;
   default: 
      echo('404 Page not found'); 
      break;
 }


?>