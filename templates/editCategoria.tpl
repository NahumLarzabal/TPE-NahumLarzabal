{include file='templates/header.tpl'}
<div class="container-table">
    <div class="conteiner-edit-categoria">
        <div>
            <h1>{$titulo}</h1>
        </div>
        <div class="btns-edit-categoria">
            <a href="libros" id="btn-izq">
                <button class="btn btn-primary" id="btn-list-libro">Listado de libros</button> 
            </a>
            <a href="generos">
                <button class="btn btn-success" id="btn-list-libro">Listado de Generos</button> 
            </a>
        </div>  
    </div>
    <form class="form-edit-categoria" action="editCategoria" method="post">
    {foreach from=$categorias item=$genero}
        <input name="id_categoria" type="hidden" value="{$genero->id_categoria}">
        <input placeholder="nombre nuevo" class="input-edit" type="text" name="categoria" value="{$genero->categoria}" required>  
    {/foreach}
        <input type="submit" class="btn btn-primary" value="Editar"> 
    </form>
    {include file='templates/anuncio.tpl'}
</div>
{include file='templates/footer.tpl'}