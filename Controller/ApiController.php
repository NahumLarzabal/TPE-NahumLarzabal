<?php
require_once "./Model/LibroModel.php";
require_once "./View/ApiView.php";
require_once "./Model/CategoriaModel.php";
require_once "./Model/userModel.php";
require_once "./Model/ComentariosModel.php";


class ApiController{

    private $modelLibro;
    private $view;
    private $modelCategoria;
    private $userModel;
    private $CommentModel;
  

    function __construct(){
        $this->modelLibro = new LibroModel();
        $this->view = new ApiView();
        $this->modelCategoria= new CategoriaModel();
        $this->userModel = new userModel();
        $this->CommentModel = new ComentariosModel();
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
    function getComments($params = null){
        
        if(!empty($params[':order'])){
            $order = $params[':order'];
        if ($order == "DESC"|| $order == "desc"){
            $comment = $this->CommentModel->getComentarios($order);

        }else if($order == "ASC"|| $order == "asc"){
            $comment = $this->CommentModel->getComentarios($order);
        }else if($order != "DESC"|| $order != "desc" || $order != "ASC"|| $order != "asc"){
            return $this->view->response("puede que el orderby este mal escrito, escribir DESC o desc, ASC o asc",404);
        }
    }else{
        $comment = $this->CommentModel->getComentarios();
    }
        return $this->view->response($comment,200);
    } 
    

    function getCommentsPag($params=null){
        $page= $params[':hoja'];
        $limit = $params[':tope'];
        $totalPag = $this->CommentModel->paginacion($limit);
        if($page != 0 && $limit !=0 && $page < $totalPag){
            $comment = $this->CommentModel->getComentariosPag($page,$limit);
            return $this->view->response($comment,200);
        }else{
            return $this->view->response("la paguina no exite",404);
        }
    }
    

    function getComment($params=null){
        $idComment = $params[':ID']; //pido el parametro :id de la URL que esta en el router
       if(!empty($params[':order'])){
            $idOrderby = $params[':order']; //pido el parametro :order de la URL que esta en el router
           
            if($idOrderby == "DESC" || $idOrderby == "desc" ){
                $comment = $this->CommentModel->getComentarioLibroDesc($idComment);
            }else if($idOrderby == "ASC" || $idOrderby == "asc"){
                $comment = $this->CommentModel->getComentarioLibroAsc($idComment);
            }
        }else{
            $comment = $this->CommentModel->getComentarioLibroDesc($idComment);
        }

        if($comment){
            return $this->view->response($comment,200);
        }else{
            return $this->view->response("El comentario con el id=$idComment no existe",404);
        }
    }

    function getCommentPag($params=null){
        $idComment = $params[':ID']; //pido el parametro :id de la URL que esta en el router
        $idOrderby = $params[':order']; //pido el parametro :order de la URL que esta en el router
        $page= $params[':hoja'];
        $limit = $params[':tope'];
        $totalPag = $this->CommentModel->paginacion($limit);
        if(!empty($idComment)&&!empty($idOrderby)&&!empty($page)&&!empty($limit))
        if($page != 0 && $limit !=0 && $page < $totalPag){
            if($idOrderby == "DESC" || $idOrderby == "desc"){
                $comment = $this->CommentModel->getComentarioLibroDescPag($idComment,$page,$limit);
            }else if($idOrderby == "ASC" || $idOrderby == "asc"){
                $comment = $this->CommentModel->getComentarioLibroAscPag($idComment,$page,$limit);
            }

            if($comment){
                return $this->view->response($comment,200);
            }else{
                return $this->view->response("El libro con el id=$idComment no existe",404);
            }
        }else{
            return $this->view->response("la paguina no exite",404);
        
        }
    }



    function getCommentPuntaje($params=null){
        $idComment = $params[':ID'];
        $idOrderby = $params[':order'];
        $idPuntuacion = $params[':puntaje']; 
        //pido los parametros que viene desde la url de router-api que son GET
        if(!empty($idComment)&&!empty($idOrderby)&&!empty($idPuntuacion))
        if($idOrderby=="DESC" || $idOrderby == "desc"){
            $comment = $this->CommentModel->getComentarioLibroDescPunt($idComment,$idPuntuacion);
        }else if($idOrderby == "ASC" || $idOrderby == "asc"){
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
    function insertComment() {
        // obtengo el body del request (json)
        $body = $this->getBody();

        // TODO: VALIDACIONES -> 400 (Bad Request)
        // busco los request de body que inserta en la db
        var_dump($body->id_user);
        $id = $this->CommentModel->insertComment($body->comentarios,$body->puntuacion,$body->id_libro,$body->id_user);
        
        if ($id != 0) {
            $this->view->response("El comentario se insertó con el id=$id", 201);
        } else {
            $this->view->response("El comentario no se pudo insertar", 500);
        }
    }

  /*   private function getBody() {
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    } */

    function insertCommentx($params){
        $id = $params[':ID'];
        $post = $this->getBody();
        $valueLibroID = $this->modelLibro->getLibro($id);
        $valueEmail = $this->userModel->getUser($post->id_user);
       //$IdEmail = $this->userModel->getUser($valueEmail);
       if(!empty($post->comentarios)&&!empty($post->puntuacion)&&!empty($post->id_libro)&&!empty($post->id_user != $valueEmail)){
            if(($valueLibroID ==true)&&($valueEmail==true)){
                $this->CommentModel->insertCommentFull($post->comentarios,$valueLibroID->id,$valueEmail->id,$post->puntuacion);
                $this->view->response("El comentario se insertó en el libro:$valueLibroID->nombre_libro con id:$valueLibroID->id ", 201);
            }else{
                $this->view->response("El comentario no se pudo insertar revisar el nombre del libro o el email", 404);
            }

        }else{
            $this->view->response("El comentario no se pudo insertar faltan parametros o los parametros son incorrectos", 404);
        }

    }   

    function insertCommentFull($params = null) {
       if(!empty($params[':comment'])&&!empty($params[':name'])&&!empty($params[':email'])&&!empty($params[':puntaje'])){
            $comment = $params[':comment'];
            $name = $params[':name'];
            $email = $params[':email'];
            $puntaje = $params[':puntaje'];
            $valueID = $this->modelLibro->getLibroName($name);
            $valueEmail = $this->userModel->getUser($email);
            if(!empty($valueID)&&!empty($valueEmail)){
                $IdEmail = $this->userModel->getUser($email);
                
                $this->CommentModel->insertCommentFull($comment,$valueID->id,$IdEmail->id,$puntaje);
           
           if (!empty($name == $valueID->nombre_libro) && !empty($email == $valueEmail->email) ) {
               $this->view->response("El comentario se insertó con el libro:$name", 201);
           } 
       }else{
            $this->view->response("El comentario no se pudo insertar revisar el nombre del libro o el email", 404);
       }
       }else{

           $this->view->response("El comentario no se pudo insertar faltan parametros o los parametros son incorrectos", 404);
       }
       
    }
    


    /* function searchPuntuacion($params=null){
        $idComment = $params[':ID'];
        $idComment2 = $params[':comentarioID'];
        $idPuntuacion = $params[':puntuacion'];
        //busco parametro de router-api
        $comment = $this->CommentModel->getComentarioLibroDesc($idComment); // busca en orde desc lo que encuentre por el id del libro
        $comment2 = $this->CommentModel->getComentario($idComment2); //  traigo los comentarios de este libro en particular
        $comment3 = $this->CommentModel->getPuntuacion($idPuntuacion); // busco el puntaje igual al get de parametro url
        //if(!empty($comment) && !empty($comment2)&&!empty($comment3)){
            $this->CommentModel->getSearchPuntuacion($idComment,$idPuntuacion);
            return $this->view->response("El comentario de ID=$idComment2 con LibroId = $idComment y de Puntuacion = $idPuntuacion",204);
       // }else{
            //return $this->view->response("El parametro de busqueda no existe",404);

        //}
    } */

    /* ----------------------------- Libros ----------------------- */

    function getLibros(){
        $libro = $this->modelLibro->getLibrosX();
        if(!empty($libro)){
            return $this->view->response($libro,200);
        }else{
            return $this->view->response("no hay contenido",400);
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

    function insertLibro ($params){
        if(!empty($params[':name'])){
            $name = $params['name'];
            var_dump($name);
        }else{
            return $this->view->response("el libro no se pudo agregar",404);
        }
    }

    /* ------------------------- Categorias ---------------------- */
    
    function getCategorias(){
        $categoria = $this->modelCategoria->getGeneros();
        if(!empty($categoria)){
            return $this->view->response($categoria,200);
        }else{
            return $this->view->response("no hay contenido",404);
        }
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


    /* -------------------------- User ---------------------------- */
     
    function getUsers(){
        $user = $this->userModel->getUsers();
        if(isset($user)){
            return $this->view->response($user,200);
        }else{
            return $this->view->response("no hay contenido",400);
        }
    }
    

    function getUser($params){
        $email = $params[':email'];
        $user = $this->userModel->getUser($email);
        if(isset($user)){
            return $this->view->response($user,200);
        }else{
            return $this->view->response("no hay contenido",400);
        }
    }
}

