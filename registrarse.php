<?php require 'db_conexion.php';

    $message ='';
    if (!empty($_POST['email']) && !empty($_POST['password'])){
        $sql = "INSERT INTO usuarios (nombre, password, fecha_nacimiento, email) VALUES (:nombre, :password, :date,:email)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':date', $_POST['date']);
        $stmt->bindParam(':email',$_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password',$password);

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
    <?php require 'partials/header.php'?>
    <h1>Registro</h1>
    <form action="registrarse.php" method="post">
        <input type="text" name="nombre" placeholder="Ingrese su nombre" require>
        <input type="date" name="date" placeholder="Fecha de nacimiento" require>
        <input type="email" name="email" placeholder="Ingrese su Email" require>
        <input type="password" name="password" placeholder="Igrese una Contraseña" require>
        <input type="password" name="confirm_password" placeholder="Confirmar Contraseña" require>
        <input type="submit" value="Registrarse">
    </form>
    
</body>
</html>