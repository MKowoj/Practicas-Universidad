<?php
// Se define el arreglo asociativo con los usuarios permitidos.
$usuarios = [
  "paco@gmail.com" => "123",
  "dsw@outlook.com" => "qwerty",
  "francisco@alumnos.mx" => "Pancho1910",
  "usuario.invitado@gmail.com" => "poiuqwerty",
  "juan@alumnos.mx" => "101010"
];

// Variable para guardar los mensajes de error o éxito.
$mensaje = "";

// 1. Validar que la petición sea por el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // 2. Limpiar y obtener los datos del formulario.
  // strtolower() para que el correo no sea sensible a mayúsculas.
  // trim() para quitar espacios en blanco al inicio y al final.
  $correo = strtolower(trim($_POST["correo"] ?? ""));
  $contrasenia = trim($_POST["pass"] ?? "");

  // 3. Validar que los campos no estén vacíos.
  if ($correo === "" || $contrasenia === "") {
    $mensaje = "Error: Llena los campos obligatorios.";
  } else {
    // 4. Inicia la lógica de validación del usuario.
    // Usamos isset() para verificar si el correo  existe en nuestro arreglo.
    if (isset($usuarios[$correo])) {
      // Si el correo existe, ahora comparamos la contraseña.
      if ($usuarios[$correo] === $contrasenia) {
        session_start();
        //Verificar la existencia del historial
        if (!isset($_SESSION['historial'])) {
        // Si no existe, la creamos
          $_SESSION['historial'] = array();
        }
        
        //crean los datos del nuevo acceso
        $entradaActual = array(
        "nombre" => $_POST["nombre"],
        "fechaDeNacimiento" => $_POST["fechaNacimiento"],
        "correo" => $correo,
        "fecha" => date("d-m-Y H:i:s"),
        "paises" => $_POST["paises"]
        );

        array_push($_SESSION['historial'], $entradaActual);

        //guardamos los datos del usuario
        $_SESSION["nombre"] = $_POST["nombre"];
        $_SESSION["correo"] = $correo;
        $_SESSION["pass"] = $contrasenia;
        $_SESSION["paises"] = $_POST["paises"];
        $_SESSION["fechaNacimiento"] = $_POST["fechaNacimiento"];
        //redirigir al usuario con la fecha y hora de inicio de sesión
        setcookie("fechaHora",date("d-m-Y H:i:s"),time()+86400,"/");
        header("Location: perfil_usuario.php");
        exit();
      } else {
        $mensaje = "Error: La contraseña es incorrecta.";
      }
    } else {
      $mensaje = "Error: El usuario no está registrado.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <style>

      body {
        background-color : #d8b7b7ff;
        font-family: sans-serif;
        text-align: center;
      }
      .formulario-contenedor {
        background-color : #454137ff;
        font-family: sans-serif;
        color: #fff;
        padding: 20px;
        border-radius: 8px;
        max-width: 400px;
        margin: 40px auto;
        text-align: left;
      }
      .formulario-contenedor input[type="text"],
      .formulario-contenedor input[type="email"],
      .formulario-contenedor input[type="password"],
      .formulario-contenedor input[type="date"] {
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
      .mensaje-error {
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        font-weight: bold;
        background-color: #ffcccc;
        color: #990000;
      }
    </style>
</head>
<body>
  <h1>Iniciar sesión</h1>
  <p>Ingresa los datos solicitados</p>
  <section class="formulario-contenedor">
    <form action="login.php" method="POST">
      <label for="nombre">Nombre</label><br>
      <input type="text" id="nombre" name="nombre" required/><br>
      <label for="correo">Correo</label><br>
      <input type="email" id="correo" name="correo" required/><br>
      <label for="pass">Contraseña</label><br>
      <input type="password" id="pass" name="pass" required/><br>
      <label for="fechaNacimiento">Fecha de nacimiento</label><br>
      <input type="date" id="fechaNacimiento" name="fechaNacimiento" required/><br>
      <label>Selecciona los países que te gustaría visitar:</label><br>
      <label><input type="checkbox" name="paises[]" value="Japon"> Japón</label><br> 
      <label><input type="checkbox" name="paises[]" value="Rusia"> Rusia</label><br>
      <label><input type="checkbox" name="paises[]" value="CostaRica"> Costa Rica</label><br>
      <label><input type="checkbox" name="paises[]" value="Nigeria"> Nigeria</label><br>
      <label><input type="checkbox" name="paises[]" value="India"> India</label><br>
      <label><input type="checkbox" name="paises[]" value="Francia"> Francia</label><br>
      <label><input type="checkbox" name="paises[]" value="Chile"> Chile</label><br>
      <label><input type="checkbox" name="paises[]" value="Colombia"> Colombia</label><br>
      <label><input type="checkbox" name="paises[]" value="Corea"> Corea</label><br>
      <br><br>
      <button id="boton1" type="submit">Entrar</button>
    </form>
  </section>
  <?php
  // Mostramos el mensaje solo si no está vacío
  if (!empty($mensaje)) {
    echo "<div class='mensaje-error'>$mensaje</div>";
  }
  ?>
</body>
</html>