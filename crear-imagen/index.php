<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generador de imagen con nombre</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        form { margin-bottom: 20px; }
        img { border: 2px solid #333; }
    </style>
</head>
<body>

    <h2>Escribe tu nombre para la imagen:</h2>
    
    <form action="index.php" method="GET">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">
        <input type="submit" value="Generar Imagen">
    </form>
    
    <hr>

    <?php
    // Comprobamos si la variable nombre ha sido enviada
    if (isset($_GET['nombre'])) {
        
        // Guardamos el nombre en una variable
        $nombre_usuario = $_GET['nombre'];
        
        // Le pasamos el nombre del usuario directamente en la URL.
        echo "<h3>Aquí está tu imagen generada</h3>";
        echo '<img src="crear_imagen.php?nombre=' . urlencode($nombre_usuario) . '" alt="Imagen generada">';
    }
    ?>

</body>
</html>