<?php

class LibroModel{

    private $db;
    function __construct(){
         $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tpe;charset=utf8', 'root', '');
    }

    function paginacion($limit=null){
        $sentencia = $this->db->prepare( "SELECT libros.id, libros.autor, libros.nombre_libro, libros.precio, categorias.categoria, 
        libros.id_categoria, libros.imagen FROM libros JOIN categorias ON libros.id_categoria = categorias.id_categoria");
        $sentencia->execute();
        // contar cuantos libros hay en la bd
        $total_libros = $sentencia->rowCount();
        if($limit!=null){
            $paginas = $total_libros/$limit;
        }else{
            $paginas = $total_libros/libros_x_pagina;
        }
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
    function valueSort($sort=null){
        $tabla="libros";
        if($sort == "categoria"){
            $tabla="categorias";
        }
        $sentencia = $this->db->prepare("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME = ? AND TABLE_NAME = '$tabla'");
        $sentencia->execute(array($sort));
        $columna = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return count($columna);
    }
   

    function getLibrosAll($sort=null,$order=null,$page=null,$limit=null,$like=null){
        //str_replace('_normal', '', $var)
        $string = "WHERE {sort} LIKE '%{like}%' ORDER BY {sort2} {order} LIMIT {'page'} , {'limit'} ";
       if($like == null){
           $string = str_replace('LIKE','',$string);
           $string = str_replace("'%{like}%'",'',$string);
       }else{
        $string = str_replace("'%{like}%'",'?',$string);
       }
       if($sort == null){
           $string = str_replace('WHERE','',$string);
           $string = str_replace('{sort}','',$string);
        }else if($sort!=null && $like==null && $page==null){
            $string = str_replace('WHERE','',$string);
           $string = str_replace('{sort}','',$string);
            $string = str_replace('{sort2}',$sort,$string);
        }else if($sort != null && $order == null){
            $string = str_replace('{sort2}',$sort,$string);
        }else{
            $string = str_replace('{sort}',$sort,$string);
            //$string = str_replace('{sort2}',$sort,$string);
        }
        if($order == null ){
            $string = str_replace('ORDER','',$string);
            $string = str_replace('BY','',$string);
            $string = str_replace('{order}','',$string);
        }else if($order !=null && $sort !=null && $sort != "nombre_libro or autor"){
            $string = str_replace('{sort2}',$sort,$string);
            $string = str_replace('{order}',$order,$string);
        }else if($order !=null ){
            $string = str_replace('{sort2}','id',$string);
            $string = str_replace('{order}',$order,$string);
        }else{
            $string = str_replace('{sort2}','"id"',$string);
            $string = str_replace('{order}','asc',$string);

        }

        if($page == null&& $page<0){
            $string = str_replace('LIMIT','',$string);
            $string = str_replace("{'page'}",'',$string);
            $string = str_replace(",",'',$string);
            $string = str_replace("{'limit'}",'',$string);
        }else if($page>=0){
            $string = str_replace("{'page'}",$page,$string);
            $string = str_replace("{'limit'}",$limit,$string);
        }

        if($limit== null){
            $string = str_replace('LIMIT','',$string);
            $string = str_replace(",",'',$string);
        }

        var_dump($sentencia = $this->db->prepare($string));
            
            $sentencia = $this->db->prepare("SELECT libros.id, libros.autor, libros.nombre_libro, libros.precio, categorias.categoria,libros.id_categoria, libros.imagen FROM 
            libros JOIN categorias ON libros.id_categoria = categorias.id_categoria $string");
             if($like == null){
                $sentencia->execute();
            }else{ 
                $sentencia->execute(["%$like%"]);
            }

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
   

    function getLibroName($name){
        $sentencia = $this->db->prepare( "SELECT id, nombre_libro FROM libros WHERE nombre_libro=?");
        $sentencia->execute([$name]);
        $libro = $sentencia->fetch(PDO::FETCH_OBJ);
        return $libro;
    }
    function getLibroAutor($name){
        $sentencia = $this->db->prepare( "SELECT id, autor FROM libros WHERE autor=?");
        $sentencia->execute([$name]);
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
    function deleteLibro($id){
        $sentencia = $this->db->prepare("DELETE FROM libros WHERE libros.nombre_libro = ?");
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