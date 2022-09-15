{include file='templates/header.tpl'}
{* content *}
  <div class="contenedor-general"> 
    {* titulo y parte superior del contenedor *}
    <div class="content-top-page">
      <div class="content-title">
          <h1>Crear libro</h1>
        </div>
        <div class="btn-libro">
          <a href="libros">
            <button class="btn btn-primary" id="btn-list-libro">Listado de libros</button> 
          </a>
        </div>
      </div>

    {* formulario creacion de libro *}
    <form action="createLibro" method="post" enctype="multipart/form-data">

        <div class="form-group row margin-15px">
          <label for="nombre_libro" class="col-sm-2 col-form-label">Titulo del libro</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Titulo del libro" name="nombre_libro" id="nombre_libro" required>
            <div id="emailHelp" class="form-text">Maximo 180 caracteres.</div>
          </div>
        </div>

        <div class="form-group row margin-15px">
          <label for="autor" class="col-sm-2 col-form-label">Autor:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="form-label" placeholder="Autor" name="autor" id="autor" required>
          </div>
        </div>

        <div class="form-group row margin-15px">
            <label for="id_categoria" class="col-sm-2 col-form-label">Genero:</label>
          <div class="col-sm-10">
              <select class="form-select" name="id_categoria" id="id_categoria">
                  <option selected disabled>Elegi un genero</option>  
                {foreach from=$categorias  item=$genero}
                  <option value={$genero->id_categoria}>{$genero->categoria}</option>
                {/foreach}
              </select>
          </div>
        </div>

        <div class="form-group row margin-15px">
          <label for="descripcion" class="col-sm-2 col-form-label">Descripcion:</label>
          <div class="col-sm-10">
            <textarea type="text" class="form-control" id="descripcion" name="descripcion">
            </textarea>
            <div id="emailHelp" class="form-text">Maximo 500 caracteres.</div>
          </div>
        </div>

        <div class="form-group row margin-15px">
          <label for="precio" class="col-sm-2 col-form-label">Precio:</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="precio" name="precio">
            <div id="emailHelp" class="form-text">Precio en $.</div>
          </div>
        </div>

      <div class="form-group row margin-15px">
        <label for="portada" class="col-sm-2 col-form-label">Portada:</label>
        <div class="col-sm-10">
          <input type="file" name="input_name" id="imageToUpload">
        </div>
      </div>
  
      <div class="form-group row margin-15px">
        <div class="col-sm-10  btn-sub-center">
          <button type="submit" class="btn btn-primary"  id="submit-create-libro">Crear libro</button>
        </div>
      </div>
      </div>
    </form>
{include file='templates/anuncio.tpl'}
{include file='templates/footer.tpl'}
