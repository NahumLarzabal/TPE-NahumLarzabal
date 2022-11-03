<?php

class ComentariosModel{
    private $db;
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tpe;charset=utf8', 'root', '');
    }
    function paginacion($limit){
//cuento cuantas hay en total
        $sentencia = $this->db->prepare( "SELECT * from comentarios join users on comentarios.id_user = users.id ");
        $sentencia->execute();
        // contar cuantos libros hay en la bd
        $total_libros = $sentencia->rowCount();
        $paginas = $total_libros/$limit;
        $paginas = ceil($paginas);
        return $paginas;
    }

    function getComentarios($order=null){
        if(!empty($order)){
            if ($order == "DESC"|| $order == "desc"){
                $sentencia = $this->db->prepare("SELECT * from comentarios join users on comentarios.id_user = users.id  ORDER BY comentarios.id desc");
            }else if($order == "ASC"|| $order == "asc"){
                $sentencia = $this->db->prepare("SELECT * from comentarios join users on comentarios.id_user = users.id  ORDER BY comentarios.id asc ");
            }
        }else{
            $sentencia = $this->db->prepare("SELECT * from comentarios join users on comentarios.id_user = users.id ");
        }
        $sentencia->execute();
        $commets = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $commets;
    }

    function getComentariosPag($page=null,$limit=null){
        $sentencia = $this->db->prepare("SELECT * from comentarios join users on comentarios.id_user = users.id LIMIT ".$page .",".$limit);
        $sentencia->execute();
        $commets = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $commets;
    }
 
 
    function getComentarioLibroDesc($id){
        $sentencia = $this->db->prepare( "SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro=? order by comentarios.id desc");
        $sentencia->execute(array($id));
        $commet = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $commet;
    }
    function getComentarioLibroDescPag($id,$page=null,$limit=null){
        $sentencia = $this->db->prepare( "SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro=? order by comentarios.id desc LIMIT ".$page .",".$limit);
        $sentencia->execute(array($id));
        $commet = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $commet;
    }
    function getComentarioLibroDescPunt($id,$puntuacion){
        $sentencia = $this->db->prepare( "SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro=? and puntuacion=? order by comentarios.id desc");
        $sentencia->execute(array($id,$puntuacion));
        $commet = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $commet;
    }

    function getComentarioLibroAsc($id){
        $sentencia = $this->db->prepare( "SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro=? order by comentarios.id asc");
        $sentencia->execute(array($id));
        $commet = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $commet;
    }
    function getComentarioLibroAscPag($id,$page=null,$limit=null){
        $sentencia = $this->db->prepare( "SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro=? order by comentarios.id asc LIMIT ".$page .",".$limit);
        $sentencia->execute(array($id));
        $commet = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $commet;
    }
    
    function getComentarioLibroAscPunt($id,$puntuacion){
        $sentencia = $this->db->prepare( "SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro=? and puntuacion=? order by comentarios.id asc");
        $sentencia->execute(array($id,$puntuacion));
        $commet = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $commet;
    }

    function getComentario($id){
        $sentencia = $this->db->prepare( "select * from comentarios WHERE id=?");
        $sentencia->execute(array($id));
        $commets = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $commets;
    }

    function getPuntuacion($puntuacion){
        $sentencia = $this->db->prepare( "select * from comentarios WHERE puntuacion=?");
        $sentencia->execute(array($puntuacion));
        $commets = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $commets;
    }

    function deleteComment($id){
        $sentencia = $this->db->prepare("DELETE FROM comentarios WHERE comentarios.id= ?");
        $sentencia->execute(array($id));
    }

    function insertComment($comentarios,$id_libro,$id_user,$puntuacion){
        $sentencia = $this->db->prepare("INSERT INTO comentarios (comentarios, id_libro, id_user, puntuacion) VALUES (?, ?, ?, ?)");
        $sentencia->execute(array($comentarios,$id_libro,$id_user,$puntuacion));
        return $this->db->lastInsertId();
    }
    function insertCommentFull($comentarios,$id_libro,$id_user,$puntuacion){
        $sentencia = $this->db->prepare("INSERT INTO comentarios (comentarios, id_libro, id_user, puntuacion) VALUES (?, ?, ?, ?)");
        $sentencia->execute(array($comentarios,$id_libro,$id_user,$puntuacion));
        return $this->db->lastInsertId();
    }

    //SELECT * from comentarios join users on comentarios.id_user = users.id join libros on comentarios.id_libro = libros.id
    //INSERT INTO comentarios (comentarios, id_libro, id_user, puntuacion)


    function getSearchPuntuacion($id,$puntuacion){
        $sentencia = $this->db->prepare( "SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro=? ORDER BY comentarios.puntuacion = ?;");
        $sentencia->execute(array($id,$puntuacion));
        $commet = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $commet;
    }
}