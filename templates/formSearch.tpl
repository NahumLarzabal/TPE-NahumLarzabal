<div class="new-libro">

    <select type="text" name="filtrado-libros" id="filter-table" class="form-select w-30" aria-label="Default select example" >
        <option selected disabled>Elemento a filtrar</option>      
        <option name="filtroTitulo" value="nombre_libro">Titulo</option>
        <option value="id_categoria">Genero</option>
        <option name="filtroAutor" value="autor">Autor</option>
    </select>
    <form class="invisible flex" id="select-titulo"  action="search/titulo" method="POST">
        <input type="text" class="margin-right-10px" name="tituloIn" placeholder="Filtre por Titulo" required>
        <button type="submit"class="btn btn-secondary" id="btn-list-libro" ><i class="fas fa-search"></i></button>
    </form>
    <form class="invisible flex" id="select-autor" action="search/autor" method="POST">
        <input type="text" class="margin-right-10px" name="autorIn" placeholder="Filtre por Autor" required>
        <button type="submit"class="btn btn-secondary" id="btn-list-libro" ><i class="fas fa-search"></i></button>
    </form>
    <form  class="invisible flex" id="select-genero"  action="search/genero" method="POST">
        <input type="text" class="margin-right-10px" name="generoIn" placeholder="Filtre por Genero" required>
        <button type="submit"class="btn btn-secondary" id="btn-list-libro" ><i class="fas fa-search"></i></button>
    </form>  

           {if isset($email) && ($rol == "1") || ($rol=="2")}
            <a  href="libros/agregar">
            <button class="btn btn-primary" id="btn-list-libro">Nuevo Libro</button> 
        </a>
    {/if}
</div> 
<script src="js/tableGenero.js"></script>
