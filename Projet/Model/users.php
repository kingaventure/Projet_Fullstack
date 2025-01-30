<?php
    function getAll(PDO $pdo, string | null $search = null, string | null $sortby = null, int $limit = 15, int $offset = 0)
    {
        $query = 'SELECT * FROM user';
        if (null !== $search) {
            $query .= ' WHERE id LIKE :search OR username LIKE :search OR email LIKE :search';
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
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    
    function getUserCount(PDO $pdo, string | null $search = null)
    {
        $query = 'SELECT COUNT(*) as count FROM user';
        if (null !== $search) {
            $query .= ' WHERE id LIKE :search OR username LIKE :search OR email LIKE :search';
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

    function toggleEnabled (PDO $pdo, int $id): void
    {
        $statement = $pdo->prepare("UPDATE user SET enabled = NOT enabled WHERE id = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    function delete (PDO $pdo, int $id)
    {
        try {
            $statement = $pdo->prepare("DELETE FROM user WHERE id = :id");
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
        }
        catch (PDOException $e) {
            return $e ->getMessage();
        }
    }