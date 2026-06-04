<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Acceso</title>
    </head>
    <style>
    /* --- Importamos desde Google Fonts --- */
    @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap');

    body {
      background-color: #f0f2f5; 
      font-family: 'Lato', sans-serif; 
      color: #333;
      margin: 0;
      padding: 20px;
    }

    h1, p {
      text-align: center;
    }

    /* Contenedor para la lista, para que no ocupe toda la pantalla */
    ul {
      max-width: 800px; /* Ancho máximo de la lista */
      margin: 20px auto; 
      padding: 0;
      list-style-type: none; /* Quitamos los puntos de la lista */
    }

    /* --- Estilos para cada "Tarjeta" de Historial --- */
    .tarjeta-historial {
      background-color: #ffffff; 
      border-radius: 8px; 
      padding: 20px; 
      margin-bottom: 20px; 
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
      line-height: 1.6; 
    }

    /* Estilo para las etiquetas en negrita */
    .tarjeta-historial strong {
      color: #555;
    }

    /* --- Estilos para los enlaces al final --- */
    .enlaces-finales {
      text-align: center;
      margin-top: 40px;
    }

    .enlaces-finales a {
      color: #0056b3;
      text-decoration: none;
      margin: 0 10px; 
    }

    .enlaces-finales a:hover {
      text-decoration: underline; 
    }
    </style>
<body>
    <h1>Historial de Acceso</h1>

    <?php
    // Validamos que el historial exista y no esté vacío.
    if (isset($_SESSION['historial']) && !empty($_SESSION['historial'])) {
        
        echo "<p>Lista de usuarios que han accedido recientemente:</p>";
        echo "<ul>";

        //invertimos el arreglo para mostrar por LIFO
        $historial_LIFO = array_reverse($_SESSION['historial']);
        // Recorremos el arreglo con un ciclo para mostrar cada entrada.
        foreach ($historial_LIFO as $entrada) {
            echo "<li class='tarjeta-historial'>";
            echo "<div><strong>Fecha de ingreso:</strong> " .$entrada["fecha"] . "</div>";
            echo "<div><strong>Nombre:</strong> " .htmlspecialchars($entrada["nombre"]) . "</div>";
            echo "<div><strong>Fecha de nacimiento:</strong> " .$entrada["fechaDeNacimiento"] . "</div>";
            echo "<div><strong>Correo:</strong> " .htmlspecialchars($entrada["correo"]) . "</div>";
            if(isset($entrada["paises"])){
                echo "<div><strong>Paises seleccionados:</strong> ".implode(" - ", $entrada["paises"]). "</div>";
            }else{
                echo "<div><strong>Ningún país fue seleccionado</strong> ";
            }
            echo "</li>";
        }
        echo "</ul>";
    } else {
        // Mensaje por si el historial está vacío.
        echo "<p>Aún no hay registros en el historial.</p>";
    }
    ?>
    <div class="enlaces-finales">
    <a href="login.php">Nuevo inicio (sin cerrar sesión)</a>
    <a href="perfil_usuario.php">Volver al perfil</a>
    <a href="logout.php">Cerrar Sesión</a>
</div>
</body>
</html>