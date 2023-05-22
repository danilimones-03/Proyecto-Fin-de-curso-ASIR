<html>

<head>

    <link rel="stylesheet" type="text/css" href="csscomun.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <h1>Registro de usuarios </h1>

    <style>
        h1 {
            text-align: center;
            margin-top: 50px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #4CAF50;
        }

        @media screen and (max-width:600px) {
            form {
                max-width: 100%;
            }

        }
    </style>
</head>

<body>
    <form method="POST">
        <div style="text-align:center;">

            Email: <input type="email" name="email" required>
            <br><br>

            Nombre: <input type="text" name="nombre" required>
            <br><br>
            Primer apellido: <input type="text" name="apellido1" required>
            <br><br>
            Segundo apellido: <input type="text" name="apellido2" required>
            <br><br>
            Contraseña: <input type="password" name="contrasenia" required>
            <br><br>
            Repetir contraseña: <input type="password" name="repetirContrasenia" required>
            <br><br>
            Selecciona un rol:<select name="rol" required>
                <option value="Usuario">Usuario</option>
                <option value="Administrador">Administrador</option>
            </select>
            <br><br>
            <input type="submit" name="registro" value="Registrarse">
        </div>
    </form>

    <?php
    if (isset($_POST["registro"])) {
        $entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $email = $entradas["email"];
        $contrasenia = $entradas["contrasenia"];
        $repetirContrasenia = $entradas["repetirContrasenia"];
        $nombre = $entradas["nombre"];
        $apellido1 = $entradas["apellido1"];
        $apellido2 = $entradas["apellido2"];
        $rol = $entradas["rol"];


        if ($contrasenia == $repetirContrasenia) {
            $contrasenia_hashed = password_hash($contrasenia, PASSWORD_DEFAULT);
        }
        if ($contrasenia == $repetirContrasenia) {
            $idConexion = mysqli_connect("localhost", "root", "");
            if (!$idConexion) {
                die("Error al conectar con base de datos");
            }

            $seleccionada = mysqli_select_db($idConexion, "login");

            if (!$seleccionada) {
                die("Error " . mysqli_error($idConexion));
            }

            $result = mysqli_query($idConexion, "INSERT INTO usuarios VALUES('$email', '$contrasenia_hashed', '$nombre', '$apellido1', '$apellido2', '$rol')");








            if (!$result) {
                die("Error " . mysqli_error($idConexion));
            }

            $filasAfectadas = mysqli_affected_rows($idConexion);

            if ($filasAfectadas == 0) {
                echo "<br>No se ha podido completar el registro por un error.";
            } else {
                echo "<br>¡Registrado correctamente!";
            }

            mysqli_close($idConexion);
        } else {
            echo "<br>Las contraseñas no coinciden";
        }
    }

    ?>

</body>
<div class="logo">
    <img src="img/logo-velez-alta-definicion-transparencia.png" width="100px" height="100px" align="right">
</div>

</html>