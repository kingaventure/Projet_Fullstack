<?php

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=ecommerce_julien', 'root');
    } catch (Exception $e) {
        $errors[] = "Erreur de connexion à la bdd {$e->getMessage()}";
    }


?>
