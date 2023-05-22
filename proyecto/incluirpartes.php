<html>

<head>
    <link rel="stylesheet" type="text/css" href="csscomun.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <h1>Registro de partes</h1>
    <h5>Los campos marcados con * son obligatorios</h5>
    <?php
    session_start();
    if (!isset($_SESSION["email"]) || empty($_SESSION["email"]) || !isset($_SESSION["contrasenia"]) || empty($_SESSION["contrasenia"])) {
        header("Location: loginbueno.php");
        exit;
    }
    ?>
    <style>
        h1 {
            text-align: center;
        }

        h5 {
            text-align: center;
        }

        table {
            max-width: 700px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);
            text-align: right;

        }

        table.h4 {
            font-weight: bold;

        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 20px;
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

        td {
            vertical-align: top;
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

    <table>
        <form method="POST">
            <tr>
                <td>Email del profesor:</td>
                <td align="left"> <input type="text" name="email"
                        value="<?php echo isset($_SESSION["email"]) ? $_SESSION["email"] : ''; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>Nombre del Alumno:*</td>
                <td align="left"> <input type="text" name="nombrealumno" required></td>
            </tr>

            <tr>
                <td>Primer Apellido del Alumno:*</td>
                <td align="left"> <input type="text" name="apellido1alumno" required></td>
            </tr>

            <tr>
                <td>Segundo Apellido del Alumno:*</td>
                <td align="left"> <input type="text" name="apellido2alumno" required></td>
            </tr>
            <tr>
                <td>Grupo del alumno:*</td>
                <td align="left"> <input type="text" name="grupo" required></td>
            </tr>
            <tr>
                <td>Fecha del hecho realizado:*</td>
                <td align="left"><input type="date" name="fecha" required></td>
            </tr>
            <tr>
                <td>Tramo horario:*</td>
                <td align="left">
                    <select name="tramo_horario" required>
                        <option value="1ª Hora">1ª Hora</option>
                        <option value="2ª Hora">2ª Hora</option>
                        <option value="3ª Hora">3ª Hora</option>
                        <option value="Recreo">Recreo</option>
                        <option value="4ª Hora">4ª Hora</option>
                        <option value="5ª Hora">5ª Hora</option>
                        <option value="6ª Hora">6ª Hora</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Permanece en el aula:*</td>
                <td align="left">
                    <select name="permanece_aula" required>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Opciones:<br><br></td>
                <td>
                    <div align="left">
                        <?php

                        $conexion = mysqli_connect('localhost', 'root', '', 'login');

                        $consulta = "SELECT id_motivo, Motivo FROM motivo";
                        $result = mysqli_query($conexion, $consulta);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<input type="checkbox" name="motivo_parte[]" value="' . $row['Motivo'] . '"> ' . $row['Motivo'] . '<br>';
                        }

                        mysqli_free_result($result);
                        mysqli_close($conexion);
                        ?>
                    </div>
                </td>
            </tr>





            <tr>
                <td>Explicar el desarrollo de los hechos:*</td>
                <td align="left"><textarea name="explicacion" rows="10" cols="30" required></textarea></td>
            </tr>
            <tr>
                <td colspan="2"><br>
                    <h4 align="center">Comunicación con la familia</h4>
                </td>
                <td>
            <tr>
                <td>Fecha de la llamada:*</td>
                <td align="left">
                    <input type="date" name="fecha_llamada" required>
                </td>
            </tr>
            <tr>
                <td>Hora de la llamada:*</td>
                <td align="left">
                    <input type="time" name="hora_llamada" required>
                </td>
            </tr>
            <tr>
                <td>Resultado de la llamada:*</td>
                <td align="left">
                    <select name="resultado_llamada" required>
                        <option value="">Seleccione una opción</option>
                        <option value="Contesta">Contesta</option>
                        <option value="No contesta">No contesta</option>
                        <option value="Comunica">Comunica</option>
                        <option value="Teléfono incorrecto">Teléfono incorrecto</option>
                    </select>
                </td>
            </tr>
            <!--Poner este campo como nulo en la base de datos -->
            <tr>
                <td>Fecha de envío de iPasen (solo en caso de haber marcado la opción: No contesta):</td>
                <td align="left"> <input type="date" name="fecha_envio_ipasen"></td>
            </tr>

            <tr>
                <td colspan="2" align="center"><br><input type="submit" name="registro" value="Registrar"></td>
            </tr>
        </form>
    </table>
    <a href="menu.php">Pulsa aquí para ir al menu principal</a>

    <?php

    if (isset($_POST["registro"])) {
        $entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $email = $entradas["email"];
        $nombrealumno = $entradas["nombrealumno"];
        $apellido1alumno = $entradas["apellido1alumno"];
        $apellido2alumno = $entradas["apellido2alumno"];
        $grupo = $entradas["grupo"];
        $fecha = $entradas["fecha"];
        $tramo_horario = $entradas["tramo_horario"];
        $permanece_aula = $entradas["permanece_aula"];
        $explicacion = $entradas["explicacion"];
        $fecha_llamada = $entradas["fecha_llamada"];
        $hora_llamada = $entradas["hora_llamada"];
        $resultado_llamada = $entradas["resultado_llamada"];
        $fecha_envio_ipasen = $entradas["fecha_envio_ipasen"];
        $opciones = array();

        foreach ($entradas["motivo_parte"] as $selected) {
            $opciones[] = $selected;
        }

        $opciones_string = implode('. <br><br>', $opciones);


        $idConexion = mysqli_connect("localhost", "root", "");
        if (!$idConexion) {
            die("Error al conectar con base de datos");
        }

        $seleccionada = mysqli_select_db($idConexion, "login");

        if (!$seleccionada) {
            die("Error " . mysqli_error($idConexion));
        }

        $result = mysqli_query($idConexion, "INSERT INTO partes VALUES('','$email','$nombrealumno','$apellido1alumno','$apellido2alumno', '$grupo', '$fecha','$tramo_horario','$explicacion','$permanece_aula',' $fecha_llamada',' $hora_llamada',' $resultado_llamada','$fecha_envio_ipasen','$opciones_string')");

        if (!$result) {
            die("Error " . mysqli_error($idConexion));
        }

        $filasAfectadas = mysqli_affected_rows($idConexion);

        if ($filasAfectadas == 0) {
            echo "<br>No se ha podido añadir por un error.";
        } else {
            echo "<br>¡Parte añadido correctamente!";
        }

        mysqli_close($idConexion);


    }
    ?>
</body>
<footer>
    <img src="img/logo-velez-alta-definicion-transparencia.png" width="100px" height="100px" align="right">

</footer>

</html>