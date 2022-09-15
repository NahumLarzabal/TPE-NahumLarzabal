{include file='templates/header.tpl'}
<div class="contenedor-general">
    <div class="content-top-page">
        <div class="content-title">
            <h1>Listado de Generos</h1>
        </div>
        <div class="btn-libro">
            <a  href="generos/agregar">
               {if isset($email) && ($rol == "4") || ($rol =="3")}
               {else}
                    <button class="btn btn-primary" id="btn-list-libro">Nuevo Genero</button> 
                {/if}
            </a>
        </div>
    </div>

    <div class="main-table">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Genero</th>
                {if isset($email) && ($rol == "4") || ($rol=="3")}
                {elseif $rol ==  "2"}
                <th scope="col">Editar</th>
                {else}
                <th scope="col">Borrar</th>
                <th scope="col">Editar</th>
                {/if}
              </tr>
            </thead>
            <tbody>
                {foreach from=$categorias item=$categoria}
                <tr>
                    <td scope="row">{$categoria->categoria}</td>
                    {if isset($email) && ($rol == "4") || ($rol=="3")}
                    {elseif $rol ==  "2"}                       
                        <td>
                            <a class="alerta btn btn-success" href="genero/editar/{$categoria->id_categoria}" id="btn-categoria-edit">
                                <i class="far fa-edit"></i>
                            </a>     
                        </td>
                        {else}
                         <td>
                            <a class="btn btn-danger" href="deleteCategoria/{$categoria->id_categoria}" id="btn-categoria-delete">
                                <i class="fas fa-trash-alt"></i>
                            </a>

                        </td>
                        <td>
                            <a class="alerta btn btn-success" href="genero/editar/{$categoria->id_categoria}" id="btn-categoria-edit">
                                <i class="far fa-edit"></i>
                            </a>     
                        </td>

                        {/if}

                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
    {include file='templates/anuncio.tpl'}      
</div>
 
{include file='templates/footer.tpl'}