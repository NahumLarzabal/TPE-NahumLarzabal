{include file='templates/header.tpl'}

<div class="contenedor-general"> 
  {* titulo y parte superior del contenedor *}
  <div class="content-top-page">
    <div class="content-title">
      <h1>Editar Usuario</h1>
    </div>
    <div class="btn-libro">
      <a href="usuarios">
        <button class="btn btn-primary" id="btn-list-libro">Listado de usuarios</button> 
      </a>
    </div>
  </div>

    {* formulario editor de usuario *}

  <form class="form-alta" action="editarUsuario" method="post">

    <div class="form-group row margin-15px">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="text" class="form-control desactivado" name="email" value="{$user->email}" id="email">
      </div>
    </div>

    <div class="form-group row margin-15px">
      <label for="nombre_apellido" class="col-sm-2 col-form-label">Nombre</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="nombre_apellido" value="{$user->nombre_apellido}" id="nombre_apellido">
      </div>
    </div>
    

    <div class="form-group row margin-15px">
      <label for="tipoUser" class="col-sm-2 col-form-label">Tipo de Usuario</label>
      <div class="col-sm-10">
        <select class="form-select" name="tipoUser" id="tipoUser">
                 {* invitado / comun *}
                <option value="3"
                    {if ({$user->tipoUser}=="3")} selected
                    {/if}>
                    Usuario comun
                </option>

                {* usuario administrador *}
                <option value="2"
                    {if ({$user->tipoUser}=="2")} selected
                    {/if}>
                    Administrador
                </option>

                {* usuario super administrador *}
                <option value="1"
                    {if ({$user->tipoUser}=="1")} selected
                    {/if} disabled>
                    Super usuario
                </option>
        </select>
      </div>
    </div>

    <div class="form-group row margin-15px">
      <div class="col-sm-10  btn-sub-center">
        <button type="submit" class="btn btn-primary" id="submit-create-libro">Editar Usuario</button>
      </div>
    </div>
  </form>

</div>
{include file='templates/anuncio.tpl'}
</div>
</div>
{include file='templates/footer.tpl'}