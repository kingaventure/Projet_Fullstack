<?php
    function getAll(PDO $pdo, string | null $search = null, string | null $sortby = null)
    {
        $query = 'SELECT * FROM category';
        if (null !== $search) {
            $query .= ' WHERE Id LIKE :search OR category_name LIKE :search LIKE :search';
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
            $statement = $pdo->prepare("DELETE FROM category WHERE Id = :id");
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
        }
        catch (PDOException $e) {
            return $e ->getMessage();
        }
    }