
<?php
/* Guardar un archivo en el servidor desde un formulario HTML */
$message = '';
$error = '';
$uploads_dir = 'uploads';
//si $_POST tiene definido el índice upload quiere decir que el
//formulario fue enviado
if (isset($_POST['upload']))
{
    //Verificamos si existe algún error
    $error = $_FILES["archivo"]["error"];
    //si no hay errores podemos procede
    if ($error == UPLOAD_ERR_OK) {
        
        //Si no existe la carpeta, la creamos
        if(!file_exists($uploads_dir)){
            mkdir( $uploads_dir ,0777, true);
        }
        //obtenemos el nombre temporal del archivo
        $tmp_name = $_FILES["archivo"]["tmp_name"];
        //La función basename nos regresa el nombre del archivo sin la ruta
        $name = basename($_FILES["archivo"]["name"]);
        //movemos el archivo subido a la carpeta de nuestra elección
        if (move_uploaded_file($tmp_name, "$uploads_dir/$name"))
        {
            //si todo ocurre con normalidad mostraremos al usuario un mensaje de éxito
            $message = basename($_FILES["archivo"]["name"]) . " cargado correctamente";
        }
        else $error = "Ocurrió un error al subir el archivo";
    }
    else $error = "Ocurrió un error al subir el archivo";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=f, initial-scale=1.0">
    <title>Carga de archivo</title>
</head>
<style>
    body {
        background-color: #d8b7b7; 
        font-family: sans-serif;  
        margin: 0;
        padding: 40px 20px;
    }

    .form-container {
        background-color: #454137; 
        color: #fff;              
        padding: 30px;              
        border-radius: 8px;         
        width: fit-content;           
        margin: 0 auto;             
        text-align: left;           
    }
</style>
<body>
    
    <section class="form-container">
    <form method="post" enctype="multipart/form-data">
        <label for="archivo">Selecciona un archivo</label>
        <br></br>
        <input type="file" name="archivo">
        <button type="submit" name="upload">Subir</button>
    </form>
        
    <?php
    // Si la variable $message NO está vacía, la mostramos.
    if (!empty($message)) {   
        echo "<p style='color: yellow; font-weight: bold;'>$message</p>";
    }

    // Si la variable $error NO está vacía, la mostramos.
    if (!empty($error)) {
        echo "<p style='color: red; font-weight: bold;'>$error</p>";
    }
?>
    </section>
</body>
</html>
