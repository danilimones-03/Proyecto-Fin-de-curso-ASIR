<html>
<head>
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
            background-color: #52bd56;
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
    <h3 align="center">Por favor, introduzca el ID del parte o varios IDs separados por comas que desee borrar. En caso de que lo desconozca, consúltelo en el  menú </h3>

    <form method="POST">
        Id(s) del parte: <input type="text" name="id" required>
        <br><br>
        <input type="submit" name="borrar" value="Borrar">
    </form>

    <a href="menu.php">Pulsa aquí para ir al menú principal</a>

    <?php
    session_start();
    if (!isset($_SESSION["email"]) || empty($_SESSION["email"]) || !isset($_SESSION["contrasenia"]) || empty($_SESSION["contrasenia"])) {
        header("Location: login.php");
        exit;
    }
    if (isset($_POST["borrar"])) {
        $entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $ids = $entradas["id"];
        $idArray = explode(",", $ids); // Con explode lo que hacemos es convertir la cadena en un array


            // Usamos una función dentro de un  archivo PHP común para la conexión de la base de datos, para de esta forma evitarnos tener que repetir lo mismo en todos los archivos.

        require("config.php");
        $idConexion = conectarbasedatos();
// La variable 0 toma este valor antes de entrar al bucle
        $filasAfectadas = 0;

        // Con forach por cada elemento del array, osea los IDs le vaya ejecutando las consultas de borrado SQL
        foreach ($idArray as $id) {
            $id = trim($id); // Eliminar espacios en blanco alrededor del ID
            
            $result1 = mysqli_query($idConexion, "DELETE FROM motivospartes WHERE id_parte='$id';");
            $result2 = mysqli_query($idConexion, "DELETE FROM partes WHERE id='$id';");

            if (!$result1 || !$result2) {
                die("Error " . mysqli_error($idConexion));
            }

            $filasAfectadas += mysqli_affected_rows($idConexion);
        }
// Con esto comprobamos si alguna fila de la base de datos haya sido afectada, en caso de que una o más haya sido afectada significa que se ha llevado a cabo el borrado.
        if ($filasAfectadas == 0) {
            echo "<br>No se ha podido borrar ningún parte debido a un error o los ID no corresponden a ninguno de los partes.";
        } else {
            echo "<br>¡Parte(s) borrado(s)!";
        }

        mysqli_close($idConexion);
    }
    ?>
</body>
<div class="logo">
  <img src="img/logo-velez-alta-definicion-transparencia.png" width="100px" height="100px" align="right">
</div>

</html>
