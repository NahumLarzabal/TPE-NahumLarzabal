{{include file='templates/header.tpl'}}
<div class="contenedor-general"> 

        <div class="content-top-page">
            <div class="content-title">
                <h1>{$titulo}</h1>
            </div>
            {include file='templates/formSearch.tpl'}
        </div>

        <div class="main-table">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Genero</th>
                    <th scope="col">Autor</th>
                    {if isset($email) && ($rol == "4") || ($rol=="3")}
                    <th scope="col">Precio</th>
                    {elseif $rol == "2"}
                    <th scope="col">Precio</th>
                    <th scope="col">Editar</th>
                    {else}
                    <th scope="col">Precio</th>
                    <th scope="col">Borrar</th>
                    <th scope="col">Editar</th>
                    {/if}
                </tr>
                </thead>
                <tbody>
                    {foreach from=$libros item=$libro}
                        <tr>
                            <td scope="row"><a href="viewLibro/{$libro->id}" id="titulo-libro">{$libro->nombre_libro}</a></td>
                            <td id="genero-libro">
                                <a id="genero-libro" 
                                    {foreach from=$categorias  item=$genero}
                                        {if {$genero->id_categoria} == {{$libro->id_categoria}}}>
                                            {$genero->categoria}
                                </a>     
                                        {/if} 
                                    {/foreach}
                            </td>
                            <td id="autor-libro">{$libro->autor}</td>
                            {if isset($email) && ($rol == "4") || ($rol=="3")}
                            <td id="precio-libro">{$libro->precio}</td>
                            {elseif $rol == "2"}
                            <td id="precio-libro">{$libro->precio}</td>
                            <td><a class="btn btn-success" href="editarLibro/{$libro->id}" id="btn-libro-edit"><i class="far fa-edit"></i></a></td>
                            {else}
                                <td id="precio-libro">{$libro->precio}</td>
                                <td><a class="btn btn-danger" href="deleteLibro/{$libro->id}" id="btn-libro-delete"><i class="fas fa-trash-alt"></i></a></td>
                                <td><a class="btn btn-success" href="editarLibro/{$libro->id}" id="btn-libro-edit"><i class="far fa-edit"></i></a></td>
                            {/if}
                        </tr>
                    {/foreach}
                </tbody>
            </table>
            <a href="libros">Volver al inicio</a>
        </div>
        {{include file='templates/anuncio.tpl'}}
</div>
{{include file='templates/footer.tpl'}}