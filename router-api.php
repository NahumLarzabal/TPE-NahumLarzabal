<?php
require_once 'libs/Router.php';
require_once 'Controller/ApiController.php';

$router = new Router();

/* aca vamos a empezar a usar los empoint para la API para trabajar en Postman */

$router->addRoute('libros','GET','ApiController','getLibros'); //ok
$router->addRoute('libro/:ID','GET','ApiController','getLibro');//OK
$router->addRoute('libro/:ID','DELETE','ApiController','deleteLibro');//ok
$router->addRoute('libro','POST','ApiController','insertLibro');//ok
$router->addRoute('libro/:ID','PUT','ApiController','editLibro');//ok
$router->addRoute('categorias','GET','ApiController','getCategorias');//ok
$router->addRoute('categoria/:ID','GET','ApiController','getCategoria');//ok
$router->addRoute('categoria/:ID','DELETE','ApiController', 'deleteCategoria');//ok
$router->addRoute('categoria','POST','ApiController','insertCategoria');//ok
$router->addRoute('categoria/:ID','PUT','ApiController','editCategoria');//ok
$router->addRoute('usuarios','GET','ApiController','getUsers'); //ok
$router->addRoute('usuario/:email','GET','ApiController','getUser');//ok
$router->addRoute('usuario/:ID','DELETE','ApiController','deleteUser');//ok
$router->addRoute('usuario','POST','ApiController','insertUser');//ok
$router->addRoute('usuario/:ID','PUT','ApiController','editUser');//ok pasar en readme
$router->addRoute('token','GET','ApiController','obtenerToken');
$router->addRoute('token','POST','ApiController','obtenerTokenPost');
$router->addRoute('token/usuario/:ID','GET','ApiController','obtenerUsuario');
$router->addRoute('token/usuario','POST','ApiController','crearUsuario');
$router->addRoute('token','PUT','ApiController','obtenerTokenPut');
$router->addRoute('token/usuario/:ID','PUT','ApiController','editUsuario');
$router->addRoute('comentarios','GET','ApiController','getCommentsApi');//ok
$router->addRoute('comentarios/libro/:ID','GET','ApiController','getCommentApi');//ok 
$router->addRoute('comentarios/libro/:ID/','POST','ApiController','insertCommentFull');//ok
$router->addRoute('comentarios/:comentarioID/libro/:ID','DELETE','ApiController','deleteCommentAPI');//ok








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
