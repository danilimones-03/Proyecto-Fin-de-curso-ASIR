<html>

<head>
    <link rel="stylesheet" type="text/css" href="csscomun.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <h1>Registro de partes</h1>
    <h5>Los campos marcados con * son obligatorios</h5>
    <?php
    // Sesión para que no puedan acceder usuarios sin autorización.
    session_start();
    if (!isset($_SESSION["email"]) || empty($_SESSION["email"]) || !isset($_SESSION["contrasenia"]) || empty($_SESSION["contrasenia"])) {
        header("Location: login.php");
        exit;
    }
    ?>
    <style>
        /*Afecta a h1 */
        h1 {
            text-align: center;
        }

        /*Afecta a h4 */
        h4 {
            margin: 0 auto;

        }

        /*Afecta a h5 */
        h5 {
            text-align: center;
        }
        /*Afecta a la tabla */

        table {
            max-width: 700px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: right;

        }
        /*Afecta a los h4 que se encuentran dentro de table */

        table.h4 {
            font-weight: bold;

        }
        /*Afecta a los input de tipo submit */

        input[type="submit"] {
            background-color: #52bd56;
            color: white;
            border: none;
            padding: 5px 20px;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
            margin: 0 auto;
        }
        /*Afecta a los enlaces */

        a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #4CAF50;
        }
        /*Afecta a los td */
        
        td {
            vertical-align: top;
            display: flex;
        }

        @media screen and (max-width: 600px) {
            table {
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
                <!--Crea un desplegable -->
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
                <td>Opciones:<br></td>
                <td>
                    <!--Los motivos los coge de la base de datos, por lo que se conecta a ella y hace una consulta SQL para buscarlos, una vez lo tengamos los devuelve en un array -->
                    <div align="left">
                        <?php

                        // Usamos una función dentro de un  archivo PHP común para la conexión de la base de datos, para de esta forma evitarnos tener que repetir lo mismo en todos los archivos.
                        
                        require("funciones.php");
                        $idConexion = conectarbasedatos();

                        $consulta = "SELECT id_motivo, Motivo FROM motivo";
                        $result = mysqli_query($idConexion, $consulta);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<input type="checkbox" name="motivo_parte[]" value="' . $row['id_motivo'] . '"> ' . $row['Motivo'] . '<br>';
                        }

                        mysqli_free_result($result);
                        mysqli_close($idConexion);
                        ?>
                    </div>
                </td>
            </tr>





            <tr>

                <td> <br>Explicar el desarrollo de los hechos:*</td>
                <td align="left"><textarea name="explicacion" rows="10" cols="30" required></textarea></td>
            </tr>
            <tr>
                <td colspan="2"><br><br>
                    <h4><br><br><u>Comunicación con la familia</u></h4>
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
            <tr>
                <td>Fecha de envío de iPasen (solo en caso de haber marcado la opción: No contesta):</td>
                <td align="left"> <input type="date" name="fecha_envio_ipasen"></td>
            </tr>
            <br>
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <br><br>
                <td colspan="2"><input type="submit" name="registro" value="Registrar"></td>
            </tr>
        </form>
    </table>
    <a href="menu.php">Pulsa aquí para ir al menu principal</a>

    <?php
    // Esto es lo que pasaría en caso de que se pulsara el boton de registro
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
        // Usamos una función dentro de un  archivo PHP común para la conexión de la base de datos, para de esta forma evitarnos tener que repetir lo mismo en todos los archivos.
    
        $idConexion = conectarbasedatos();


        $result = mysqli_query($idConexion, "INSERT INTO partes VALUES('','$email','$nombrealumno','$apellido1alumno','$apellido2alumno', '$grupo', '$fecha','$tramo_horario','$explicacion','$permanece_aula',' $fecha_llamada',' $hora_llamada',' $resultado_llamada','$fecha_envio_ipasen')");
        if (!$result) {
            die("Error " . mysqli_error($idConexion));
        }
        // El siguiente codigo lo que se encarga es de agregar los ids en la tabla motivo parte
        $idInsertado = mysqli_insert_id($idConexion);
        /*Creo la sentencia de inserccion.*/
        $filaInsert = array();
        for ($i = 0; $i < sizeof($opciones); $i++) {
            $filaInsert[] = "(" . $idInsertado . ", " . $opciones[$i] . ")";
        }
        $insertStr = implode(", ", $filaInsert);
        $result = mysqli_query($idConexion, "INSERT INTO motivospartes VALUES $insertStr");

        if (!$result) {
            die("Error " . mysqli_error($idConexion));
        }

    }
    ?>
</body>
<footer>
    <img src="img/logo-velez-alta-definicion-transparencia.png" width="100px" height="100px" align="right">

</footer>

</html>