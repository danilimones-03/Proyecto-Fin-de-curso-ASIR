<html>
  <section>
<?php
session_start();
if (!isset($_SESSION["email"]) || empty($_SESSION["email"]) || !isset($_SESSION["contrasenia"]) || empty($_SESSION["contrasenia"])) {
    header("Location: loginbueno.php");
    exit;
}
?>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="csscomun.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <div align="right">
    <button type="submit"><a class="destruirsesion" href=destruirsesion.php>Cerrar sesión</a></button>
  </div>
  

  <style>
    
    div.menu {
      align-items: center;
      background-color: #4CAF50;
      color: white;
      padding: 10px;
      border-radius: 3px;
      margin: 0 auto;
      max-width: 600px;
      text-align: center;

    }

    div.menu a {
      text-decoration: none;
      color: white;
      font-size: 25px;
      padding: 10px 20px;
      border-radius: 3px;
    }

    div.menu a:hover {
      background-color: rgb(24, 119, 11);
    }

    div.menu ul {
      list-style: none;
      padding: 0;
    }
    @media screen and (max-width:600px) {
        form {
            max-width: 100%;
        }

    }  
    
  </style>
</head>

<body>
  <h1 align="center">Menú principal</h1>
  <br><br><br><br><br>
  <h3 align="center">Bienvenido al Menú Principal, seleccione la operación que desee realizar.</h3><br>

  <div class="menu">
    <ul>
      <li><a href="incluirpartes.php">Incluir nuevos partes</a></li><br><br>
      <li><a href="filtrado.php">Consultar</a></li><br><br>
      <li><a href="borradodefinitivo.php">Eliminar</a></li>
    </ul>
  </div>
</body>
<div class="logo">
  <img src="img/logo-velez-alta-definicion-transparencia.png" width="100px" height="100px" align="right">

  </div>
</section>
</html>