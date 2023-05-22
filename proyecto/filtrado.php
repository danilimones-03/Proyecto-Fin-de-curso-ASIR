<html>


<head>
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
        @media screen and (max-width: 1600px){
            table{
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
        .logo{
            width: 100px;
             height: 100px;
             position: absolute;
            bottom: 10px;
            right: 10px;
        }

        footer {
            position: relative;
        }

    </style>
</head>

<body>

    <h1 align="center">Búsqueda de partes</h1>
    <div class="busqueda">
        <table>
            <tr>
                <form method="POST">
                    <td colspan="2">Introduce el nombre del alumno y sus apellidos para consultar los partes que
                        tiene:<br><br></td>
            </tr>
            <tr>
                <td class="tdderecha">Nombre:</td>
                <td class="tdizquierda"><input type="text" name="nombrealumno" required><br></td>
            </tr>
            <tr>
                <td class="tdderecha">Primer Apellido:</td>
                <td class="tdizquierda"> <input type="text" name="apellido1alumno" required><br></td>
            </tr>
            <tr>
                <td class="tdderecha">Segundo Apellido:</td>
                <td class="tdizquierda"><input type="text" name="apellido2alumno" required><br><br></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="filtrar" value="Filtrar"></td>
            </tr>
            </form>
        </table>
    </div>
    <a href='menu.php'>Pulsa aquí para volver al menu principal</a>
    <br><br>
    <?php
    session_start();
    if (!isset($_SESSION["email"]) || empty($_SESSION["email"]) || !isset($_SESSION["contrasenia"]) || empty($_SESSION["contrasenia"])) {
        header("Location: loginbueno.php");
        exit;
    }

    error_reporting(0);

    if (isset($_POST['filtrar'])) {



        $entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $nombre = $entradas["nombrealumno"];

        $apellido1 = $entradas["apellido1alumno"];

        $apellido2 = $entradas["apellido2alumno"];

        $idConexion = mysqli_connect("localhost", "root", "");
        if (!$idConexion) {
            die("Error al conectar con base de datos");
        }

        $seleccionada = mysqli_select_db($idConexion, "login");

        if (!$seleccionada) {
            die("Error " . mysqli_error($idConexion));
        }

        if ($_SESSION["rol"] == "Usuario") {
            $email = $_SESSION["email"];
            $consulta = "SELECT * FROM partes WHERE email_profesor='$email' AND nombrealumno LIKE '%$nombre%' AND apellido1alumno LIKE '%$apellido1%' AND apellido2alumno LIKE '%$apellido2%'";
        } else {
            $consulta = "SELECT * FROM partes WHERE nombrealumno LIKE '%$nombre%' AND apellido1alumno LIKE '%$apellido1%' AND apellido2alumno LIKE '%$apellido2%'";
        }
        
        $resultado = mysqli_query($idConexion, $consulta);
        if (!$resultado) {
            die("Ha ocurrido un error: " . mysqli_error($idConexion));
        }

        $numFilas = mysqli_num_rows($resultado);
        if ($numFilas == 0) {
            echo "<br>No hay ningún parte asociado al alumno $nombre $apellido1 $apellido2.";
        } else {
            $array = mysqli_fetch_array($resultado);

            echo "<div class='consulta'><table border=1 align=center width=100%>";
            echo "<tr>"
                . "<th>ID</th>"
                . "<th>Nombre alumno </th>"
                . "<th>Primer Apellido del Alumno </th>"
                . "<th>Segundo Apellido del Alumno </th>"
                . "<th>Correo del profesor que ha puesto el parte</th>"
                . "<th>Grupo</th>"
                . "<th>Fecha</th>"
                . "<th>Accion realizada</th>"
                . "<th>Tramo horario</th>"
                . "<th>Permanece en el aula</th>"
                . "<th>Explicación</th>"
                . "<th>Fecha de la llamada a los tutores</th>"
                . "<th>Hora de la llamada</th>"
                . "<th>Resultado de la llamada</th>"
                . "<th>Fecha de envio a iPasen. (En caso de que sea necesario)</th>"
                . "</tr>";


            while ($array != false) {
                $ID = $array['id'];
                $nombrealumno = $array['nombrealumno'];
                $apellido1alumno = $array['apellido1alumno'];
                $apellido2alumno = $array['apellido2alumno'];
                $email_profesor = $array['email_profesor'];
                $grupo = $array['grupo'];
                $fecha = $array['fecha'];
                $opciones = $array['motivo_parte'];
                $tramo_horario = $array["tramo_horario"];
                $permanece_aula = $array['permanencia_aula'];
                $explicacion = $array["explicacion"];
                $fecha_llamada = $array["fecha_llamada"];
                $hora_llamada = $array["hora_llamada"];
                $resultado_llamada = $array["resultado_llamada"];
                $fecha_envio_ipasen = $array["fecha_envio_ipasen"];

                echo "<br>";
                echo "<tr>";
                echo "<td>$ID</td>";
                echo "<td>$nombrealumno</td>";
                echo "<td>$apellido1alumno</td>";
                echo "<td>$apellido2alumno</td>";
                echo "<td>$email_profesor</td>";
                echo "<td>$grupo</td>";
                echo "<td>$fecha</td>";
                echo "<td>$opciones</td>";
                echo "<td>$tramo_horario</td>";
                echo "<td>$permanece_aula</td>";
                echo "<td>$explicacion</td>";
                echo "<td>$fecha_llamada</td>";
                echo "<td>$hora_llamada</td>";
                echo "<td>$resultado_llamada</td>";
                echo "<td>$fecha_envio_ipasen</td>";
                echo "</tr>";
                $array = mysqli_fetch_array($resultado);
            }
            echo "</table></div>";
        }

        mysqli_free_result($resultado);
        mysqli_close($idConexion);
    }
    ?>
</body>
<footer>
    <br><br><br><br><br><br><br><br><br><br><br>
    <img src="img/logo-velez-alta-definicion-transparencia.png" class="logo" align="right">

</footer>

</html>