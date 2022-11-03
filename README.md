# Brewery

Este proyecto se puede ver en (https://github.com/NahumLarzabal/TPE-NahumLarzabal) version BETA.

## Development server

Para correr este servidor de motor MVC se necesita intalar un par de cosas:

.Smarty
.Vue.js
.Xampp (para poder correr la base de datos (MySQL) y levantar el servidor(Apache))

Una ves instalado Xampp hay que ir a la carpeta donde lo alla instalado por ej:C:\xampp\htdocs\web2\TPE
en esta carpeta haremos la copia del repositorio para poder levantar el servidor luego.

Luego hay que abrir el navegador y poner:

http://localhost/phpmyadmin

En el cual crearas una nueva base de datos llamada: db_tpe, una vez creada tendras que importa la db_tpe que se encuentra en el repositorio
de esta manera obtendras los datos necesarios para poder ver el contenido de la paguina.

Una vez realizado los pasos anteriores hay que ir de nuevo a la paguina de internet y poner por ej: http://localhost/web2/TPE



## Uso de Rooter
Explicaremos que hace cada ruta para que le sea mas facil usar en postman saber que rutas escribir

## Vervo GET (busqueda sin filtros)

1. ` $router->addRoute('libros','GET','ApiController','getLibros') `
ej: ` http://localhost/web2/TPE-NahumLarzabal/api/libros `
Trae todos los Libros  existentes sin filtro alguno

2. `$router->addRoute('categorias','GET','ApiController','getCategorias')` 
ej: ` http://localhost/web2/TPE-NahumLarzabal/api/categorias `
Trae todos los Generos existentes sin filtro alguno

3. `$router->addRoute('comentarios','GET','ApiController','getComments')`
ej: ` http://localhost/web2/TPE-NahumLarzabal/api/comentarios `
Trae todos los Comentarios existentes sin filtro alguno

3. 1. `$router->addRoute('comentarios/page/:hoja/limit/:tope','GET','ApiController','getCommentsPag')` 
ej: ` http://localhost/web2/TPE-NahumLarzabal/api/comentarios/page/2/limit/2` 
Se filta todos los comentarios de forma paguinada con un limite de items

3. 2. `$router->addRoute('comentarios/orderby/:order','GET','ApiController','getComments')`
ej: ` http://localhost/web2/TPE-NahumLarzabal/api/comentarios/orderby/asc `
Ordena los comentarios en forma desendente o asendente (ASC o asc, DESC o desc) segun el mas nuevo al mas viejo o al reves

4. `$router->addRoute('usuarios','GET','ApiController','getUsers')` 
ej: ` http://localhost/web2/TPE-NahumLarzabal/api/usuarios `
Trae todos los Usuarios existentes sin filtro alguno

## Vervo GET (busqueda por ID y en caso de user por Email registrado)

1. `$router->addRoute('libro/:ID','GET','ApiController','getLibro')`
ej: `http://localhost/web2/TPE-NahumLarzabal/api/libro/1`
Busca un libro por su ID

2. `$router->addRoute('categoria/:ID','GET','ApiController','getCategoria')`
ej: ` http://localhost/web2/TPE-NahumLarzabal/api/categoria/1 `
Busca un genero por su ID

3. `$router->addRoute('libros/:ID/comentarios','GET','ApiController','getComment')`
ej: ` http://localhost/web2/TPE-NahumLarzabal/api/libros/1/comentarios `
Busca un libro por su ID y te trae todos los comentarios de ese libro

3. 1. `$router->addRoute('libros/:ID/comentarios/orderby/:order','GET','ApiController','getComment')`
ej: ` http://localhost/web2/TPE-NahumLarzabal/api/libros/1/comentarios/orderby/asc `
Busca y ordena los comentarios en forma desendente o asendente de un librro en espesifico (ASC o asc, DESC o desc)

3. 2. `$router->addRoute('libros/:ID/comentarios/orderby/:order/page/:hoja/limit/:tope','GET','ApiController','getCommentPag')`
ej: ` http://localhost/web2/TPE-NahumLarzabal/api/libros/1/comentarios/orderby/asc/page/1/limit/2 `
Busca y ordena los comentarios en forma desendente o asendente (ASC o asc, DESC o desc) de un libro en 
especifico en una paginacion con un limite de contencion dentro de la paguina


3. 3. `$router->addRoute('libros/:ID/comentarios/orderby/:order/puntaje/:puntaje','GET','ApiController','getCommentPuntaje')`
ej: ` http://localhost/web2/TPE-NahumLarzabal/api/libros/1/comentarios/orderby/asc/puntaje/2 `
Busca un libro especifico y te trae todos los comentarios en forma asendente o desendente (ASC o asc, DESC o desc) por la puntuacion que tengan los comentarios


4. `$router->addRoute('usuario/:email','GET','ApiController','getUser')`
ej: ` http://localhost/web2/TPE-NahumLarzabal/api/usuario/admin@gmail.com `
Busca al usuario por el Email con el que se registro ( el invitado tiene un mail predificido invitado@gmail.com)



## Verevo POST
1. `$router->addRoute('libros','POST','ApiController','insertLibro')`
ej: ``

2. `$router->addRoute('categorias','POST','ApiController','insertCategoria')`
ej: ``

3. `$router->addRoute('libros/:ID/comentarios','POST','ApiController','insertCommentX')`
ej: `http://localhost/web2/TPE-NahumLarzabal/api/libros/44/comentarios`
Para insertar un nuevo comentario en un libro en espesifico usar un JSON de este formato
{
        "comentarios": "nahum141112",
       "id_libro": 44,
       "id_user":"admin@gmail.com",
       "puntuacion": 3

}

el id_libro tiene que ser el mismo que el del parametro enviado

4. `$router->addRoute('usuarios','POST','ApiController','insertUser')`
ej: ``