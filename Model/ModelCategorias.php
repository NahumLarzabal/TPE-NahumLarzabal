<?php

class ModelCategorias{
    private $db;
    function __construct(){
       $this->db = new PDO('mysql:host=localhost;'.'dbname=tpecl_db;charset=utf8', 'root', '');
    }
    function getCategorias(){
        $sentencia = $this->db->prepare( "select * from categorias");
        $sentencia->execute();
        $categorias = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $categorias;
    }

}


?>