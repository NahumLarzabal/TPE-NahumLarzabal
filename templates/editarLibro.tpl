{include file='templates/header.tpl'}

<div class="contenedor-general"> 
  {* titulo y parte superior del contenedor *}
  <div class="content-top-page">
    <div class="content-title">
      <h1>Editar libro</h1>
    </div>
    <div class="btn-libro">
      <a href="libros">
        <button class="btn btn-primary" id="btn-list-libro">Listado de libros</button> 
      </a>
    </div>
  </div>

    {* formulario editor de libro *}
  <form class="form-alta" action="edit" method="post" enctype="multipart/form-data">  
    <input name="id" type="hidden" value="{$libro->id}">
    <div class="form-group row margin-15px">
      <label for="nombre_libro" class="col-sm-2 col-form-label">Titulo del libro</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="nombre_libro" value="{$libro->nombre_libro}" id="nombre_libro">
        <div id="emailHelp" class="form-text">Maximo 180 caracteres.</div>
      </div>
    </div>

    <div class="form-group row margin-15px">
      <label for="autor" class="col-sm-2 col-form-label">Autor:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="autor" value="{$libro->autor}" id="autor">
      </div>
    </div>

    <div class="form-group row margin-15px">
      <label for="id_categoria" class="col-sm-2 col-form-label">Genero:</label>
      <div class="col-sm-10">
        <select class="form-select" name="id_categoria" id="id_categoria">
                {foreach from=$categorias  item=$genero}
                <option 
                {if {$genero->id_categoria} == {{$libro->id_categoria}}}
                    
                    selected={$genero->id_categoria}
                    
                {/if} 
                value={$genero->id_categoria} >{$genero->categoria}</option>
                {/foreach}
        </select>
      </div>
    </div>

    <div class="form-group row margin-15px">
      <label for="descripcion" class="col-sm-2 col-form-label">Descripcion:</label>
      <div class="col-sm-10">
        <textarea type="text" class="form-control" id="descripcion" name="descripcion">
          {$libro->descripcion}
        </textarea>
        <div id="emailHelp" class="form-text">Maximo 500 caracteres.</div>
      </div>
    </div>

    <div class="form-group row margin-15px">
      <label for="precio" class="col-sm-2 col-form-label">Precio:</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="precio" value="{$libro->precio}" name="precio">
        <div id="emailHelp" class="form-text">Precio en $.</div>
      </div>
    </div>

    <div class="form-group row margin-15px">
      <label for="portada" class="col-sm-2 col-form-label">Portada:</label>
      <div class="col-sm-10">
        <input type="file" name="input_name" id="imageToUpload">
      </div>
    </div>

    {if !empty($libro->imagen)}
      <div class="form-group row margin-15px">
      <label for="portada" class="col-sm-2 col-form-label">Eliminar Portada:</label>
        <div class="col-sm-10">
                <a class="btn btn-danger" id="" href="eliminarPortada/{$libro->id}"><i class="fas fa-trash-alt"></i></a>
        </div>
      </div>
    {/if}
  
    <div class="form-group row margin-15px">
      <div class="col-sm-10  btn-sub-center">
        <button type="submit" class="btn btn-primary"  id="submit-create-libro">Editar libro</button>
      </div>
    </div>
  </form>

</div>
{include file='templates/anuncio.tpl'}
</div>
</div>
{include file='templates/footer.tpl'}

