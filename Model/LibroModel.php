<?php

class LibroModel{

    private $db;
    function __construct(){
         $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tpe;charset=utf8', 'root', '');
    }

    function paginacion(){
        $sentencia = $this->db->prepare( "SELECT libros.id, libros.autor, libros.nombre_libro, libros.precio, categorias.categoria, 
        libros.id_categoria, libros.imagen FROM libros JOIN categorias ON libros.id_categoria = categorias.id_categoria");
        $sentencia->execute();
        // contar cuantos libros hay en la bd
        $total_libros = $sentencia->rowCount();
        $paginas = $total_libros/libros_x_pagina;
        $paginas = ceil($paginas);
        return $paginas;
    }

    function getLibros($iniciar){
        $sentencia = $this->db->prepare( "SELECT libros.id, libros.autor, libros.nombre_libro, libros.precio, categorias.categoria, 
        libros.id_categoria, libros.imagen FROM libros JOIN categorias ON libros.id_categoria = categorias.id_categoria LIMIT " . $iniciar . "," . libros_x_pagina);
        $sentencia->execute();
        $libros = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $libros;
    }  
    function getLibrosX(){
        $sentencia = $this->db->prepare( "SELECT libros.id, libros.autor, libros.nombre_libro, libros.precio, categorias.categoria, 
        libros.id_categoria, libros.imagen FROM libros JOIN categorias ON libros.id_categoria = categorias.id_categoria ");
        $sentencia->execute();
        $libros = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $libros;
    }  
    
    function getLibro($id){
        $sentencia = $this->db->prepare( "SELECT libros.id, libros.autor, libros.nombre_libro, libros.descripcion, libros.precio, libros.imagen,
         libros.id_categoria,categorias.categoria FROM libros JOIN categorias ON libros.id_categoria = categorias.id_categoria WHERE id=?;");
        $sentencia->execute(array($id));
        $libro = $sentencia->fetch(PDO::FETCH_OBJ);
        return $libro;
    }

    function getLibroName($id){
        $sentencia = $this->db->prepare( "SELECT id, nombre_libro FROM libros WHERE nombre_libro=?;");
        $sentencia->execute([$id]);
        $libro = $sentencia->fetch(PDO::FETCH_OBJ);
        return $libro;
    }

    function uploadImage($image){
        $target = 'img/portadas/' . uniqid() . '.jpg';
        move_uploaded_file($image, $target);
        return $target;
    }

    function insertLibro($autor, $nombre_libro, $descripcion, $precio, $genero, $imagen=null){
        $pathImg = null;
        if ($imagen){
            $pathImg = $this->uploadImage($imagen);
        }
        $sentencia = $this->db->prepare("INSERT INTO libros (autor, nombre_libro, descripcion, precio, id_categoria, imagen) VALUES (?, ?, ?, ?, ?, ?)");
        $sentencia->execute(array($autor,$nombre_libro, $descripcion, $precio, $genero, $pathImg));
        return $this->db->lastInsertId();
    }
    
    function deleteLibroFromDB($id){
        $sentencia = $this->db->prepare("DELETE FROM libros WHERE libros.id = ?");
        $sentencia->execute(array($id));
    }

    function updateLibroFromDB($id,$autor,$nombre_libro, $descripcion, $precio, $genero, $imagen=null){
        $pathImg = null;
                $pathImg = $this->uploadImage($imagen);
                $sentencia = $this->db->prepare("UPDATE libros SET autor=?,nombre_libro=?,descripcion=?,precio=?,id_categoria=?,imagen=? WHERE libros.id =?");
                $sentencia->execute(array($autor,$nombre_libro,$descripcion,$precio,$genero,$pathImg,$id));
    }
    function insertEditLibro($id,$precio){
        $sentencia = $this->db->prepare("INSERT INTO libros (id,precio ) VALUES (?,?)");
        $sentencia->execute(array($id, $precio ));
    }

    function searchModelAutor($autor){
        $sentencia = $this->db->prepare("SELECT * FROM libros WHERE autor LIKE ?");
        $sentencia->execute(["%${autor}%"]);
        $autores = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $autores;
    }

    function searchModelTitulo($titulo){
        $sentencia = $this->db->prepare("SELECT * FROM libros WHERE nombre_libro LIKE ?");
        $sentencia->execute(["%${titulo}%"]);
        $titulos = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $titulos;
    }

    function searchModelGenero($genero){
        $sentencia = $this->db->prepare("select libros.id, libros.autor, libros.nombre_libro, libros.descripcion, libros.precio, 
        libros.id_categoria,categorias.categoria FROM libros JOIN categorias ON libros.id_categoria = categorias.id_categoria WHERE categorias.categoria LIKE ?");
        $sentencia->execute(["%${genero}%"]);
        $generos = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $generos;
    }
    
    function eliminarPortada($id){
        $sentencia = $this->db->prepare("UPDATE libros SET imagen=NULL WHERE libros.id =?");
        $sentencia->execute(array($id));
    }
}