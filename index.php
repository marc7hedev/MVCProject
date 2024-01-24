<?php

    require_once "./config/app.php";
    require_once "./autoload.php";
    require_once "./app/views/inc/session_start.php";

    if(isset($_GET['views'])){
        $url = explode("/", $_GET['views']);
    }else{
        $url = ["login"];
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once "./app/views/inc/head.php";?>
</head>
<body>

    <div class="buttons">
    <button class="button is-primary">Primary</button>
    <button class="button is-link">Link</button>
    </div>

    <div class="buttons">
    <button class="button is-info">Info</button>
    <button class="button is-success">Success</button>
    <button class="button is-warning">Warning</button>
    <button class="button is-danger">Danger</button>
    </div>


    <?php require_once "./app/views/inc/script.php";?>
    
</body>
</html>