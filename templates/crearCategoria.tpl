{include file='templates/header.tpl'}

    <div class="contenedor-general"> 
        <div class="title-add-genero">
            <div class="content-title">
                <h1>Agregar genero literario</h1>
            </div>
            <div class="btn-libro">
                <a href="libros" id="btn-izq">
                    <button class="btn btn-primary" id="btn-list-libro">Listado de libros</button> 
                </a>
                <a href="generos">
                    <button class="btn btn-success" id="btn-list-libro">Listado de Generos</button> 
                </a>
            </div>
        </div>

        <div class="form-create-libro">
            <form class="form-alta" action="agregarCategoria" method="post">
                <div class="form-group margin-15px form-genero">
                    <label class="categoria">Nombre de Genero:</label>
                    <div class="col-sm-10">
                        <input type="text" name="categoria" id="categoria" class="form-control" required>
                        <div id="emailHelp" class="form-text">Maximo 50 caracteres.</div>
                    </div>
                </div>

                <div class="form-group row margin-15px">
                    <div class="col-sm-10  btn-sub-center">
                        <button type="submit" class="btn btn-primary"  id="submit-create-libro">Agregar genero</button>
                    </div>
                </div>
            </form>
        </div> 
      

    </div>

{include file='templates/footer.tpl'}
