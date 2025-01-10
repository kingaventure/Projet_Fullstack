<?php

    function verifyName( PDO $pdo, string $name, int $id)
    {
        try {
            $state = $pdo->prepare("SELECT COUNT(*) AS item_number FROM article WHERE Name = :name AND Id <> :id");
            $state->bindParam(':name', $name, PDO::PARAM_STR);
            $state->bindParam(':id', $id, PDO::PARAM_INT);
            $state->execute();
            return $state->fetch();
        } catch (Exception $e) {
            return "Erreur de verification du Nom {$e->getMessage()}";
        }
    }


    function item(PDO $pdo, int $id)
    {
        try {
            $state = $pdo->prepare("SELECT * FROM article WHERE Id = :id");
            $state->bindParam(':id', $id, PDO::PARAM_INT);
            $state->execute();
            return $state->fetch();
        } catch (Exception $e) {
            return "Erreur de requete : {$e->getMessage()}";
        }

    }

    function updateItem(PDO $pdo, int $id, string $name, string $description, string $category, string $price, string $stock)
    {
        try {
            $state = $pdo->prepare("UPDATE `article` SET Name = :Name, Description = :Description, Category = :Category, Prix = :Price, Stock = :Stock WHERE Id = :id");
            $state->bindParam(':id', $id, PDO::PARAM_INT);
            $state->bindParam(':Name', $name);
            $state->bindParam(':Description', $description);
            $state->bindParam(':Category', $category);
            $state->bindParam(':Price', $price);
            $state->bindParam(':Stock', $stock);
            $state->execute();
        } catch (Exception $e) {
            return "Erreur de requete : {$e->getMessage()}";
        }
    }

    function verify_item(PDO $pdo, string $name)
{
    try {
        $state = $pdo->prepare("SELECT COUNT(*) AS item_number FROM article WHERE name = :name");
        $state->bindParam(':name', $name, PDO::PARAM_STR);
        $state->execute();
        return $state->fetch(); 
    } catch (Exception $e) {
        return "Erreur de verification du Nomname {$e->getMessage()}";
    }
}

    function item_create (PDO $pdo, string $name, string $description, string $category, string $price, string $stock)
    {
        try {
            $state = $pdo->prepare('INSERT INTO article (`Name`, `Description`, `Category`, `Prix`, `Stock`) VALUES (:Name, :Description, :Category, :Price, :Stock)');
            $state->bindParam(':Name', $name);
            $state->bindParam(':Description', $description);
            $state->bindParam(':Category', $category);
            $state->bindParam(':Price', $price);
            $state->bindParam(':Stock', $stock);
            $state->execute();
        } catch (Exception $e) {
            return "Erreur à la création de l'article {$e->getMessage()}";
        }
    }