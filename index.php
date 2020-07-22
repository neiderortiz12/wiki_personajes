<?php 
    session_start();
    require 'db_conexion.php';

    if(isset($_SESSION['user_id'])){
        $records = $conn->prepare('SELECT id , email, password FROM usuarios WHERE id=:id');
        $records->bindParam(':id',$_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user= null;

        if(count($results) > 0){
            $user=$results;
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
    <?php if(!empty($user)): ?>
        <?php require 'partials/header-session.php'?>
        <br> <h1>Hola </h1> <?=$user['email'] ?>
        <br>
    <?php else:?>
        <?php require 'partials/header.php'?>
        <h1>NO ha iniciado sessión</h1>
        
    <?php endif; ?>
</body>
</html>