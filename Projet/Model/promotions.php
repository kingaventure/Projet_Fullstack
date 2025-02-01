<?php
function getAll($pdo, $search = null, $sortby = null, $limit = 15, $offset = 0) {
    $query = "SELECT promotion.id, promotion.start, promotion.end, promotion.reduction, article.name AS article_name FROM promotion 
              JOIN article ON promotion.article_id = article.id";
    
    if ($search) {
        $query .= " WHERE article.name LIKE :search";
    }
    
    if ($sortby) {
        $query .= " ORDER BY " . $sortby;
    }

    $query .= " LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($query);
    
    if ($search) {
        $stmt->bindValue(':search', '%' . $search . '%');
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPromotionCount($pdo, $search = null) {
    $query = "SELECT COUNT(*) as count FROM promotion 
              JOIN article ON promotion.article_id = article.id";
    
    if ($search) {
        $query .= " WHERE article.name LIKE :search";
    }
    
    $stmt = $pdo->prepare($query);
    
    if ($search) {
        $stmt->bindValue(':search', '%' . $search . '%');
    }
    
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
}

function delete (PDO $pdo, int $id) {
    try {
        $statement = $pdo->prepare("DELETE FROM promotion WHERE id = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
    catch (PDOException $e) {
        return $e ->getMessage();
    }
}