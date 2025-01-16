<?php
function verifyName( PDO $pdo, string $category_name, int $id)
{
    try {
        $state = $pdo->prepare("SELECT COUNT(*) AS category_number FROM category WHERE category_name = :category_name AND Id <> :id");
        $state->bindParam(':category_name', $category_name, PDO::PARAM_STR);
        $state->bindParam(':id', $id, PDO::PARAM_INT);
        $state->execute();
        return $state->fetch();
    } catch (Exception $e) {
        return "Erreur de verification du username {$e->getMessage()}";
    }
}
function Name(PDO $pdo, int $id)
{
    try {
        $state = $pdo->prepare("SELECT * FROM category WHERE Id = :id");
        $state->bindParam(':id', $id, PDO::PARAM_INT);
        $state->execute();
        return $state->fetch();
    } catch (Exception $e) {
        return "Erreur de requete : {$e->getMessage()}";
    }

}
function Category($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM category WHERE Id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function updateCategory(PDO $pdo, int $id, string $category_name)
    {
        try {
            $state = $pdo->prepare("UPDATE `category` SET category_name = :category_name WHERE Id = :id");
            $state->bindParam(':id', $id, PDO::PARAM_INT);
            $state->bindParam(':category_name', $category_name);
            $state->execute();
        } catch (Exception $e) {
            return "Erreur de requete : {$e->getMessage()}";
        }
    }
    function createCategory(PDO $pdo, string $category_name)
    {
        try {
            $state = $pdo->prepare('INSERT INTO category (`category_name`) VALUES (:category_name)');
            $state->bindParam(':category_name', $category_name);
            $state->execute();
        } catch (Exception $e) {
            return "Erreur à la création du user {$e->getMessage()}";
        }
    }