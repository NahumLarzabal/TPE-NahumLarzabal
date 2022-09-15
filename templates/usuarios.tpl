{include file='templates/header.tpl'}

<div class="main-table">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Nombre de usuario</th>
            <th scope="col">Email</th>
            <th scope="col">Tipo de Usuario</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$users item=$user}
                {if $user->tipoUser !="4"}  {* si el usuario es diferente de invitado que se muestre en la lista*} 
                    <tr>
                        <td scope="row">{$user->nombre_apellido}</td>
                        <td scope="row">{$user->email}</td>
                        <td scope="row">
                            <select name="" id="" disabled>

                                {* invitado *}
                                <option value="3"
                                    {if ({$user->tipoUser}=="3")} selected
                                    {/if}>
                                    Usuario comun
                                </option>

                                {* usuario con derechos *}
                                <option value="2"
                                    {if ({$user->tipoUser}=="2")} selected
                                    {/if}>
                                    Administrador
                                </option>

                                {* usuario administrador *}
                                <option value="1"
                                    {if ({$user->tipoUser}=="1")} selected
                                    {/if}>
                                    Super usuario
                                </option>

                            </select>
                        </td>
                        <td>
                            <a class="btn btn-success" href="usuario/{$user->email}" id="btn-categoria-edit">
                                <i class="far fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="eliminarUsuario/{$user->email}" id="btn-categoria-delete">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                {/if}
            {/foreach}
        </tbody>
    </table>
</div>

{include file='templates/footer.tpl'}