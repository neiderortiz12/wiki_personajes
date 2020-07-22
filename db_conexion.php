<?php
$server ='localhost';
$username = 'root';
$password = '';
$database = 'wiki_personajes';

try{
    $conn = new PDO("mysql:host=$server;dbname=$database;",$username,$password);

}catch(PDOExeption $e){
    die('coneccion fail :'.$e -> getMessage());
}

?>