<?php

class ModelItems{
    private $db;
    function __construct(){
       $this->db = new PDO('mysql:host=localhost;'.'dbname=tpecl_db;charset=utf8', 'root', '');
    }
    function getItems(){
        $sentencia = $this->db->prepare( "SELECT *, categorias.categoria FROM items JOIN categorias ON items.id_categoria = categorias.id_categoria");
        $sentencia->execute();
        $item = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $item;
    }
    function getItem($id){
        $sentencia = $this->db->prepare("SELECT *,categorias.categoria FROM items JOIN categorias ON items.id_categoria = categorias.id_categoria WHERE id=?");
        $sentencia->execute(array($id));
        $item = $sentencia->fetch(PDO::FETCH_OBJ);
        return $item;
    }
    function searchCategoria($categoria){
        $sentencia = $this->db->prepare("SELECT *, categorias.categoria FROM items JOIN categorias ON items.id_categoria = categorias.id_categoria WHERE categorias.categoria LIKE ?");
        $sentencia->execute(["%${categoria}%"]);
        $item = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $item;
    }
    

}


?>