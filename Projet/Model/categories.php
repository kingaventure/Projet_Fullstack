<?php
function getAll(PDO $pdo, string | null $search = null, string | null $sortby = null, int $limit = 15, int $offset = 0)
{
    $query = 'SELECT * FROM category';
    if (null !== $search) {
        $query .= ' WHERE Id LIKE :search OR category_name LIKE :search';
    }
    if (null !== $sortby) {
        $query .= " ORDER BY $sortby";
    }
    $query .= " LIMIT :limit OFFSET :offset";
    $statement = $pdo->prepare($query);

    try {
        if (null !== $search) {
            $statement->bindValue(':search', "%$search%");
        }
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        return $e->getMessage();
    }
}

function getCategoryCount(PDO $pdo, string | null $search = null)
{
    $query = 'SELECT COUNT(*) as count FROM category';
    if (null !== $search) {
        $query .= ' WHERE Id LIKE :search OR category_name LIKE :search';
    }
    $statement = $pdo->prepare($query);

    try {
        if (null !== $search) {
            $statement->bindValue(':search', "%$search%");
        }

        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC)['count'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function delete (PDO $pdo, int $id)
{
    try {
        $statement = $pdo->prepare("DELETE FROM category WHERE Id = :Id");
        $statement->bindParam(':Id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
    catch (PDOException $e) {
        return $e ->getMessage();
    }
}