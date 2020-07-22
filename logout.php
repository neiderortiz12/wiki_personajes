<?php
    session_start();

    session_unset();

    session_destroy();

    header('Location: /wiki_personajes/index.php');
?>