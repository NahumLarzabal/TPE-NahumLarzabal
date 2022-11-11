<?php
require_once "./Model/LibroModel.php";
require_once "./View/ApiView.php";
require_once "./Model/CategoriaModel.php";
require_once "./Model/userModel.php";
require_once "./Model/ComentariosModel.php";
require_once "./helpers/apiHelper.php";


class ApiController{

    private $modelLibro;
    private $view;
    private $modelCategoria;
    private $userModel;
    private $CommentModel;
    private $helper;


    function __construct(){
        $this->modelLibro = new LibroModel();
        $this->view = new ApiView();
        $this->modelCategoria= new CategoriaModel();
        $this->userModel = new userModel();
        $this->CommentModel = new ComentariosModel();
        $this->helper = new ApiHelpers();
    }

    
    /** Devuelve el body del request */
    private function getBody() {
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    }
    
    private function getBodySelect() {
        $bodyString = file_get_contents("php://option");
        return json_decode($bodyString);
    }

/************************            Comentarios         *************************************/
    function getComments(){
        $comment = $this->CommentModel->getComentarios();
        return $this->view->response($comment,200);
    }
    
    function getCommentsApi(){
        
        if(!empty($_GET['orderby'])&&!empty($_GET['page'])&& !empty($_GET['limit'])){
            $order = $_GET['orderby'];
            $page =$_GET['page'];
            $limit = $_GET['limit'];
            $comment = $this->CommentModel->getComentarios($order,$page,$limit);
            }else if(!empty($_GET['orderby'])){
                $order = $_GET['orderby'];
                if($_GET['orderby'] != "DESC"|| $_GET['orderby']  != "desc" || $_GET['orderby']  != "ASC"|| $_GET['orderby']  != "asc"){
                    return $this->view->response("puede que el orderby este mal escrito, escribir DESC o desc, ASC o asc",404);
                }else{
                    $comment = $this->CommentModel->getComentarios($order);    
                }
        }else{
        $comment = $this->CommentModel->getComentarios();
    }
        return $this->view->response($comment,200);
    }

    function getComment($params=null){
        $idComment = $params[':ID']; //pido el parametro :id de la URL que esta en el router
        $idOrderby = $params[':order']; //pido el parametro :order de la URL que esta en el router
        if($idOrderby == "DESC"){
            $comment = $this->CommentModel->getComentarioLibroDesc($idComment);
        }else{
            $comment = $this->CommentModel->getComentarioLibroAsc($idComment);
        }

        if($comment){
            return $this->view->response($comment,200);
        }else{
            return $this->view->response("El comentario con el id=$idComment no existe",404);
        }
    }

    function getCommentApi($params){
        $id=$params[':ID'];
        if(!empty($_GET['orderby'])&&!empty($_GET['page'])&& !empty($_GET['limit'])&&!empty($id)&&!empty($_GET['star'])){
            $order = $_GET['orderby'];
            $page =$_GET['page'];
            $limit = $_GET['limit'];
            $star = $_GET['star'];
            if($_GET['orderby'] == "DESC"|| $_GET['orderby']  == "desc" || $_GET['orderby']  == "ASC"|| $_GET['orderby']  == "asc" && (($star>=0) == true) && (($star<=5)== true)){
                $comment = $this->CommentModel->getComentarioLibro($id,$order,$page,$limit,$star);
             }else{
                return $this->view->response("puede que el orderby este mal escrito, escribir DESC o desc, ASC o asc o el puntaje es menor 0 y mayor 5",404);
                }
            }else if(!empty($_GET['orderby'])&&!empty($_GET['page'])&& !empty($_GET['limit'])&&!empty($id)){
                if($_GET['orderby'] == "DESC"|| $_GET['orderby']  == "desc" || $_GET['orderby']  == "ASC"|| $_GET['orderby']  == "asc"){
                $comment = $this->CommentModel->getComentarioLibro($id,$_GET['orderby'],$_GET['page'],$_GET['limit']);
                }else{
                    return $this->view->response("puede que el orderby este mal escrito, escribir DESC o desc, ASC o asc",404);
                }
            }else if(!empty($_GET['orderby'])&&!empty($_GET['star'])){
                if($_GET['orderby'] == "DESC"|| $_GET['orderby']  == "desc" || $_GET['orderby']  == "ASC"|| $_GET['orderby']  == "asc" && (($_GET['star']<=5)==true) && (($_GET['star'] >=0)==true)){
                $comment = $this->CommentModel->getComentarioLibro($id,$_GET['orderby'],$_GET['star']);   
                }else{
                    return $this->view->response("puede que el orderby este mal escrito, escribir DESC o desc, ASC o asc o el puntaje es menor 0 y mayor 5",404);
                }
            }else if(!empty($id)&&!empty($_GET['star'])){
                if((($_GET['star']<=5)==true) && (($_GET['star'] >=0)==true)){
                    $comment = $this->CommentModel->getComentarioLibro($id,$_GET['star']); 
                }else{
                    return $this->view->response("puede que el orderby este mal escrito, escribir DESC o desc, ASC o asc",404);
                }
        }else{
        $comment = $this->CommentModel->getComentarioLibro($id);
    }
        return $this->view->response($comment,200);
        
    }


    function getCommentPuntaje($params=null){
        $idComment = $params[':ID'];
        $idOrderby = $params[':order'];
        $idPuntuacion = $params[':puntaje']; 
        //pido los parametros que viene desde la url de router-api que son GET

        if($idOrderby=="DESC"){
            $comment = $this->CommentModel->getComentarioLibroDescPunt($idComment,$idPuntuacion);
        }else{
            $comment = $this->CommentModel->getComentarioLibroAscPunt($idComment,$idPuntuacion);
        }
        if($comment){
            return $this->view->response($comment,200);
        }else{
            return $this->view->response("El comentario con el id=$idComment y puntaje=$idPuntuacion no existe",404);
        }

    }

    function deleteComment($params=null){
        $idComment = $params[':ID'];
        $idComment2 = $params[':comentarioID'];
        $comment = $this->CommentModel->getComentarioLibroDesc($idComment);
        $comment2 = $this->CommentModel->getComentario($idComment2);

        if(!empty($comment) && !empty($comment2)){
            $this->CommentModel->deleteComment($idComment2);
            return $this->view->response("El comentario de ID=$idComment2 con LibroId = $idComment fue borrada",204);
        }else{
            return $this->view->response("El comentario con ID = $idComment no fue borrada",404);
        }
    }
    function insertComment($params = null) {
        // obtengo el body del request (json)
        $body = $this->getBody();

        // TODO: VALIDACIONES -> 400 (Bad Request)
        // busco los request de body que inserta en la db
        $id = $this->CommentModel->insertComment($body->comentarios,$body->puntuacion,$body->id_libro,$body->id_user);
        
        if ($id != 0) {
            $this->view->response("El comentario se insertó con el id=$id", 201);
        } else {
            $this->view->response("El comentario no se pudo insertar", 500);
        }
    }

    function searchPuntuacion($params=null){
        $idComment = $params[':ID'];
        $idComment2 = $params[':comentarioID'];
        $idPuntuacion = $params[':puntuacion'];
        //busco parametro de router-api
        $comment = $this->CommentModel->getComentarioLibroDesc($idComment); // busca en orde desc lo que encuentre por el id del libro
        $comment2 = $this->CommentModel->getComentario($idComment2); //  traigo los comentarios de este libro en particular
        $comment3 = $this->CommentModel->getPuntuacion($idPuntuacion); // busco el puntaje igual al get de parametro url
        if(!empty($comment) && !empty($comment2)&&!empty($comment3)){
            $this->CommentModel->getSearchPuntuacion($idComment,$idPuntuacion);
            return $this->view->response("El comentario de ID=$idComment2 con LibroId = $idComment y de Puntuacion = $idPuntuacion",204);
        }else{
            return $this->view->response("El parametro de busqueda no existe",404);

        }
    }

    function deleteCommentAPI($params=null){
        $idComment = $params[':ID'];
        $idComment2 = $params[':comentarioID'];
        $comment = $this->CommentModel->getComentarioLibroDesc($idComment);
        $comment2 = $this->CommentModel->getComentario($idComment2);

        if(!empty($comment) && !empty($comment2)){
           $this->CommentModel->deleteComment($idComment2);
           return $this->view->response("El comentario de ID= $idComment2 con LibroId = $idComment fue borrada",204);
        }else{
            return $this->view->response("El comentario con ID = $idComment2 no fue borrada, puede que no exista en el libro de id= $idComment",404);
        }
    }


     /* ----------------------------- Libros ----------------------- */

    

    function filtroPage(){
        if(!empty($_GET['page']))
        if(!empty($_GET['page']&&!empty($_GET['limit']))){
           if($_GET['page']==0 && $_GET['page']){
            return $this->view->response("la pagina no pede ser 0",403);
           }
        if(!empty($_GET['orderby'])){
            if($_GET['orderby'] == "DESC"|| $_GET['orderby']  == "desc" || $_GET['orderby']  == "ASC"|| $_GET['orderby']  == "asc"){
            }else{
                return $this->view->response("puede que el orderby este mal escrito, escribir DESC o desc, ASC o asc",403);
            }
        }
        if(!empty($_GET['sort'])){
            $valueSort = $this->modelLibro->valueSort($_GET['sort']);
            var_dump($valueSort);
            if( $valueSort == 0){
                return $this->view->response("puede que no exista el sort que busca",403);
            }
        }
            $limit = $_GET['limit'];
            //define("libros_x_pagina", $limit);
            $paginas = $this->modelLibro->paginacion($_GET['limit']);
            if($_GET['page']>$paginas || !$_GET['page']){
               return $this->view->response("la pagina supera la cantidad que hay realmente, hay paginas: $paginas que muestra por cada una tantos item: '$limit'",403);
            }else{

                $iniciar = ($_GET['page']-1)*$limit;
                define('iniciar',$iniciar);
            }
        }
        if(!empty($_GET['sort']) && !empty($_GET['limit']) && !empty($_GET['filtro']) &&!empty($_GET['orderby']) && !empty($_GET['page'])){
            $comment = $this->modelLibro->getLibrosAll($_GET['sort'],$_GET['orderby'],iniciar,$_GET['limit'],$_GET['filtro']);
            if(!empty($comment)==0){
                return $this->view->response("ya no hay mas para mostrar",403);
            }
        }else if(!empty($_GET['sort']) && !empty($_GET['limit']) && !empty($_GET['filtro'])&& !empty($_GET['page'])) {
            $comment = $this->modelLibro->getLibrosAll($_GET['sort'],'asc',iniciar,$_GET['limit'],$_GET['filtro']);
            if(!empty($comment)==0){
                return $this->view->response("ya no hay mas para mostrar",403);
            }
        }else if(!empty($_GET['orderby']) && !empty($_GET['limit']) && !empty($_GET['filtro'])&& !empty($_GET['page'])){
            $comment = $this->modelLibro->getLibrosAll('nombre_libro or autor',$_GET['orderby'],iniciar,$_GET['limit'],$_GET['filtro']);
            if(!empty($comment)==0){
                return $this->view->response("ya no hay mas para mostrar",403);
            }
        }else if(!empty($_GET['orderby']) && !empty($_GET['limit']) && !empty($_GET['sort'])&& !empty($_GET['page'])){
            $comment = $this->modelLibro->getLibrosAll($_GET['sort'],$_GET['orderby'],iniciar,$_GET['limit'],null);
            if(!empty($comment)==0){
                return $this->view->response("ya no hay mas para mostrar",403);
            }
        }else if(!empty($_GET['limit']) && !empty($_GET['filtro'])&& !empty($_GET['page'])){
            $comment = $this->modelLibro->getLibrosAll('nombre_libro or autor','asc',iniciar,$_GET['limit'],$_GET['filtro']);
            if(!empty($comment)==0){
                return $this->view->response("ya no hay mas para mostrar",403);
            }
        }else if(!empty($_GET['limit'])&& !empty($_GET['page'])){
            if(!empty($_GET['orderby'])){
                $comment = $this->modelLibro->getLibrosAll('id',$_GET['orderby'],iniciar,$_GET['limit'],null);
            }else{
                $comment = $this->modelLibro->getLibrosAll('id','asc',iniciar,$_GET['limit'],null);
            }
        }
        if(!empty($comment))
            return $this->view->response($comment,200);
    }
  
    function filtroOffPage(){
        if(!empty($_GET['orderby'])){
            if($_GET['orderby'] == "DESC"|| $_GET['orderby']  == "desc" || $_GET['orderby']  == "ASC"|| $_GET['orderby']  == "asc"){
            }else{
                return $this->view->response("puede que el orderby este mal escrito, escribir DESC o desc, ASC o asc",403);
            }
        }
        if(!empty($_GET['sort'])){
            $valueSort = $this->modelLibro->valueSort($_GET['sort']);
            var_dump($valueSort);
            if( $valueSort == 0){
                return $this->view->response("puede que no exista el sort que busca",403);
            }
        }
        if(!empty($_GET['sort']) && empty($_GET['limit']) && !empty($_GET['filtro']) &&!empty($_GET['orderby']) && empty($_GET['page'])){
            $comment = $this->modelLibro->getLibrosAll($_GET['sort'],$_GET['orderby'],null,null,$_GET['filtro']);
            }else if (!empty($_GET['sort']) &&!empty($_GET['orderby']) ){
                $comment = $this->modelLibro->getLibrosAll($_GET['sort'],$_GET['orderby'],null,null,null);
            }else if (!empty($_GET['sort']) &&!empty($_GET['filtro']) ){
                $comment = $this->modelLibro->getLibrosAll($_GET['sort'],'asc',null,null,$_GET['filtro']);
            }else if (!empty($_GET['filtro']) &&!empty($_GET['orderby']) ){
                $comment = $this->modelLibro->getLibrosAll('nombre_libro or autor',$_GET['orderby'],null,null,$_GET['filtro']);
            }else if (!empty($_GET['sort']) ){
                $comment = $this->modelLibro->getLibrosAll($_GET['sort'],'asc',null,null,null);
            }else if (!empty($_GET['orderby']) ){
                $comment = $this->modelLibro->getLibrosAll('id',$_GET['orderby'],null,null,null);
            }else if(!empty($_GET['filtro'])){
                $comment = $this->modelLibro->getLibrosAll('nombre_libro or autor','asc',null,null,$_GET['filtro']);
            }
        if(!empty($comment)!=0){
            return $this->view->response($comment,200);
        }else{
            return $this->view->response("No se encontro nada con {$_GET['filtro']}",404);
        }
    }

    function getLibros(){
       
        if(!empty($_GET['sort']) && !empty($_GET['limit']) && !empty($_GET['filtro']) &&!empty($_GET['orderby']) && !empty($_GET['page'])){
            $this->filtroPage();
        }else if(!empty($_GET['sort']) && !empty($_GET['limit']) && !empty($_GET['filtro'])&& !empty($_GET['page'])) {
            $this->filtroPage();
        }else if(!empty($_GET['orderby']) && !empty($_GET['limit']) && !empty($_GET['filtro'])&& !empty($_GET['page'])){
            $this->filtroPage();
        }else if(!empty($_GET['orderby']) && !empty($_GET['limit']) && !empty($_GET['sort'])&& !empty($_GET['page'])){
            $this->filtroPage();
        }else if(!empty($_GET['limit']) && !empty($_GET['filtro'])&& !empty($_GET['page'])){
            $this->filtroPage();
        }else if(!empty($_GET['limit'])&& !empty($_GET['page'])){
            if(!empty($_GET['orderby'])){
                $this->filtroPage();
            }else{
                $this->filtroPage();
            }
        }else  if(!empty($_GET['sort']) && empty($_GET['limit']) && !empty($_GET['filtro']) &&!empty($_GET['orderby']) && empty($_GET['page'])){
            $this->filtroOffPage();            
        }else if (!empty($_GET['sort']) &&!empty($_GET['orderby']) ){
            $this->filtroOffPage();            
        }else if (!empty($_GET['sort']) &&!empty($_GET['filtro']) ){
            $this->filtroOffPage();            
        }else if (!empty($_GET['filtro']) &&!empty($_GET['orderby']) ){
            $this->filtroOffPage();            
        }else if (!empty($_GET['sort'])){
            $this->filtroOffPage();            
        }else if (!empty($_GET['orderby'])){
             $this->filtroOffPage();            
        }else if(!empty($_GET['filtro'])){
            $this->filtroOffPage();            
        }else{
            return $this->view->response("No se encontro nada",404);
        }        
    }


    function getLibro($params){
       $id = $params[':ID'];
        $libro = $this->modelLibro->getLibro($id);
        if(!empty($libro)){
            return $this->view->response($libro,200);
        }else{
            return $this->view->response("el libro con ID:$id no existe",404);
        }
    }
 
    function insertLibro(){
        $body = $this->getBody();
        $valueCategory = $this->modelCategoria->valueCategory($body->genero); // devuelve 0 si no encuentra nada y 1 si encuentra algo
        $valueName = $this->modelLibro->getLibroName($body->nombre_libro);// te devuelve true o false si la columna existe
        if(!empty($body)){
            if($valueName==false){
                if($valueCategory > 0){

                    $this->modelLibro->insertLibro($body->autor,$body->nombre_libro,$body->descripcion,$body->precio,2,$body->imagen);
                }else{
                    return $this->view->response("la categoria no existe",404);
                }
            }else{
                return $this->view->response("el libro ya existe",404);
            }

        }else{
            return $this->view->response("el libro no se pudo agregar",404);
        }
        return $this->view->response($body,200); 
    }

    function deleteLibro($params){
        $id = $params[':ID'];
        // el valueCategory devuelve 0 o 1
        $valueCategory = $this->modelLibro->getLibroName($id);
        $valueID = $this->modelLibro->getLibro($id);
        if(!empty($valueID)){
            $this->modelLibro->deleteLibroFromDB($id);
            return $this->view->response("eliminado $id",204);
        }else if($valueCategory!=0){
            $this->modelLibro->deleteLibro($id);
            return $this->view->response("eliminado categoria: $id",204);
        }else{
            return $this->view->response("la categoria no se pudo eliminar porque no existe",404);

        }


    }
    function editLibro($params){
        $id = $params[':ID'];
        $body = $this->getBody();
        //le pregunto valueCategory que numero de id tiene ese nombre de categoria
        // le pregunto a valueID que si el id existe
        if(!empty($this->modelLibro->getLibro($id))){
            if(!empty($this->modelCategoria->getGeneroName($body->genero))){
                $valueCategory = $this->modelCategoria->getGeneroName($body->genero);
                $valueIdCategory = $this->modelCategoria->getGeneroID($valueCategory);
            }else{
                return $this->view->response("La categoria no existe ",404);
            }
                $this->modelLibro->updateLibroFromDB($id,$body->autor,$body->nombre_libro,$body->descripcion,$body->precio,$valueCategory,$body->imagen);
                return $this->view->response("Update el libro con id: $id",200);
    }else{
            return $this->view->response("El libro con ID: $id  no existe ",404);
         }
    }


    /* ------------------------- Categorias ---------------------- */
    
    function getCategorias(){
        if(!empty($_GET['orderby'])&&!empty($_GET['page'])&& !empty($_GET['limit'])){
            $order = $_GET['orderby'];
            $page =$_GET['page'];
            $limit = $_GET['limit'];
            $categoria = $this->modelCategoria->getGeneros($order,$page,$limit);
          }else if(!empty($_GET['orderby'])){
              if($_GET['orderby'] == "DESC"|| $_GET['orderby']  == "desc" || $_GET['orderby']  == "ASC"|| $_GET['orderby']  == "asc"){
                  $categoria = $this->modelCategoria->getGeneros($_GET['sort'],$_GET['orderby']);    
            }else{
                 return $this->view->response("puede que el orderby este mal escrito, escribir DESC o desc, ASC o asc",404);
                }
        }else{
        $categoria = $this->modelCategoria->getGeneros();
    }
        return $this->view->response($categoria,200);
    }

    function getCategoria($params){
        $id = $params[':ID'];
        $categoria = $this->modelCategoria->getGenero($id);
        if(!empty($categoria)){
            return $this->view->response($categoria,200);
        }else{
            return $this->view->response("el genero con ID:$id no existe",404);
        }
    }

    function insertCategoria(){
        $body = $this->getBody();
        $valueCategory=$this->modelCategoria->valueCategory($body->categoria);
        if(!empty($body)){
            if($valueCategory == 0){
                $this->modelCategoria->insertCategoria($body->categoria);
            }else{
                return $this->view->response("la categoria ya existe",404);
            }
        }else{
            return $this->view->response("la categoria no se pudo agregar",404);
        }
        return $this->view->response($body,200);
    }
    
    function deleteCategoria($params){
        $id = $params[':ID'];
        // el valueCategory devuelve 0 o 1
        $valueCategory = $this->modelCategoria->valueCategory($id);
        $valueID = $this->modelCategoria->getGenero($id);
        if(!empty($valueID)){
            $this->modelCategoria->deleteCategoriaFromDB($id);
            return $this->view->response("eliminado $id",204);
        }else if($valueCategory!=0){
            $this->modelCategoria->deleteCategoria($id);
            return $this->view->response("eliminado categoria: $id",204);
        }else{
            return $this->view->response("la categoria no se pudo eliminar porque no existe",404);

        }
    }

    function editCategoria($params){
        $id = $params[':ID'];
        $body = $this->getBody();
        //le pregunto valueCategory que numero de id tiene ese nombre de categoria
        // le pregunto a valueID que si el id existe
        $valueCategory = $this->modelCategoria->getGeneroName($id);
        $valueID = $this->modelCategoria->getGenero($id);
         if(!empty($valueID)){
             if($this->modelCategoria->getGeneroName($body->categoria)==false){
                $this->modelCategoria->updateCategoriaFromDB($body->categoria,$id);
                return $this->view->response("Update de la categoria:$id a $body->categoria",200);
            }else{
                return $this->view->response("El nombre a cambiar: $body->categoria es el mismo que ya tiene el $id",200);
            }            
        }else if($this->modelCategoria->getGenero($valueCategory) == true){
            $this->modelCategoria->updateCategoriaFromDB($body->categoria,$valueCategory);
            return $this->view->response("Update de categoria: $id a $body->categoria",200);
        }
        return $this->view->response("la categoria no se pudo cambiar porque no existe",404);
    }

    /* -------------------------- User ---------------------------- */
     
    function getUsers(){
        if(!empty($_GET['orderby'])&&!empty($_GET['page'])&& !empty($_GET['limit'])){
            $order = $_GET['orderby'];
            $page =$_GET['page'];
            $limit = $_GET['limit'];
            $user = $this->userModel->getUsers($order,($page*$limit),$limit);
          }else if(!empty($_GET['orderby'])){
              if($_GET['orderby'] == "DESC"|| $_GET['orderby']  == "desc" || $_GET['orderby']  == "ASC"|| $_GET['orderby']  == "asc"){
                  $user = $this->userModel->getUsers($_GET['orderby']);    
            }else{
                 return $this->view->response("puede que el orderby este mal escrito, escribir DESC o desc, ASC o asc",404);
                }
        }else{
        $user = $this->userModel->getUsers();
    }
        return $this->view->response($user,200);
       
    }
    

    function getUser($params){
        $email = $params[':email'];
        $user = $this->userModel->getUser($email);
        if(!empty($user)){   
           return $this->view->response($user,200);
        }else if($email>0 && $this->userModel->getUserID($email) ){
           $user = $this->userModel->getUserID($email);
           return $this->view->response($user,200);
        }else{
           return $this->view->response("no existe este usuario",404);
        }
    }

    function insertUser(){
        //password_verify(pass a verificar, pass del user) como usarlo
        //pedir que el parametro email tengo @ obligatorio 
        //el resto anda 10 puntelis
        $body = $this->getBody();
        $valueUser=$this->userModel->getUser($body->email);
       
        $valueEmail = $this->is_valid_email($body->email);
        if(!empty($body)){
            if($valueUser == false){
                if($valueEmail==true){
                $password = password_hash($body->password,PASSWORD_BCRYPT);
                $this->userModel->insertUser($body->email,$password,$body->nombre);
                }else{
                    return $this->view->response("el email no es correcto",404);
                }
            }else{
                return $this->view->response("el usuario ya existe",404);
            }
        }else{
            return $this->view->response("el usuario no se pudo agregar",404);
        }
        return $this->view->response($body,200);
    }

    function is_valid_email($str){
        $matches = null;
        return (1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $str, $matches));
      }
    
      function deleteUser($params){
        $id=$params[':ID'];
        $valueCategory = $this->userModel->getUser($id);
        $valueID = $this->userModel->getUserID($id);
        var_dump($valueCategory);
        if(!empty($valueID)){
           $this->userModel->deleteUsuarioID($id);
            return $this->view->response("eliminado $id",200);
        }else if($valueCategory==true){
           $this->userModel->deleteUsuario($id);
            return $this->view->response("eliminado usuario: $id",200);
        }else{
            return $this->view->response("el usuario no se pudo eliminar porque no existe",404);
        }
       

      }

    
    function editUser($params){
        $id = $params[':ID'];
        $body = $this->getBody();
        if (!empty($this->userModel->getUserID($id))){
            $valueID = $this->userModel->getUserID($id);
        }else{
            return $this->view->response("Este usuario no existe ",404);
        }
        if(!empty($body->email) && $id!=1){
            $valueUser=$this->userModel->getUser($body->email);
            if($this->is_valid_email($body->email) == true ){
                if(!empty($body->email)&&!empty($body->nombre)&&!empty($body->password)){
                    $password = password_hash($body->password,PASSWORD_BCRYPT);
                    if($valueUser == false){
                            $this->userModel->editUserApi($body->email,$body->nombre,$password,$id);
                            return $this->view->response("Se cambio existosamente el usuario ",200);
                        }else if(!empty($body->email) == $valueID->email) {
                            if($valueID->nombre != $body->nombre && !empty($id)!=1 ){
                                $this->userModel->editUserApi($valueID->email,$body->nombre,$password,$id);
                                return $this->view->response("Se cambio existosamente el nombre o el pass  ",200);
                            }else if($valueID->password != $password && !empty($id)!=1){
                                $this->userModel->editUserApi($valueID->email,$valueID->nombre,$password,$id);
                                return $this->view->response("Se cambio existosamente el pass ",200);
                            }
                    }
                }   
            }
        }else if(empty($body->nombre) != $valueID->nombre){
            if($id != 1 && ($body->nombre == "Admin")==false && ($body->nombre == "admin") == false){
                var_dump($body->nombre == "admin");
                $this->userModel->editUserApi($valueID->email,$body->nombre,$valueID->password,$id);
                return $this->view->response("Se cambio existosamente el nombre del usuario ",200);
            }else{
                return $this->view->response("Este usuario no puede cambiar al nombre Admin o admin ",404);
            }
        } else if(!empty($body->password)){
            if($id != 1 && $body->password.ob_get_length()!=0){
                $this->userModel->editUserApi($valueID->email,$valueID->nombre,$valueID->password,$id);
                return $this->view->response("Se cambio existosamente el pass del usuario ",200);
            }else{
                return $this->view->response("Este usuario no puede cambiar la pass por espacios vacios ",404);

            }
        }
        
        return $this->view->response("Este usuario no se pudo cambiar ",404);
    }

   /*-------------------------------      Helper       ----------------------------------*/

   function obtenerToken(){
        $userpass=$this->helper->getBasic();
        //$email = array("email"=>$userpass["email"]);
        // Si el usuario existe y las contraseñas coinciden
        if($this->userModel->getUser($userpass["email"])){
            $email = array("email"=>$userpass["email"]);
            $user = $this->userModel->getUser($email['email']); 
            if (password_verify($userpass['password'], $user->password )) {
                $token = $this->helper->creatToken($user);
                $this->view->response(["token"=>$token],200);
            }else{
                return $this->view->response("Este password es incorrecta ",401);
            }
        }
        return $this->view->response("no autorizado ",403);
   }

   function obtenerTokenPost(){
    $userpass=$this->helper->getBasic();
    if($this->userModel->getUser($userpass["email"])){
        $this->view->response("ya existe este mail",401);
        }else{
            $newUser = array(
                "id"=> "",
                "name"=>$userpass['email'],
                "email"=>$userpass['email'],
                "password"=>$userpass['password']
            );
            $token = $this->helper->creatToken($newUser);
            $this->view->response(["token"=>$token],200);
        }
   }

   function obtenerUsuario($params=null){
    $id = $params[':ID'];
    $user = $this->helper->getUser();
    if(!empty($user)){
            if($id == $user->id){
                $this->view->response($user,200);
            }else{
                $this->view->response("prohibido obtener info",403);
            }
        }else{
            $this->view->response("no autorizado",401);
        }
    }

    function crearUsuario(){
        $user = $this->helper->getUser();
       if($user){
        if(!$this->userModel->getUser($user->name)){
            $password = password_hash($user->password,PASSWORD_BCRYPT);
            $create = $this->userModel->insertUser($user->name,$password,$user->name);
            $this->view->response("creado el usuario con id: $create",200);
        }else{
            $this->view->response("prohibido obtener info",403);
        }
    }else{
        $this->view->response("no autorizado el token no existe",401);
    }
}

function editUsuario($params=null){
    $id = $params[':ID'];
    $user = $this->helper->getUser();
    var_dump($user->id);
    //$valueUser = $this->userModel->getUserID($user->id);
    if(!empty($user)){

    }else{
        $this->view->response("no autorizado el token no existe",401);
    }
}

}
