<?php
require_once "./Model/LibroModel.php";
require_once "./View/ApiView.php";
require_once "./Model/CategoriaModel.php";
require_once "./Model/userModel.php";
require_once "./Model/ComentariosModel.php";
require_once "./View/LibroView.php";

class ApiController{

    private $model;
    private $view;
    private $modelCategoria;
    private $userModel;
    private $CommentModel;
    private $viewLibro;

    function __construct(){
        $this->model = new LibroModel();
        $this->view = new ApiView();
        $this->modelCategoria= new CategoriaModel();
        $this->userModel = new userModel();
        $this->CommentModel = new ComentariosModel();
        $this->viewLibro = new LibroView();
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
}

