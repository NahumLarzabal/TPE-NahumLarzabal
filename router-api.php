<?php
require_once 'libs/Router.php';
require_once 'Controller/ApiController.php';

$router = new Router();

$router->addRoute('libros','GET','ApiController','getLibros'); //ok
$router->addRoute('libro/:ID','GET','ApiController','getLibro');//ok
$router->addRoute('libros/:ID','DELETE','ApiController','getDeleteLibro');
$router->addRoute('libros/:name','POST','ApiController','insertLibro');
$router->addRoute('libros/:ID','PUT','ApiController','editLibro');
$router->addRoute('categorias','GET','ApiController','getCategorias');//ok
$router->addRoute('categoria/:ID','GET','ApiController','getCategoria');//ok
$router->addRoute('categoria/:ID','DELETE','ApiController','getDeleteCategoria');
$router->addRoute('categorias','POST','ApiController','insertCategoria');
$router->addRoute('categorias/:ID','PUT','ApiController','editCategoria');
$router->addRoute('usuarios','GET','ApiController','getUsers'); //ok
$router->addRoute('usuario/:email','GET','ApiController','getUser');//ok
$router->addRoute('usuario/:ID','DELETE','ApiController','getDeleteUser');
$router->addRoute('usuarios','POST','ApiController','insertUser');
$router->addRoute('comentarios','GET','ApiController','getComments');//ok
$router->addRoute('comentarios/orderby/:order','GET','ApiController','getComments');//ok
$router->addRoute('comentarios/page/:hoja/limit/:tope','GET','ApiController','getCommentsPag');//ok
$router->addRoute('libros/:ID/comentarios','GET','ApiController','getComment');//ok
$router->addRoute('libros/:ID/comentarios/orderby/:order','GET','ApiController','getComment');//ok
$router->addRoute('libros/:ID/comentarios/orderby/:order/page/:hoja/limit/:tope','GET','ApiController','getCommentPag');//ok
$router->addRoute('libros/:ID/comentarios/orderby/:order/puntaje/:puntaje','GET','ApiController','getCommentPuntaje');//ok
$router->addRoute('libros/:ID/comentariosx','POST','ApiController','insertComment'); // este se utiliza unicamente para trabajar con VUE y consumirlo con la paguina
$router->addRoute('libros/:ID/comentarios','POST','ApiController','insertCommentx');//ok
$router->addRoute('comentarios/comentario/:comment/libro/:name/user/:email/puntuacion/:puntaje','POST','ApiController','insertCommentFull'); //ok
$router->addRoute('libros/:ID/comentarios/:comentarioID','DELETE','ApiController','deleteComment');
/* $router->addRoute('libros/:ID/comentarios/puntuacion/:puntuacion','GET','ApiController','searchPuntuacion'); */


// $router->addRoute('user/token','GET','ApiUserController','getToken');
// $router->addRoute('user/:ID','GET','ApiUserController','obetnerUsuario');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
