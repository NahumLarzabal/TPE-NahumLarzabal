<?php

class ComentariosModel{
    private $db;
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tpe;charset=utf8', 'root', '');
    }

    function getComentarios($order=null,$page=null,$limit=null){
        if(!empty($order)&&!empty($page)&&!empty($limit)){
            $sentencia = $this->db->prepare("SELECT * from comentarios join users on comentarios.id_user = users.id ORDER BY comentarios.id ".$order ." LIMIT ".$page .",".$limit);
        }else if(!empty($order)){
            $sentencia = $this->db->prepare("SELECT * from comentarios join users on comentarios.id_user = users.id  ORDER BY comentarios.id ".$order); 
        }else{
            $sentencia = $this->db->prepare("SELECT * from comentarios join users on comentarios.id_user = users.id "); 
        } 
        $sentencia->execute();
        $commets = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $commets;
    }

    function getComentarioLibro($id,$order=null,$page=null,$limit=null,$star=null){
        if(!empty($order)&&!empty($page)&&!empty($limit)&&!empty($star)&&$page!=null && $limit!=null){
            $sentencia = $this->db->prepare("SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, 
            users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro= $id and puntuacion= $star order by comentarios.id ".$order ." LIMIT ".$page .",".$limit);
        }else if(!empty($order)&&!empty($page)&&!empty($limit)){
            $sentencia = $this->db->prepare("SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, 
            users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro= $id order by comentarios.id ".$order ." LIMIT ".$page .",".$limit);
        }else if(!empty($order)&&!empty($star)){
            $sentencia = $this->db->prepare("SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, 
            users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro= $id and puntuacion= $star order by comentarios.id ".$order);
         }else if($order>=0 && $order<=5){
            //aca como order es el 2 parametro q encuentra cuando mando las star en ruta de postman me envia el 2 parametro por ende es order
            $sentencia = $this->db->prepare("SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, 
            users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro= $id and puntuacion= $order"); 
        }else if(!empty($order)){
            $sentencia = $this->db->prepare("SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, 
            users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro= $id order by comentarios.id " .$order); 
        }else{
        $sentencia = $this->db->prepare( "SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, 
        users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro= $id");
        } 
        $sentencia->execute();
        $commet = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $commet;
    }
 
    function getComentarioLibroDesc($id){
        $sentencia = $this->db->prepare( "SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, 
        users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro=? order by comentarios.id desc");
        $sentencia->execute(array($id));
        $commet = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $commet;
    }
    function getComentarioLibroDescPunt($id,$puntuacion){
        $sentencia = $this->db->prepare( "SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, 
        users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro=? and puntuacion=? order by comentarios.id desc");
        $sentencia->execute(array($id,$puntuacion));
        $commet = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $commet;
    }

    function getComentarioLibroAsc($id){
        $sentencia = $this->db->prepare( "SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, 
        users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro=? order by comentarios.id asc");
        $sentencia->execute(array($id));
        $commet = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $commet;
    }
    
    function getComentarioLibroAscPunt($id,$puntuacion){
        $sentencia = $this->db->prepare( "SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, 
        users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro=? and puntuacion=? order by comentarios.id asc");
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

    function insertComment($comentarios,$puntuacion,$id_libro,$id_user){
        $sentencia = $this->db->prepare("INSERT INTO comentarios (comentarios, id_libro, id_user, puntuacion) VALUES (?, ?, ?, ?)");
        $sentencia->execute(array($comentarios,$id_libro,$id_user,$puntuacion));
        return $this->db->lastInsertId();
    }
    function getSearchPuntuacion($id,$puntuacion){
        $sentencia = $this->db->prepare( "SELECT comentarios.id,comentarios.puntuacion,comentarios.comentarios,comentarios.id_libro, users.nombre_apellido, 
        users.tipoUser FROM comentarios JOIN users ON comentarios.id_user = users.id WHERE id_libro=? ORDER BY comentarios.puntuacion = ?;");
        $sentencia->execute(array($id,$puntuacion));
        $commet = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $commet;
    }
}