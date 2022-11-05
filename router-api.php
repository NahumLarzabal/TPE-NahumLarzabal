<?php
require_once 'libs/Router.php';
require_once 'Controller/ApiController.php';

$router = new Router();

/* aca vamos a empezar a usar los empoint para la API para trabajar en Postman */

$router->addRoute('libros','GET','ApiController','getLibros'); //ok
$router->addRoute('libro/:ID','GET','ApiController','getLibro');//OK
$router->addRoute('libro/:ID','DELETE','ApiController','deleteLibro');
$router->addRoute('libro','POST','ApiController','insertLibro');//ok
$router->addRoute('libro/:ID','PUT','ApiController','editLibro');
$router->addRoute('categorias','GET','ApiController','getCategorias');//ok
$router->addRoute('categoria/:ID','GET','ApiController','getCategoria');//ok
$router->addRoute('categoria/:ID','DELETE','ApiController', 'deleteCategoria');
$router->addRoute('categoria','POST','ApiController','insertCategoria');//ok
$router->addRoute('categoria/:ID','PUT','ApiController','editCategoria');
$router->addRoute('usuarios','GET','ApiController','getUsers'); //ok
$router->addRoute('usuario/:email','GET','ApiController','getUser');//ok
$router->addRoute('usuario/:ID','DELETE','ApiController','deleteUser');
$router->addRoute('usuario','POST','ApiController','insertUser');//ok
$router->addRoute('comentarios','GET','ApiController','getCommentsApi');//ok
$router->addRoute('comentarios/libro/:ID','GET','ApiController','getCommentApi');//ok 
$router->addRoute('comentarios/libro/:ID/','POST','ApiController','insertCommentFull');//ok
$router->addRoute('libros/:ID/comentarios/:comentarioID','DELETE','ApiController','deleteComment');








/* Pertenece a la sitio web que maneja todo por parametros y por medio de javascript no tocarlos */
$router->addRoute('libros/:ID/comentarios','GET','ApiController','getComment');
$router->addRoute('libros/:ID/comentarios/orderby/:order','GET','ApiController','getComment');
$router->addRoute('libros/:ID/comentarios/orderby/:order/puntaje/:puntaje','GET','ApiController','getCommentPuntaje');
$router->addRoute('libros/:ID/comentarios','POST','ApiController','insertComment');
$router->addRoute('libros/:ID/comentarios/:comentarioID','DELETE','ApiController','deleteComment');
$router->addRoute('libros/:ID/comentarios/puntuacion/:puntuacion','GET','ApiController','searchPuntuacion');
// $router->addRoute('user/token','GET','ApiUserController','getToken');
// $router->addRoute('user/:ID','GET','ApiUserController','obetnerUsuario');



$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
