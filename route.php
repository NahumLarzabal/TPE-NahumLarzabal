<?php
require_once "./Controller/LibroController.php";
require_once "./Controller/userController.php";
require_once "./Controller/CategoriaController.php";

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');


// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home'; // acción por defecto si no envían
}


$params = explode('/', $action);

$libroController = new LibroController();
$userController = new UserController();
$categoriaController = new CategoriaController();


// determina que camino seguir según la acción
 switch ($params[0]) {
   case 'login': 
      $userController->login();
      break;
   case 'logout': 
      $userController->logout();
      break;
   case 'verify': 
      $userController->verifyLogin();
      break;
   case 'createUser':
      $userController->createUser();
      break;
   case 'createLogin':
      $userController->createLogin();
      break;
   case 'home':
      $libroController->inicio();
      break;
   case 'libros': 
      //si params 1 no esta vacio y params 1 es igual a agregarlibro ->agregarLibro()
      if(!empty($params[1]) && $params[1]=="agregar" && empty($params[2])){
         $libroController->agregarlibro();
      } else {
         $libroController->listadoLibros();
      }
      break;
   case 'createLibro':
      // action del form para crear el libro 
      $libroController->createLibro(); 
      break;
   case 'deleteLibro': 
      // elimina el libro del ID que va en params1 (ej localhost/tpe/deletelibro/3)
      $libroController->deleteLibro($params[1]); 
      break;
   case 'edit': 
         // action del form que edita el libro de la bbdd
      $libroController->editLibroAction(); 
      break; 
   case 'editCategoria': 
      // action del form que edita las categorias de la bbdd
      $categoriaController->editCategoria(); 
      break;
   case 'agregarCategoria':
      // insertado de la categoria en la bbdd (llama al modelo)
      $categoriaController->agregarCategoria();
      break;
   case 'genero':
      if (($params[1]=="editar") && !empty($params[2])){
         // formulario para editar la categoria
         $categoriaController->editarCategoria($params[2]); 
      } else {
         $categoriaController->viewCategorias();
      }
      break;
   case 'deleteCategoria':
      // eliminar categoria con el id pasado por params1 
      $categoriaController->deleteCategoria($params[1]); 
      break; 
   case 'generos':
      if(!empty($params[1]) && $params[1]=="agregar"){
         $categoriaController->showCategoria();
      } else if(empty($params[1]) || empty($params[2])){
         $categoriaController->viewCategorias();
      } else {
         $libroController->inicio();
      }
      break;
   case 'libro': 
      if (($params[1]=="editar") && (!empty($params[2]))){
         $libroController->editarLibro($params[2]);
      } else if (isset($params[1])) {
         $libroController->viewLibro($params[1]); 
      } else {
         $libroController->listadoLibros();
      }
      break;
   case 'search': 
      if($params[1]=="titulo"){
      $libroController->searchTitulo(); 
      } else if($params[1]=="autor"){
         $libroController->searchAutor();
      }else if($params[1]=="genero"){
         $libroController->searchGenero(); 
      }
      break;
   case 'usuario':
      $userController->mostrarUsuario($params[1]);
      break;
   case 'usuarios':
      $userController->mostrarUsuarios();
      break;
   case 'editarUsuario':
      $userController->editarUsuario();
      break;
   case 'eliminarUsuario':
      $userController->deleteUsuario($params[1]);
      break;
   case 'eliminarPortada':
      $libroController->eliminarPortada($params[1]);
      break;
   default: 
      echo('404 Page not found'); 
      break;
 }


?>