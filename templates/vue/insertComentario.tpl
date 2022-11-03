<div class="">
<input class="nombreUserID" value="{$user}" type="hidden">
<input class="nombreUser" value="{$email}" type="hidden">
<input class="id_libro" value="{$libro->id}" type="hidden">
</div>
 {literal}
 <div class="insertCommentForm">
    <div>
      <form class="row g-3 form-insert-comentario"  action="">
      <div class="col-md-6 form-floating">
      <textarea required class="form-control comentario"  placeholder="Comentario" id="floatingTextarea2" name="post-text"></textarea>
      <label for="floatingTextarea2">Comentario</label>
      </div>
      <div class ="col-md-4">
         <label id="Estrellas" for="floatingTextarea2">Calificacion: </label>
         <button id="btn-insertComment" class="btn btn-primary" type="click">Enviar</button>
      </div>
         <input class="puntuacion" type="hidden" disabled>
      </form>
      
      </div> 
    </div>

 {/literal} 
