<?php
    function getAll(PDO $pdo, string | null $search = null, string | null $sortby = null)
    {
        $query = 'SELECT * FROM article';
        if (null !== $search) {
            $query .= ' WHERE Id LIKE :search OR Name LIKE :search';
        }
        if (null !== $sortby) {
            $query .= " ORDER BY $sortby";
        }
        $statement = $pdo->prepare($query);

        try {
            if (null !== $search) {
                $statement->bindValue(':search', "%$search%");
            }


            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            return $e->getMessage();
        }

    }


    function delete (PDO $pdo, int $id)
    {
        try {
            $statement = $pdo->prepare("DELETE FROM article WHERE Id = :Id");
            $statement->bindParam(':Id', $id, PDO::PARAM_INT);
            $statement->execute();
        }
        catch (PDOException $e) {
            return $e ->getMessage();
        }
    }

    function getArticleCategoryNames(PDO $pdo, int $category_id) {
        try {
            $statement = $pdo->prepare("SELECT category_name FROM category WHERE Id = :category_id");
            $statement->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            return $e->getMessage();
        }
    }