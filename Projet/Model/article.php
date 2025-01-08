<?php

function getArticlesByPage(PDO $pdo, int $page, int $limit) {
    $offset = ($page - 1) * $limit;
    $query = 'SELECT * FROM article LIMIT :limit OFFSET :offset';
    $statement = $pdo->prepare($query);
    try {
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function getTotalArticles(PDO $pdo) {
    $query = 'SELECT COUNT(*) AS total FROM article';
    $statement = $pdo->prepare($query);
    try {
        $statement->execute();
        return $statement->fetch()['total'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
?>