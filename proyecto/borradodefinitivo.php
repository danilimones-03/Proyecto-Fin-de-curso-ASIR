<html>

<head>
    </form>
    </div>
    <h1>Borrado</h1>
    <link rel="stylesheet" type="text/css" href="csscomun.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        h1 {
            text-align: center;
            margin-top: 50px;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);
            text-align: center;
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
        @media screen and (max-width: 600px){
            table{
                width: 100%;
                padding: 10px;
            }

        }
    </style>
</head>

<body>

    <h3 align="center">Por favor, introduzca el id del parte que desee borrar. En caso de que lo desconozca consultelo en
        el apartado del menu Consultar</h3>

    <form method="POST">
        Id del parte: <input type="text" name="id" required>
        <br><br>

        <input type="submit" name="borrar" value="Borrar">
    </form>
    <a href="menu.php">Pulsa aquí para ir al menu principal</a>
    <?php
    session_start();
    if (!isset($_SESSION["email"]) || empty($_SESSION["email"]) || !isset($_SESSION["contrasenia"]) || empty($_SESSION["contrasenia"])) {
        header("Location: loginbueno.php");
        exit;
    }
    if (isset($_POST["borrar"])) {
        $entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $ID = $entradas["id"];

        $idConexion = mysqli_connect("localhost", "root", "");
        if (!$idConexion) {
            die("Error al conectar con base de datos");
        }

        $seleccionada = mysqli_select_db($idConexion, "login");

        if (!$seleccionada) {
            die("Error " . mysqli_error($idConexion));
        }

        $result = mysqli_query($idConexion, "DELETE FROM partes WHERE id='$ID';");


        if (!$result) {
            die("Error " . mysqli_error($idConexion));
        }

        $filasAfectadas = mysqli_affected_rows($idConexion);

        if ($filasAfectadas == 0) {
            echo "<br>No se ha podido borrar por un error o ese ID no corresponde a ningun parte.";
        } else {
            echo "<br>¡Parte borrado!";
        }

        mysqli_close($idConexion);
    }
    ?>
</body>
<div class="logo">
  <img src="img/logo-velez-alta-definicion-transparencia.png" width="100px" height="100px" align="right">
</div>

</html>