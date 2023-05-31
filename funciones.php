<?php
// Usamos una función dentro de un  archivo PHP común para la conexión de la base de datos, para de esta forma evitarnos tener que repetir lo mismo en todos los archivos.
function conectarbasedatos()
{ //Introducimos en el orden servidor, nombre del usuario, la contraseña y el nombre de la base de datos.
    $nombreservidor = "localhost";
    $nombreusuario = "root";
    $contraseniadelusuario = "";
    $basededatos = "login";
    $idConexion = mysqli_connect("$nombreservidor", "$nombreusuario", "$contraseniadelusuario");
    if (!$idConexion) {
        die('Error: ' . mysqli_error($idConexion));
    }
    $seleccionada = mysqli_select_db($idConexion, "$basededatos");
    if (!$seleccionada) {
        die('Error: ' . mysqli_error($idConexion));
    }
    return $idConexion;

}

function getMotivosFromParte($idParte)
{
    $idConexion = conectarbasedatos();

    $resultado = mysqli_query($idConexion, "SELECT Motivo from motivo WHERE id_motivo IN (SELECT id_motivo FROM motivospartes WHERE  id_parte=$idParte)");

    $fila = mysqli_fetch_array($resultado);

    $motivos = array();
    while ($fila != false) {
        $motivo = $fila["Motivo"];
        $motivos[] = $motivo;

        $fila = mysqli_fetch_array($resultado);

    }
    implode("<br><br>", $motivos);
    $devolver = implode("<br><br>", $motivos);
    return $devolver;
}



function getNombreProfesor($email)
{
    $idConexion = conectarbasedatos();

    $resultado = mysqli_query($idConexion, "SELECT nombre, apellido1, apellido2 FROM usuarios WHERE email='$email';");
    if (mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);
        $nombreCompleto = $row['nombre'] . ' ' . $row['apellido1'] . ' ' . $row['apellido2'];

        mysqli_free_result($resultado);
        mysqli_close($idConexion);

        return $nombreCompleto;
    }

}



?>