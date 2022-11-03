<div class="filtro">
      <label>
      Filtrar por:
      </label>
      <select class="w-13" name="" id="ordenamiento">
         <option  value="DESC">Ultimo</option>
         <option  value="ASC">Mas viejo</option>
      </select>
      <label>Filtrar por puntaje:</label>
         <select class="w-7" name="" id="puntajeInput">
            <option value="NULL">Sin filtro</option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
         </select>
         <a type="click" class="orderby btn btn-secondary"><i class="fas fa-search"></i></a>
      </div>
<input class="id_libro" value="{$libro->id}" type="hidden">
<input type="hidden"  class ="rol" value="{$rol}">
  
  <div >
    <div class="idcomment formComentarios" :value="comment.id" :id="comment.id"  v-for="comment in comments">
    {literal}
  <div class="  bg-light position-relative">
    <div>
    <div class="h5Color">
      <h5 class="mt-0"> Posteado por: {{comment.nombre_apellido}}</h5>
    </div>
        <div >
          <p> {{ comment.comentarios }} </p>
        </div>
    {/literal}
      <div v-for="puntaje in comment.puntuacion">

        <div class="estrellaDelete">
        <div v-if="puntaje === '0'">
          <span v-for="n in 5"><span class = "fa fa-star unchecked"></span></span>
        </div> 
        <div v-else-if="puntaje === '1'">
          <span v-for="n in 1"><span class = "fa fa-star checked"></span></span>
          <span v-for="n in 4"><span class = "fa fa-star unchecked"></span></span>
        </div>
        <div v-else-if="puntaje === '2'">
          <span v-for="n in 2"><span class = "fa fa-star checked"></span></span>
          <span v-for="n in 3"><span class = "fa fa-star unchecked"></span></span>
        </div>
        <div v-else-if="puntaje === '3'">
          <span v-for="n in 3"><span class = "fa fa-star checked"></span></span>
          <span v-for="n in 2"><span class = "fa fa-star unchecked"></span></span>
        </div>
        <div v-else-if="puntaje === '4'">
          <span v-for="n in 4"><span class = "fa fa-star checked"></span></span>
          <span v-for="n in 1"><span class = "fa fa-star unchecked"></span></span>
        </div>
        <div v-else-if="puntaje === '5'">
          <span v-for="n in 5"><span class = "fa fa-star checked"></span></span>
      </div>
      {if $rol == "1" || $rol == "2"}
            <button class="idcomment btn btn-outline-danger btn-sm" :value="comment.id" v-on:click="commentDelete(comment.id)">
            <i  class="fas fa-trash-alt"></i>
            </button> 
        {/if}
        </div> 
      </div>
    </div>
  </div>
  </div>
</div>