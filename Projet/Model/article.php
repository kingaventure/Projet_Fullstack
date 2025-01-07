<?php

function getAll(PDO $pdo)
    {
     
        $query = 'SELECT * FROM article';
        $statement = $pdo->prepare($query);
        try {
            $statement->execute();
            return $statement->fetchAll();
        }
        catch (PDOException $e) {
            return $e->getMessage();
        }

    }
?>