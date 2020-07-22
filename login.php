<?php
    session_start();

    if(isset($_SESSION['user_id'])){
        header('Location: /wiki_personajes/index.php');
    }

    require 'db_conexion.php';

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $records = $conn->prepare('SELECT id, email, password FROM usuarios WHERE email=:email');
        $records->bindParam(':email',$_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){
            $_SESSION['user_id'] = $results['id'];
            header('Location: /wiki_personajes/index.php');

        }else{
            $message = 'ususario no existe';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php'?>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Ingrese Email">
        <input type="password" name="password" placeholder="Ingrese Contraseña">
        <input type="submit" value="Ingresar">
    </form>
</body>
</html>