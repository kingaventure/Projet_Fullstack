<?php
    session_start();
    require './includes/database.php';
    require './includes/function.php';
    $errors = [];
    if (isset($_GET['logout']) && $_GET['logout']) {
        session_destroy();
        header("Location: index.php");
        exit();
    }
    if (
            !empty($_SERVER['CONTENT_TYPE']) &&
            ($_SERVER['CONTENT_TYPE'] === 'application/json' || str_starts_with($_SERVER['CONTENT_TYPE'],'application/x-www-form-urlencoded') )
    ){
        if (isset($_SESSION['authentication']))
        {
            if (isset($_GET['component'])) {
                $componentName = cleanString($_GET['component']);
                if (file_exists("Controller/$componentName.php")) {
                    require "Controller/$componentName.php";
                }
            }
        } else {
            require "Controller/login.php";
        }
         exit();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
                rel="stylesheet"
        >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Projet de julien</title>
</head>
<body data-bs-theme="dark">
        
    <?php require './_partials/navbar.php'; ?>
    
    <?php 
        if (isset($_GET['component'])) {
            $componentName = ($_GET['component']);
            if (file_exists("Controller/$componentName.php")){
                require "./Controller/$componentName.php";
            }  
        }
        ?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>