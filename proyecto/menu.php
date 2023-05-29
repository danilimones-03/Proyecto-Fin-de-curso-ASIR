<html>


<head>
    <link rel="stylesheet" type="text/css" href="csscomun.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div align="right">
        <button type="submit"><a class="destruirsesion" href=destruirsesion.php>Cerrar sesión</a></button>
    </div>

    <style>
        h1 {
            text-align: center;
            margin-top: 50px;
        }

        .formulario {
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);
        }

        input[type="submit"] {
            background-color: #3e8e41;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }


        a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #4CAF50;
        }


        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            margin-top: 50px;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            background-color: whitesmoke;
        }

        th {
            background-color: green;
            color: white;
        }

        div.busqueda {
            width: 50%;
            margin: 0 auto;
        }

        td.tdderecha {
            text-align: right;
        }

        td.tdizquierda {
            text-align: left;
        }

        @media screen and (max-width: 1600px) {
            table {
                width: 100%;
                padding: 10px;

            }

            div.busqueda {
                width: 100%;
            }

            div.consulta {
                width: 100%;
                padding: 10px;

            }
        }

        /*Propiedades que afectan al logo de la página*/
        .logo {
            width: 100px;
            height: 100px;
            position: fixed;
            bottom: 10px;
        }

        /*Propiedad que afecta al enlace de Nuevo parte*/
        .nuevo {
            background-color: #3e8e41;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            width: 30%;
            margin-left: 50%;
            margin-top: -11px;
        }
    </style>
</head>

<body>

    <h1 align="center">Bienvenido al sistema de digitalización de partes</h1>
    <div class="busqueda">
        <table>
            <tr>
                <form method="POST" class="formulario">
                    <td colspan="2">Introduce el nombre del alumno y sus apellidos para consultar los partes que
                        tiene:<br><br></td>
            </tr>
            <tr>
                <td class="tdderecha">Nombre:</td>
                <td class="tdizquierda"><input type="text" name="nombrealumno"><br></td>
            </tr>
            <tr>
                <td class="tdderecha">Primer Apellido:</td>
                <td class="tdizquierda"> <input type="text" name="apellido1alumno"><br></td>
            </tr>
            <tr>
                <td class="tdderecha">Segundo Apellido:</td>
                <td class="tdizquierda"><input type="text" name="apellido2alumno"><br><br></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="filtrar" value="Filtrar"></td>
            </tr>
            </form>
            <tr>
                <td><a href="incluirpartes.php" class="nuevo">Nuevo Parte</a></td>
                <td>
                    <form method="POST" align="center">
                        <input style="background-color:red" type="submit" name="Borrar" value="Eliminar seleccionados">

                </td>
            </tr>

        </table>
    </div>





    <?php
    session_start();
    if (!isset($_SESSION["email"]) || empty($_SESSION["email"]) || !isset($_SESSION["contrasenia"]) || empty($_SESSION["contrasenia"])) {
        header("Location: login.php");
        exit;
    }

    error_reporting(0);
    

    if (isset($_POST["Borrar"])) {

        $entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $idsParaBorrar = $entradas["Seleccionar"];


        $idConexion = mysqli_connect("localhost", "root", "");
        if (!$idConexion) {
            die("Error al conectar con la base de datos");
        }

        $seleccionada = mysqli_select_db($idConexion, "login");
        if (!$seleccionada) {
            die("Error " . mysqli_error($idConexion));
        }
        //Ejecutamos doble consulta para borrarlo primero de motivospartes y luego de partes
        $result = mysqli_query($idConexion, "DELETE FROM motivospartes WHERE id_parte IN (" . implode(', ', $idsParaBorrar) . ")");
        if (!$result) {
            die("Error " . mysqli_error($idConexion));
        }

        $result = mysqli_query($idConexion, "DELETE FROM partes WHERE id IN (" . implode(', ', $idsParaBorrar) . ")");
        if (!$result) {
            die("Error " . mysqli_error($idConexion));
        }

        mysqli_close($idConexion);



    }
    //Comportamiento de la página en caso de que se pulse el botón filtrar
    if (isset($_POST['filtrar'])) {



        $entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);



        $ID = $entradas['id'];

        $nombre = $entradas["nombrealumno"];

        $apellido1 = $entradas["apellido1alumno"];

        $apellido2 = $entradas["apellido2alumno"];

        require("funciones.php");
        $idConexion = conectarbasedatos();



        if ($_SESSION["rol"] == "Usuario") {
            $email = $_SESSION["email"];
            $consulta = "SELECT * FROM partes WHERE email_profesor='$email' AND nombrealumno LIKE '%$nombre%' AND apellido1alumno LIKE '%$apellido1%' AND apellido2alumno LIKE '%$apellido2%'";



        } elseif ($_SESSION["rol"] == "Administrador") {
            $consulta = "SELECT * FROM partes WHERE nombrealumno LIKE '%$nombre%' AND apellido1alumno LIKE '%$apellido1%' AND apellido2alumno LIKE '%$apellido2%'";

            echo " <a href='registroencriptado.php'>Pulsa aquí para acceder al registro de usuarios</a> <br><br>";
        }
        $resultado = mysqli_query($idConexion, $consulta);
        if (!$resultado) {
            die("Ha ocurrido un error: " . mysqli_error($idConexion));
        }

        $numFilas = mysqli_num_rows($resultado);
        if ($numFilas == 0) {

        } else {
            $array = mysqli_fetch_array($resultado);

            echo "<div class='consulta'><table border=1 align=center width=100%>";
            echo "<tr>"
                . "<th>Nombre alumno</th>"
                . "<th>Grupo</th>"
                . "<th>Fecha</th>"
                . "<th>Motivos</th>"
                . "<th>Permanece en el aula</th>"
                . "<th>Explicación</th>"
                . "<th>Fecha llamada</th>"
                . "<th>Resultado llamada</th>"
                . "<th>Fecha envio iPasen</th>"
                . "<th>Borrar</th>"
                . "</tr>";


            while ($array != false) {
                $nombrealumno = $array['nombrealumno'] . " " . $array['apellido1alumno'] . " " . $array['apellido2alumno'];
                $grupo = $array['grupo'];
                $fecha = $array['fecha'];
                $tramo_horario = $array["tramo_horario"];
                $idParte = $array['id'];
                $motivos = getMotivosFromParte($idParte);
                $permanece_aula = $array['permanencia_aula'];
                $explicacion = $array["explicacion"];
                $fecha_llamada = $array["fecha_llamada"];
                $hora_llamada = $array["hora_llamada"];
                $resultado_llamada = $array["resultado_llamada"];
                $fecha_envio_ipasen = $array["fecha_envio_ipasen"];

                echo "<br>";
                echo "<tr>";
                echo "<td>$nombrealumno</td>";
                echo "<td>$grupo</td>";
                echo "<td>$fecha<br>$tramo_horario</td>";
                echo "<td>$motivos</td>";
                echo "<td>$permanece_aula</td>";
                echo "<td>$explicacion</td>";
                echo "<td>$fecha_llamada<br>$hora_llamada</td>";
                echo "<td>$resultado_llamada</td>";
                echo "<td>$fecha_envio_ipasen</td>";
                echo "<td><input type='checkbox' name='Seleccionar[]' value='$idParte'></td>";
                echo "</tr>";
                $array = mysqli_fetch_array($resultado);
            }
            echo "</table></div>";
            echo "</form>";
        }

        mysqli_free_result($resultado);
        mysqli_close($idConexion);
    }

    //Comportamiento de la página en caso de que no se pulse el botón filtrar
    if (!isset($_POST['filtrar'])) {

        $entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


        $ID = $entradas['id'];

        $nombre = $entradas["nombrealumno"];

        $apellido1 = $entradas["apellido1alumno"];

        $apellido2 = $entradas["apellido2alumno"];


        require("funciones.php");
        $idConexion = conectarbasedatos();



        if ($_SESSION["rol"] == "Usuario") {
            $email = $_SESSION["email"];
            $consulta = "SELECT * FROM partes WHERE email_profesor='$email' ";

        } elseif ($_SESSION["rol"] == "Administrador") {
            $consulta = "SELECT * FROM partes ";
            echo " <a href='registroencriptado.php'>Pulsa aquí para acceder al registro de usuarios</a> <br><br>";
        }

        $resultado = mysqli_query($idConexion, $consulta);
        if (!$resultado) {
            die("Ha ocurrido un error: " . mysqli_error($idConexion));
        }

        $numFilas = mysqli_num_rows($resultado);
        if ($numFilas == 0) {

        } else {
            $array = mysqli_fetch_array($resultado);
            echo "<div class='consulta'><table border=1 align=center width=100%>";
            echo "<tr>"
                . "<th>Nombre alumno</th>"
                . "<th>Grupo</th>"
                . "<th>Fecha</th>"
                . "<th>Motivos</th>"
                . "<th>Permanece en el aula</th>"
                . "<th>Explicación</th>"
                . "<th>Fecha llamada</th>"
                . "<th>Resultado llamada</th>"
                . "<th>Fecha envio iPasen</th>"
                . "<th>Borrar</th>"
                . "</tr>";


            while ($array != false) {
                $nombrealumno = $array['nombrealumno'] . " " . $array['apellido1alumno'] . " " . $array['apellido2alumno'];
                $grupo = $array['grupo'];
                $fecha = $array['fecha'];
                $tramo_horario = $array["tramo_horario"];
                $idParte = $array['id'];
                $motivos = getMotivosFromParte($idParte);
                $permanece_aula = $array['permanencia_aula'];
                $explicacion = $array["explicacion"];
                $fecha_llamada = $array["fecha_llamada"];
                $hora_llamada = $array["hora_llamada"];
                $resultado_llamada = $array["resultado_llamada"];
                $fecha_envio_ipasen = $array["fecha_envio_ipasen"];

                echo "<br>";
                echo "<tr>";
                echo "<td>$nombrealumno</td>";
                echo "<td>$grupo</td>";
                echo "<td>$fecha<br>$tramo_horario</td>";
                echo "<td>$motivos</td>";
                echo "<td>$permanece_aula</td>";
                echo "<td>$explicacion</td>";
                echo "<td>$fecha_llamada<br>$hora_llamada</td>";
                echo "<td>$resultado_llamada</td>";
                echo "<td>$fecha_envio_ipasen</td>";
                echo "<td><input type='checkbox' name='Seleccionar[]' value='$idParte'></td>";
                echo "</tr>";
                $array = mysqli_fetch_array($resultado);
            }
            echo "</table></div>";
            echo "</form>";
        }

        mysqli_free_result($resultado);
        mysqli_close($idConexion);


    }



    ?>
    <img src="img/logo-velez-alta-definicion-transparencia.png" class="logo" align="right">

</body>






</html>