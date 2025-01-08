<?php
function getArticlesByPage(PDO $pdo, $page, $limit, $search = '', $category = '')
{
    $offset = ($page - 1) * $limit;
    $query = 'SELECT * FROM article WHERE Name LIKE :search';
    
    // Ajoute la condition pour la catégorie si elle est fournie
    if (!empty($category)) {
        $query .= ' AND Category LIKE :category';
    }

    $query .= ' LIMIT :limit OFFSET :offset';
    
    $statement = $pdo->prepare($query);
    $searchTerm = '%' . $search . '%';
    $statement->bindValue(':search', $searchTerm, PDO::PARAM_STR);
    
    // Si une catégorie est fournie, lie la valeur du paramètre :category
    if (!empty($category)) {
        $categoryTerm = '%' . $category . '%';
        $statement->bindValue(':category', $categoryTerm, PDO::PARAM_STR);
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



function getTotalArticles(PDO $pdo, $search = '', $category = '')
{
    $query = 'SELECT COUNT(*) AS total FROM article WHERE Name LIKE :search';
    
    // Ajoute la condition pour la catégorie si elle est fournie
    if (!empty($category)) {
        $query .= ' AND Category LIKE :category';
    }

    $statement = $pdo->prepare($query);
    $searchTerm = '%' . $search . '%';
    $statement->bindValue(':search', $searchTerm, PDO::PARAM_STR);

    // Si une catégorie est fournie, lie la valeur du paramètre :category
    if (!empty($category)) {
        $categoryTerm = '%' . $category . '%';
        $statement->bindValue(':category', $categoryTerm, PDO::PARAM_STR);
    }

    $statement->execute();
    $result = $statement->fetch();
    return $result['total'];
}


?>