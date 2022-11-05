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
     /* ----------------------------- Libros ----------------------- */

    function getLibros(){
         if(!empty($_GET['orderby'])&&!empty($_GET['page'])&& !empty($_GET['limit'])&&!empty($_GET['sort'])){
            $order = $_GET['orderby'];
            $page =$_GET['page'];
            $limit = $_GET['limit'];
            $sort = $_GET['sort'];
            $comment = $this->modelLibro->getLibrosAll($sort,$order,$page,$limit);
        }else if(!empty($_GET['orderby'])&&!empty($_GET['sort'])){
              if($_GET['orderby'] == "DESC"|| $_GET['orderby']  == "desc" || $_GET['orderby']  == "ASC"|| $_GET['orderby']  == "asc"){
                  $comment = $this->modelLibro->getLibrosAll($_GET['sort'],$_GET['orderby']);    
                }else{
                 return $this->view->response("puede que el orderby este mal escrito, escribir DESC o desc, ASC o asc",404);
                }
        }else if(!empty($_GET['orderby'])){
                if($_GET['orderby'] == "DESC"|| $_GET['orderby']  == "desc" || $_GET['orderby']  == "ASC"|| $_GET['orderby']  == "asc"){
                 $comment = $this->modelLibro->getLibrosAll($_GET['orderby']);    
                }else{
                 return $this->view->response("puede que el orderby este mal escrito, escribir DESC o desc, ASC o asc",404);
                }
        }else{
            $comment = $this->modelLibro->getLibrosAll();
        }
        return $this->view->response($comment,200);

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
        if(!empty($body)){
            $this->modelLibro->insertLibro($body->autor,$body->nombre_libro,$body->descripcion,$body->precio,2,$body->imagen);
        }else{
            return $this->view->response("el libro no se pudo agregar",404);
        }
        return $this->view->response($body,200);
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
        var_dump($valueCategory);
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


    /* -------------------------- User ---------------------------- */
     
    function getUsers(){
        if(!empty($_GET['orderby'])&&!empty($_GET['page'])&& !empty($_GET['limit'])){
            $order = $_GET['orderby'];
            $page =$_GET['page'];
            $limit = $_GET['limit'];
            $user = $this->userModel->getUsers($order,$page,$limit);
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
       /*  $user = $this->userModel->getUsers();
        if(isset($user)){
            return $this->view->response($user,200);
        }else{
            return $this->view->response("no hay contenido",400);
        } */
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

    function insertUser(){
        $body = $this->getBody();
        $valueUser=$this->userModel->getUser($body->email);
        //hay que hacer un hash a la password para q venga por Byts y verificar pass 
        //pedir que el parametro email tengo @ obligatorio 
        //el resto anda 10 puntelis
        if(!empty($body)){
            if($valueUser == false){
            $this->userModel->insertUser($body->email,$body->password,$body->nombre);
            }else{
                return $this->view->response("el usuario ya existe",404);
            }
        }else{
            return $this->view->response("el usuario no se pudo agregar",404);
        }
        return $this->view->response($body,200);
    }

    function createUser(){
        if(!empty($_POST['email'])&& !empty($_POST['password'])&&!empty($_POST['nombre_apellido'])){
            $userEmail=$_POST['email'];
            if(isset($userEmail) != $this->model->getUser($userEmail)){
                $userPassword=password_hash($_POST['password'],PASSWORD_BCRYPT) ;
                $userNombre=$_POST['nombre_apellido'];
                $this->model->insertUser($userEmail,$userPassword,$userNombre);
                $this->verifyLogin();

            }
        }
    }
    function verifyLogin(){
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
     
            // Obtengo el usuario de la base de datos
            $user = $this->model->getUser($email);
     
            // Si el usuario existe y las contraseñas coinciden
            if ($user  && password_verify($password, $user->password)) 
                //inicion session  y le pido datos de la session para poder usarlos en el helper
                session_start();
                $_SESSION["email"] = $email;
                $_SESSION["nombre_apellido"]=$user->nombre_apellido;
                $_SESSION["id"]=$user->id;
                $_SESSION["tipoUser"]=$user->tipoUser;
               
          
        }
    }

}





