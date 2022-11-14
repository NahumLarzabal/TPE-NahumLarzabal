# **Brewery**

[**->Este proyecto se puede ver aqui<-**](https://github.com/NahumLarzabal/TPE-NahumLarzabal)

## *Development server* 📄

💻 Para correr este servidor de motor MVC se necesita intalar un par de cosas:

 .Smarty

 .Vue.js

 .Xampp (para poder correr la base de datos (MySQL) y levantar el servidor(Apache))

📁Una ves instalado Xampp hay que ir a la carpeta donde lo alla instalado por **ej: C:\xampp\htdocs\web2\TPE**
en esta carpeta haremos la copia del repositorio para poder levantar el servidor luego.

🧑‍💻Luego hay que abrir el navegador🌍 y poner:

http://localhost/phpmyadmin

En el cual crearas una nueva base de datos llamada: db_tpe, una vez creada tendras que importa la db_tpe que se encuentra en el repositorio
de esta manera obtendras los datos necesarios para poder ver el contenido de la paguina.

Una vez realizado los pasos anteriores hay que ir de nuevo a la paguina de internet y poner por ej: http://localhost/web2/TPE


<!-- Documentar segun las tablas, Usuer, Libros, Categorias, Comentarios -->
## **Uso de Rooter** 📄

Explicaremos que hace cada ruta para que le sea mas facil usar en postman y saber que rutas escribir 🦾

# El Recurso de libros  📚


## Funcionalidades del recurso GET '*Libros*' 📗

ej: ` http://localhost/web2/TPE-NahumLarzabal/api/libros `

Trae todos los Libros  existentes sin filtro alguno
parametros que se pueden utilizar en sort:

        { 
                "autor" 
                "nombre" 
                "descripcion" 
                "precio"
                "categoria" 
                "categoria" 
                "imagen"
        }

ej: `http://localhost/web2/TPE-NahumLarzabal/api/libro/1`

Busca un libro por su ID

### Funcionalidades del Search '*Comentarios*' 🔎
 Los parametros de busqueda despues ? son: ***sort, orderby, page y limit.***
 En orderby ASC o asc, DESC o desc unicamente

ej: ` http://localhost/web2/TPE-NahumLarzabal/api/libros?orderby=asc `

Ordena los comentarios en forma desendente o asendente 
 
ej: ` http://localhost/web2/TPE-NahumLarzabal/api/libros?sort=autor&orderby=asc `

Ordena los comentarios en forma desendente o asendente  segun el mas nuevo al mas viejo o al reves

 
ej: ` http://localhost/web2/TPE-NahumLarzabal/api/libros?sort=descripcion&orderby=asc&page=1&limit=5 `

Se filta todos los comentarios de una forma paginada con un limite de items y  los comentarios en forma desendente o asendente


## Funcionalidades del recurso POST '*Libros*'📘

ej: `http://localhost/web2/TPE-NahumLarzabal/api/libro`

Para insertar un nuevo libro usar un JSON de este formato

        {
                "autor": "nahum asc",
                "nombre_libro": "asda",
                "descripcion": "asda",
                "precio": 55,
                "genero":"Terror",
                "imagen": null
        }

la imagen se puede subir una vez crado el item unicamente

## Funcionalidades del recurso DELETE '*Libros*' 📕

🛑🛑🛑🛑🛑🛑🛑🛑🛑🛑🛑***Cuidado con el delete que no tiene vuelta atras***🛑🛑🛑🛑🛑🛑🛑🛑🛑🛑


ej: `http://localhost/web2/TPE-NahumLarzabal/api/libro/5` 

ej: `http://localhost/web2/TPE-NahumLarzabal/api/libro/PEron`

se puede eliminar tanto por nombre de nombre_libro si se sabe o por el numero id del mismo

## Funcionalidades del recurso PUT '*Libros*' 📙

ej: `http://localhost/web2/TPE-NahumLarzabal/api/libro/1`

se busca el libro por el id y el campo de genero tiene que ser con nombre, de ahi revisa si existe el mismo para updatear el libro

        {
                "autor": "nahum asc",
                "nombre_libro": "asda",
                "descripcion": "asda",
                "precio": 55,
                "genero":"Ciencia Ficcion",
                "imagen": null
        }


# El Recurso de Categorias  💬

## Funcionalidades del recurso GET '*Categorias*' 📗

ej: ` http://localhost/web2/TPE-NahumLarzabal/api/categorias `

Trae todos los Generos existentes sin filtro alguno

ej: ` http://localhost/web2/TPE-NahumLarzabal/api/categoria/1 `

Busca un genero por su ID

### Funcionalidades del Search '*Comentarios*' 🔎

 Los parametros de busqueda despues ? son: ***sort, orderby, page y limit.***
 En orderby ASC o asc, DESC o desc unicamente

ej: ` http://localhost/web2/TPE-NahumLarzabal/api/categorias?orderby=asc   `

Ordena los comentarios en forma desendente o asendente segun el mas nuevo al mas viejo o al reves


ej: ` http://localhost/web2/TPE-NahumLarzabal/api/categorias?orderby=desc&page=1&limit=5  `

Se filta todos los comentarios de una forma paginada con un limite de items y  los comentarios en forma desendente o asendente segun el mas nuevo al mas viejo o al reves


## Funcionalidades del recurso POST '*Categorias*' 📘

ej: `http://localhost/web2/TPE-NahumLarzabal/api/categoria`

Para insertar una nueva categoria (genero de libro) usar un JSON de este formato

        {
                "categoria": "Comedia" 
        }

## Funcionalidades del recurso DELETE '*Categorias*' 📕
 
ej: `http://localhost/web2/TPE-NahumLarzabal/api/categoria/papafirta` o `http://localhost/web2/TPE-NahumLarzabal/api/categoria/4`

se puede eliminar tanto por nombre de categoria si se sabe o por el numero id del mismo

## Funcionalidades del recurso PUT '*Categorias*' 📙

ej: `http://localhost/web2/TPE-NahumLarzabal/api/categoria/1` o `http://localhost/web2/TPE-NahumLarzabal/api/categoria/Novela`

hay que enviar un json con estos parametros, ademas la url distinge el parametro id con el nobre de la categoria por si el usuario no sabe el id de la categoria

        {
                "categoria": "Novela"
        }




# El Recurso de Comentarios☁️
## Funcionalidades del recurso GET '*Comentarios*' 📗

ej: ` http://localhost/web2/TPE-NahumLarzabal/api/comentarios `

Trae todos los Comentarios existentes sin filtro alguno

### Funcionalidades del Search '*Comentarios*' 🔎
 Los parametros de busqueda despues ? son: ***sort, orderby, page y limit.***
 En orderby ASC o asc, DESC o desc unicamente
ej: ` http://localhost/web2/TPE-NahumLarzabal/api/comentarios?orderby=asc `

Ordena los comentarios en forma desendente o asendente segun el mas nuevo al mas viejo o al reves


ej: ` http://localhost/web2/TPE-NahumLarzabal/api/comentarios?orderby=desc&page=1&limit=5` 

Se filta todos los comentarios de una forma paginada con un limite de items y  los comentarios en forma desendente o asendente segun el mas nuevo al mas viejo o al reves


ej: ` http://localhost/web2/TPE-NahumLarzabal/api/comentarios/libro/3`

Busca un libro por su ID y te trae todos los comentarios de ese libro


ej: ` http://localhost/web2/TPE-NahumLarzabal/api/comentarios/libro/5?orderby=asc `

Busca y ordena los comentarios en forma desendente o asendente de un libro en espesifico 

ej: ` http://localhost/web2/TPE-NahumLarzabal/api/comentarios/libro/8?orderby=desc&page=1&limit=5` 

Busca y ordena los comentarios en forma desendente o asendente de un libro en 
especifico en una paginacion con un limite de contencion dentro de la pagina



ej: ` http://localhost/web2/TPE-NahumLarzabal/api/comentarios/libro/44?orderby=desc&page=1&limit=5&star=2 `

ej: ` http://localhost/web2/TPE-NahumLarzabal/api/comentarios/libro/1?orderby=desc&star=2 `

ej: ` http://localhost/web2/TPE-NahumLarzabal/api/comentarios/libro/4?star=2 `

Busca un libro especifico y te trae todos los comentarios en forma asendente o desendente  por la puntuacion que tengan los comentarios y de forma paginada
en caso de no querer paginacion hay q borrar page y limit y en caso de no querer ordenarlas sacar orderby


## Funcionalidades del recurso POST '*Comentarios*'📘
 
ej: `http://localhost/web2/TPE-NahumLarzabal/api/libros/44/comentarios`

Para insertar un nuevo comentario en un libro en espesifico usar un JSON de este formato

        {
                "comentarios": "nahum141112",
        "id_libro": 44,
        "id_user":"admin@gmail.com",
        "puntuacion": 3

        }

el id_libro tiene que ser el mismo que el del parametro enviado
## Funcionalidades del recurso DELETE '*Comentarios*' 📕

ej: `http://localhost/web2/TPE-NahumLarzabal/api/comentarios/119/libro/1`

para eliminar un comentario de un libro hay que saber el id del libro y el id del comentario


# El Recurso de Usuarios  👨‍👩‍👧‍👦👨‍👩‍👧‍👦

## Funcionalidades del recurso GET '*Usuarios*' 📗

ej: ` http://localhost/web2/TPE-NahumLarzabal/api/usuarios `

Trae todos los Usuarios existentes sin filtro alguno

ej: ` http://localhost/web2/TPE-NahumLarzabal/api/usuario/admin@gmail.com `

Busca al usuario por el Email con el que se registro ( el invitado tiene un mail predificido invitado@gmail.com)



### Funcionalidades del Search '*Usuarios*' 🔎
 Los parametros de busqueda despues ? son: ***sort, orderby, page y limit.***
 En orderby ASC o asc, DESC o desc unicamente

ej: `  http://localhost/web2/TPE-NahumLarzabal/api/usuarios?orderby=asc `

Ordena los comentarios en forma desendente o asendente  segun el mas nuevo al mas viejo o al reves


ej: `  http://localhost/web2/TPE-NahumLarzabal/api/usuarios?orderby=desc&page=1&limit=5` 

Se filta todos los comentarios de una forma paginada con un limite de items y  los comentarios en forma desendente o asendente segun el mas nuevo al mas viejo o al reves



## Funcionalidades del recurso POST '*Usuarios*'📘

ej: `http://localhost/web2/TPE-NahumLarzabal/api/usuario`

Para insertar un nuevo usuario usar un JSON de este formato

        {
                "email": "pepeargento@gmail.com",
                "password":"123456",
                "nombre": "kimberly" 
        }

el password cuando se crea se hashea y en el proseso de crear un usuario se revisa que sea un correo lo que envie y si ese correo existe previamente

## Funcionalidades del recurso DELETE '*Usuarios*' 📕


ej: `http://localhost/web2/TPE-NahumLarzabal/api/usuario/17` 
 
ej: `http://localhost/web2/TPE-NahumLarzabal/api/usuario/pepepe@gmail.com`

se puede eliminar tanto por email del usuario si se sabe o por el numero id del mismo

## Funcionalidades del recurso PUT '*Usuarios*' 📙
 
ej: `http://localhost/web2/TPE-NahumLarzabal/api/usuario/1`

ej: `http://localhost/web2/TPE-NahumLarzabal/api/usuario/nicolas@gmail.com`

El admin no podra cambiar ningun dato por ningun medio posible de put unicamente podra hacer cambio de sus datos desde la base de datos

en este caso se puede cambiar los 3 datos siempre y cuando el id exista o el mail exista

        {
                "email": "pepeargento@gmail.com",
                "password":"123456",
                "nombre": "kimberly" 
        }
        
*tambien se puede cambiar los datos por separado enviado en json 1 elemento a la vez*


# El Recurso de Usuarios por meido de Autorizacion ✔️

## Funcionalidades del recurso GET '*Usuarios*' 📗
ej: `http://localhost/web2/TPE-NahumLarzabal/api/token`

En postman hay que ir al apartado de ***Authorization*** y seleccionar ***Basic Auth*** , en la parte de Username y Password hay que colocar un usuairo valido por luego hay que darle a SEND el cual nos dara el ***Token*** que necesitamos para seguir haciendo el PUT.

ej:`http://localhost/web2/TPE-NahumLarzabal/api/token/usuario/asd7a@gmail.com`

Luego haciendo el mismo procedimiento pero seleccioando ***Bearer Token*** , nos dara la informacion del usuario que estamos pidiendo hay que poner el Email (ej: asd7a@gmail.com) 

## Funcionalidades del recurso POST '*Usuarios*'📘
ej:`http://localhost/web2/TPE-NahumLarzabal/api/token/usuario`

En postman hay que ir al apartado de ***Authorization*** y seleccionar ***Basic Auth*** , en la parte de Username y Password cargar los datos y darle SEND  nos dara el ***Token*** que necesitamos, siempre y cuando el email que se esta ingresando ya exista


## Funcionalidades del recurso PUT '*Usuarios*' 📙
ej: `http://localhost/web2/TPE-NahumLarzabal/api/token/usuario/asd7a@gmail.com`

En postman hay que ir al apartado de ***Authorization*** y seleccionar ***Bearer Token*** hay que colocar el token del usuario que traemos del recurso GET, hay que ingresar en el apartado ***Body***  y dentro de en ***raw*** y mandar este pedaso de JSON en el cual se podra mandar cualquiera de los parametros.

Las opciones son: email,password,nombre o email,password o email,nombre o email o passowrd,nombre o passowrd o nombre;

        {
                "email": "pepeargento@gmail.com",
                "password":"123456",
                "nombre": "kimberly" 
        }
        