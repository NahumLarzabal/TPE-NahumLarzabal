<?php
require_once './libs/smarty-3.1.39/libs/Smarty.class.php';
class LibroView{
    private $smarty;

    function __construct($email=null,$rol=null) {
        $this->smarty = new Smarty();
        $this->smarty->assign('email',$email);
        $this->smarty->assign('rol',$rol);
    }

    function showLibros($libros, $categorias, $paginas, $paginaActual){
        $this->smarty->assign('titulo','Titulo de Libro');
        $this->smarty->assign('libros', $libros);
        
        //arreglos para calcular los botones para la paginacion
        $this->smarty->assign('paginas', $paginas);
        $this->smarty->assign('paginaActual', $paginaActual);

        $this->smarty->assign('categorias', $categorias);
        $this->smarty->display('templates/libros.tpl');
    }

    function home(){
        $this->smarty->display('templates/home.tpl');
    }

    function showLibroLocation(){
        header("Location: ".BASE_URL."libros");
    }
    
    function showLibro($libro=null,$user=null,$order=null){
        $this->smarty->assign('libro', $libro);
        $this->smarty->assign('user', $user);
        $this->smarty->assign('order',$order);
        $this->smarty->display('templates/detalleLibro.tpl');
    }

    function showGenero($categorias){
         $this->smarty->assign('categorias', $categorias);
         $this->smarty->display('templates/form_genero.tpl');
     }

    function showEdit($libro,$categorias){
        $this->smarty->assign('titulo','Editar Libro');
        $this->smarty->assign('libro', $libro);
        $this->smarty->assign('categorias', $categorias);
        $this->smarty->display('templates/editarLibro.tpl');
    }

    function agregar($categorias){
        $this->smarty->assign('categorias', $categorias);
        $this->smarty->display('templates/crearLibro.tpl');
     }
     
    function searchView($libros,$categorias){
        $this->smarty->assign('titulo','Filtro');
        $this->smarty->assign('libros', $libros);
        $this->smarty->assign('categorias', $categorias);
        $this->smarty->display('templates/search.tpl');
    }

    function error(){
        $this->smarty->assign('Error','error');
        $this->smarty->display('templates/errorLibro.tpl');
    }

    function editPortada($id){
        header("Location: ".BASE_URL."libro/{$id}");
    }

}