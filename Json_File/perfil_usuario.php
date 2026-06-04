<?php
session_start();
if(isset($_SESSION["correo"]) && isset($_SESSION["pass"])){
  $mensaje = "Bienvenido";
  //almacenamos las sesiones en variables para posteriormente imprimir
  $usuario = $_SESSION["nombre"];
  $correo = $_SESSION["correo"];
  $contrasenia = $_SESSION["pass"];
  $fechaNacimiento = $_SESSION["fechaNacimiento"];
  $paises = $_SESSION["paises"];
  //Condición en caso que el usuario no pone su fecha de nacimiento
  $historial = $_SESSION["historial"];
  if($fechaNacimiento === ""){ 
    $fechaNacimiento = "Dato no ingresado";
  }else{
    $fechaNacimiento;
  }
}else{
  header('Location: login.php'); // Redirige a la página de inicio
  exit();
}
if(!isset($_COOKIE["fechaHora"])){
  $momentoInicioSesion = "no se registró la fecha y hora";
}else{
  $momentoInicioSesion = $_COOKIE["fechaHora"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <style>
      body {
        background-color : #d0e2b4ff;
        font-family: sans-serif;
        text-align: center;
      }
      .formulario-contenedor {
        background-color : #454137ff;
        color: #fff;
        padding: 20px;
        border-radius: 8px;
        max-width: 400px;
        margin: 40px auto;
        text-align: left;
      }
      .formulario-contenedor input {
        width: 95%;
        padding: 8px;
        margin-bottom: 10px;
      }
      .formulario-contenedor button {
        padding: 10px 20px;
        background-color: #d8b7b7ff;
        border: none;
        cursor: pointer;
      }
      .mensaje {
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        font-weight: bold;
      }
      .error {
        background-color: #ffcccc;
        color: #990000;
      }
      .exito {
        background-color: #ccffcc;
        color: #006600;
      }

      a{
        color: #f7f7f7ff;
      }
    </style>
</head>
<body>
  <header>
      <h1><?=$mensaje?></h1>
  </header>
  <section class="formulario-contenedor">
    <p>1. Tu nombre es: <?=$usuario?></p>
    <p>2. Tu correo es: <?=$correo?></p>
    <p>3. Tu contraseña es: <?=$contrasenia?></p>
    <p>4. Tu fecha de nacimiento es: <?=$fechaNacimiento?></p>
    <p>5. Fecha y hora de inicio de sesión <?=$momentoInicioSesion?></p>
    <?php 
    if(!empty($paises)){
        //Se imprime el listado de países con la condición del bucle foreach de que haya un dato en el array paises. 
        echo "<p>6. Tu lista de paises deseados es: </p>";
        echo "<ul>";
            foreach($paises as $pais){
                //Se imprime con seguridad el pais seleccionado.
                echo "<li>".htmlspecialchars($pais)."</li>";
            }
        echo "</ul>";
    }else{
        echo "No seleccionaste ningún país";
    }
    ?>
    <form action="logout.php">
      <button id="boton1" type="submit">Cerrar sesión</button>
    </form>
    <br><br>
    <a href="historial.php">Historial de ingresos</a>
  </section> 
</body>
</html>