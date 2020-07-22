
<?php
#    session_start();
#    if(!isset($_SESSION['user_id'])){
#        header('Location: /wiki_personajes/index.php');
#    }
    require 'db_conexion.php';
    $message ='';
    if (!empty($_POST['nombre_personaje'])){
        $sql = "INSERT INTO personajes (nombre, descripcion, fecha_nacimiento, pais, imagen, usuario) VALUES (:nombre, :descripcion, :date,:pais,:imagen,:usuario)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $_POST['nombre_personaje']);
        $stmt->bindParam(':date', $_POST['date']);
        $stmt->bindParam(':descripcion',$_POST['descripcion']);
        $stmt->bindParam(':pais',$_POST['pais']);
        $usuario = "neider";
        $stmt->bindParam(':usuario',$usuario);
        $nombreImagen = $_FILES['imagen']['name'];
        $archivo = $_FILES['imagen']['tmp_name'];
        $ruta="images";
        $ruta=$ruta."/".$nombreImagen;
        move_uploaded_file($archivo,$ruta);
        $stmt->bindParam(':imagen',$ruta);

        if($stmt->execute()){
            $message = 'succerfull create a new user';

        } else{
            $message = 'ha ocurrido un error';
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <form action="agregar.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="nombre_personaje" placeholder="Nombre del personaje" require>
        <input type="date" name="date" placeholder="Fecha de nacimiento" require>
        <input type="text" name="pais" placeholder="Pais de origen">
        <input type="text" name="descripcion" placeholder="descripcion" require>
        <input type="file" name="imagen" require><br>
        <input type="submit" value="enviar">
    </form>
</body>
</html>