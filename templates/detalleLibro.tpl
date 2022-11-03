{include file='templates/header.tpl'}
    <div class="content-top-page">
      <div class="content-title">
        <h1>Detalle del libro</h1>
      </div>
      <div class="btn-libro">
        <a href="libros">
          <button class="btn btn-primary" id="btn-list-libro">Listado de libros</button> 
        </a>
      </div>
    </div>

  <div class="container">
    <div class="libro">
      <input id="idApi" class="id_libro" type="hidden" value="{$libro->id}">
        <div class="title">
            <h3 class="mb-4">Titulo:<span>{$libro->nombre_libro}</span></h3>
        </div>
        <div class="autor">
            <h4>Autor: <span>{$libro->autor}</span></h4>
        </div>

        <div class="genero">
          <h4>Genero: <span>{$libro->categoria}</span></h4>
        </div>

        <div class="precio">
          <h4>Precio: <span>${$libro->precio}</span></h4>
        </div>

        <div class="descripcion">
          <h4>Descripcion: {$libro->descripcion}</h4>
        </div>
    </div>
    <div class="portada">
      {if !empty($libro->imagen)}
        <div class="portada-img">
                <span>
                    <img class="portada-detalle" src="{$libro->imagen}"/>
                </span>
                {if isset($email) && (($rol == "1") || ($rol == "2"))}
                <a class="btn btn-danger" id="eliminar-portada" href="eliminarPortada/{$libro->id}">Eliminar portada</a>
                {/if}
        </div>
      {/if}
    </div>
  </div>

  <div>
    <h1 class="comentarios">Comentarios</h1>
  </div>

<div id="apiComentarios">
{if isset($email) && ($rol == "4")}
{include file='templates/vue/comentarios.tpl'}
{else}
{include file='templates/vue/insertComentario.tpl'}
{include file='templates/vue/comentarios.tpl'}
{/if}
</div>
<script src="./js/comentarios.js"></script>
<script src="./js/starrr.js"></script>
{include file='templates/anuncio.tpl'}
{include file='templates/footer.tpl'}
