<?php
    function getAll($pdo, $search = null, $sortby = null) {
        $query = "SELECT promotion.id, promotion.start, promotion.end, promotion.reduction, article.name AS article_name FROM promotion 
                  JOIN article ON promotion.article_id = article.id";
        
        if ($search) {
            $query .= " WHERE article.name LIKE :search";
        }
        
        if ($sortby) {
            $query .= " ORDER BY " . $sortby;
        }
    
        $stmt = $pdo->prepare($query);
        
        if ($search) {
            $stmt->bindValue(':search', '%' . $search . '%');
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    function delete (PDO $pdo, int $id)
    {
        try {
            $statement = $pdo->prepare("DELETE FROM promotion WHERE id = :id");
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
        }
        catch (PDOException $e) {
            return $e ->getMessage();
        }
    }