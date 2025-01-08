<?php

    require "./Model/article.php";

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 15;
    $totalArticles = getTotalArticles($pdo);
    $totalPages = ceil($totalArticles / $limit);

    $articles = getArticlesByPage($pdo, $page, $limit);

    require "./View/article.php";
?>