<?php
function getArticlesByPage(PDO $pdo, $page, $limit, $search = '', $category_id = null)
{
    $offset = ($page - 1) * $limit;
    $query = 'SELECT article.*, category.category_name FROM article 
              JOIN category ON article.category_id = category.Id 
              WHERE article.Name LIKE :search';
    
    if (!empty($category_id)) {
        $query .= ' AND article.category_id = :category_id';
    }

    $query .= ' ORDER BY article.Id LIMIT :limit OFFSET :offset';
    
    $statement = $pdo->prepare($query);
    $searchTerm = '%' . $search . '%';
    $statement->bindValue(':search', $searchTerm, PDO::PARAM_STR);
    
    if (!empty($category_id)) {
        $statement->bindValue(':category_id', $category_id, PDO::PARAM_INT);
    }

    $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
    $statement->bindValue(':offset', $offset, PDO::PARAM_INT);

    try {
        $statement->execute();
        return $statement->fetchAll();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function getTotalArticles(PDO $pdo, $search = '', $category_id = null)
{
    $query = 'SELECT COUNT(*) AS total FROM article WHERE Name LIKE :search';
    
    if (!empty($category_id)) {
        $query .= ' AND category_id = :category_id';
    }

    $statement = $pdo->prepare($query);
    $searchTerm = '%' . $search . '%';
    $statement->bindValue(':search', $searchTerm, PDO::PARAM_STR);

    if (!empty($category_id)) {
        $statement->bindValue(':category_id', $category_id, PDO::PARAM_INT);
    }

    $statement->execute();
    $result = $statement->fetch();
    return $result['total'];
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

function getAllPromotions(PDO $pdo) {
    try {
        $currentDate = new DateTime();
        $statement = $pdo->prepare("SELECT * FROM promotion WHERE end > :currentDate ORDER BY end DESC");
        $statement->bindValue(':currentDate', $currentDate->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll();
    }
    catch (PDOException $e) {
        return $e->getMessage();
    }
}
