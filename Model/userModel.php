<?php

class userModel{

    private $db;
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tpe;charset=utf8', 'root', '');
    }

    function getUser($email){
        $query = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function getUsers(){
        $query = $this->db->prepare('SELECT * FROM users');
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }

    function insertUser($userEmail,$userPassword,$userNombre){
        $query = $this->db->prepare('INSERT INTO users (email, password,nombre_apellido) VALUES (?,?,?)');
        $query->execute([$userEmail,$userPassword,$userNombre]);
        return $this->db->lastInsertId();
    }

    function deleteUsuario($userEmail){
        $query = $this->db->prepare('DELETE FROM users WHERE users.email = ?');
        $query->execute(array($userEmail));
    }

    // funcion administrador para editar usuario 
    function editarTipoUser($tipoUser){
        $sentencia = $this->db->prepare("UPDATE users SET tipoUser=?");
        $sentencia->execute($tipoUser);
    }
    
    function editUser($nombre_apellido,$tipoUser,$email){
        $sentencia = $this->db->prepare("UPDATE users SET nombre_apellido=?,tipoUser=? WHERE email = ?");
        $sentencia->execute(array($nombre_apellido,$tipoUser,$email));
    }
}
