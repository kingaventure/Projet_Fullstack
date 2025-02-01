<?php

    function promotion(PDO $pdo, int $id)
    {
        try {
            $state = $pdo->prepare("SELECT * FROM promotion WHERE id = :id");
            $state->bindParam(':id', $id, PDO::PARAM_INT);
            $state->execute();
            return $state->fetch();
        } catch (Exception $e) {
            return "Erreur de requete : {$e->getMessage()}";
        }

    }

    function updatePromo(PDO $pdo, int $id, int $article_id, int $reduction, string $start, string $end)
    {
        try {
            $state = $pdo->prepare("UPDATE `promotion` SET article_id = :article_id, reduction = :reduction, start = :start, end = :end WHERE id = :id");
            $state->bindParam(':id', $id, PDO::PARAM_INT);
            $state->bindParam(':article_id', $article_id);
            $state->bindParam(':reduction', $reduction);
            $state->bindParam(':start', $start);
            $state->bindParam(':end', $end);
            $state->execute();
        } catch (Exception $e) {
            return "Erreur de requete : {$e->getMessage()}";
        }
    }



    function promotion_create (PDO $pdo, int $article_id, int $reduction, string $start, string $end)
    {
        try {
            $state = $pdo->prepare('INSERT INTO promotion (`article_id`, `reduction`, `start`, `end`) VALUES (:article_id, :reduction, :start, :end)');
            $state->bindParam(':article_id', $article_id);
            $state->bindParam(':reduction', $reduction);
            $state->bindParam(':start', $start);
            $state->bindParam(':end', $end);
            $state->execute();
        } catch (Exception $e) {
            return "Erreur à la création de la promotion {$e->getMessage()}";
        }
    }

    function getAllItems(PDO $pdo)
    {
        try {
            $state = $pdo->prepare("SELECT * FROM article");
            $state->execute();
            return $state->fetchAll();
        } catch (Exception $e) {
            return "Erreur de requete : {$e->getMessage()}";
        }
    }