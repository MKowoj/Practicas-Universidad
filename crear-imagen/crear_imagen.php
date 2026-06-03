<?php
// Si no se envía ningún nombre, usamos Visitante como valor por defecto.
$nombre_usuario = isset($_GET['nombre']) ? $_GET['nombre'] : 'Visitante';

// Creamos una imagen en blanco de 400px de ancho por 150px de alto
$imagen = imagecreatetruecolor(400, 150);

// Las variables guardan los colores que vamos a usar
$color_fondo = imagecolorallocate($imagen, 60, 143, 224); 
$color_texto = imagecolorallocate($imagen, 255, 255, 255); 

// Rellenamos todo el lienzo con el color de fondo
imagefill($imagen, 0, 0, $color_fondo);

// Creamos el mensaje que vamos a escribir
$texto = "Hola, " . $nombre_usuario;

$fuente = 5; // Usamos la fuente interna 5
$ancho_texto = imagefontwidth($fuente) * strlen($texto);
$alto_texto = imagefontheight($fuente);
$posicion_x = (400 - $ancho_texto) / 2; 
$posicion_y = (150 - $alto_texto) / 2;

$posicion_x = round($posicion_x);
$posicion_y = round($posicion_y);

// Usamos las variables de lienzo, fuente, posición, texto y color
imagestring($imagen, $fuente, $posicion_x, $posicion_y, $texto, $color_texto);

header('Content-Type: image/png');

// Enviamos la imagen
imagepng($imagen);

//Liberamos la memoria
imagedestroy($imagen);
?>