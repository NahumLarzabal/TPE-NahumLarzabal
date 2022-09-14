<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{BASE_URL}" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styless.css">
    <!--  Add bootstrap icon Library  -->
   <<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- development version, includes helpful console warnings -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>CorLarz</title>
</head>

<body>
<div class="pagina"> <!-- NO CERRAR ESTE DIV -->
    <nav class="nav-list" id="nav-menu">
        <div class="top-nav-column">
            <img src="./img/logo.png" id="img-logo" alt="">
        </div>
        <div class="list-nav-column">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="blanco nav-link active" aria-current="page" href="">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="items">Listado de productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categorias">Listado de Categorias</a>
                </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="">Cargar Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Cargar Items</a>
                    </li>
                    <li class="nav-item">
                        
                        <a class="nav-link" href="">Administrar Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Cerrar sesion</a>
                    </li>
                    
            

            </ul>
        </div>
    </nav>
    <div class="content">
        <header>
            <div class="title">
                <h1>CorLarz Insumos para PC</h1>
        </div>
            <div class="login">

                <a class="btn btn-outline-primary btn-sm" href="login">Login </a>
                <a class="btn btn-outline-secondary btn-sm" href="logout">Logout </a>
            </div>   
        </header>
    