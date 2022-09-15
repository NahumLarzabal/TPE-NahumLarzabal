<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{BASE_URL}" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/stylecss.css">

    <title>Login Libreria</title>
</head>

<body>
    <div class="contenedor-general-login">

        <div class="container-login colorDiv">

            <div class="logo-login">
                <img class="w-50" src="./img/logo.png" alt="logo">
            </div>
            <div class="title-login">
                <h2 class="tituloLogin">{$titulo}</h2>
            </div>

            <div class="form-createLogin">
                <form class="form-alta" action="createUser" method="post">
                    <div class="input-login">
                        <input class="loginInput" placeholder="email@email.com" type="email" name="email" id="email"
                            required>
                    </div>
                    <div class="input-login">
                        <input class="loginInput" placeholder="Nombre y Apellido" type="text" name="nombre_apellido"
                            required>
                    </div>
                    <div class="input-login">
                        <input class="loginInput" placeholder="password" type="password" name="password" id="password"
                            required>
                    </div>
                    <div class="btn-form-login mtt-5">
                        <input type="submit" class=" btn btn-sm btn-primary" value="Create">
                        <div class="ml-5">
                            <a class="btn btn-secondary btn-sm btn-create-user" href="login">Cancel</a>
                        </div>

                    </div>
                </form>

            </div>

            <h4 class="alert-danger">{$error}</h4>

        </div>

    </div>
</body>

</html>