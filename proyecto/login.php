<html>

<head>
    <h1>Login</h1>
    <link rel="stylesheet" type="text/css" href="csscomun.css" />
    <h3 align="center">Debe iniciar sesión para acceder </h3>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /*El siguiente código afecta a h1*/

        h1 {
            text-align: center;
            margin-top: 50px;
        }

        /*El siguiente código afecta a los formularios*/

        form {
            max-width: 300px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 3px 0px rgba(0, 0, 0, 0.2);

        }

        /*El siguiente código afecta a los inputs tipo submit */

        input[type="submit"] {
            background-color: #52bd56;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
        }

        /*El siguiente código afecta a los input, especificamente al tipo email y password*/

        input[type="email"],
        input[type="password"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 3px;
            box-shadow: 0px 0px 3px 0px rgba(0, 0, 0, 0.2);
            font-size: 16px;
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
        Email:<input type="email" name="email">
        <br>
        Contraseña:<input type="password" name="contrasenia">
        <br>
        <input type="submit" name="login" value="Login">
    </form>
    <br><br>
    <?php
    error_reporting(0);
    session_start();

    if (isset($_POST["login"])) {

        $entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $email = $entradas["email"];
        $_SESSION["email"] = $email;
        $contrasenia = $entradas["contrasenia"];

        // Usamos una función dentro de un  archivo PHP común para la conexión de la base de datos, para de esta forma evitarnos tener que repetir lo mismo en todos los archivos.
        require("funciones.php");
        $idConexion = conectarbasedatos();


        $result = mysqli_query($idConexion, "SELECT * FROM usuarios WHERE email='$email' ");

        if (!$result) {
            die("Error " . mysqli_error($idConexion));
        }

        $row = mysqli_fetch_array($result);
        $encriptada = $row["contrasenia"];

        $comprobarcontrasena = password_verify($contrasenia, $encriptada);

        if ($row == false || $comprobarcontrasena == false) {
            $error = "Correo electrónico o contraseña incorrectos. Por favor, inténtelo de nuevo.";
            echo $error;
        } elseif ($result && $comprobarcontrasena === TRUE) {
            $_SESSION["email"] = $email;
            $_SESSION["contrasenia"] = $contrasenia;
            $rol = $row["rol"];
            $_SESSION["rol"] = $rol;
            header("Location: menu.php");
            exit;
        }

        mysqli_free_result($result);
        mysqli_close($idConexion);
    }


    ?>

</body>
<div class="logo">
    <img src="img/logo-velez-alta-definicion-transparencia.png" width="100px" height="100px" align="right">
</div>

</html>