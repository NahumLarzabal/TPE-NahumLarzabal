{include file='templates/html.tpl'}
 <div class="container">
    <div class="producto">
      <input type="hidden" value="{$item->id}">
        <div class="title">
            <h3 class="mb-4">Titulo:<span>{$item->tipo_item}</span></h3>
        </div>
        <div class="marca">
            <h4>Marca: <span>{$item->marca}</span></h4>
        </div>

        <div class="precio">
          <h4>Precio: <span>$ {$item->precio}</span></h4>
        </div>

        <div class="categoria">
          <h4>Categoria: <span>{$item->categoria}</span></h4>
        </div>

        <div class="descripcion">
          <h4>Descripcion: {$item->descripcion}</h4>
        </div>
    </div>
    
  </div>
{include file='templates/footer.tpl'}