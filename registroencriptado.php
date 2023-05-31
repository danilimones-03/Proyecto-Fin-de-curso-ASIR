<html>

<head>

    <link rel="stylesheet" type="text/css" href="csscomun.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <h1>Registro de usuarios </h1>

    <style>
        /*El siguiente código afecta a h1*/
        h1 {
            text-align: center;
            margin-top: 50px;
        }

        /*El siguiente código afecta al formulario de la página*/

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
        }

        /*El siguiente código afecta a los inputs tipo submit */
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
        }

        /*El siguiente código afecta a los enlaces presentes en la página */

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
    session_start();
    if (!isset($_SESSION["email"]) || empty($_SESSION["email"]) || !isset($_SESSION["contrasenia"]) || empty($_SESSION["contrasenia"])) {
        header("Location: login.php");
        exit;
    }
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
            $hash_contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);
        }
        if ($contrasenia == $repetirContrasenia) {

            // Usamos una función dentro de un  archivo PHP común para la conexión de la base de datos, para de esta forma evitarnos tener que repetir lo mismo en todos los archivos.
    
            require("funciones.php");
            $idConexion = conectarbasedatos();

            $result = mysqli_query($idConexion, "INSERT INTO usuarios VALUES('$email', '$hash_contrasenia', '$nombre', '$apellido1', '$apellido2', '$rol')");








            if (!$result) {
                die("Error " . mysqli_error($idConexion));
            }

            $filasAfectadas = mysqli_affected_rows($idConexion);

            if ($filasAfectadas == 0) {
            } else {
            }

            mysqli_close($idConexion);
        } else {
            echo "<br>Las contraseñas no coinciden";
        }
    }

    ?>
    <a href='menu.php'>Pulsa aquí para volver al menú</a>
</body>
<div class="logo">
    <img src="img/logo-velez-alta-definicion-transparencia.png" width="100px" height="100px" align="right">
</div>

</html>