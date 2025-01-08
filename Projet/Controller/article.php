<?php
require "./Model/article.php";

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 15; 
$search = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';


$articles = getArticlesByPage($pdo, $page, $limit, $search, $category);

$totalArticles = getTotalArticles($pdo, $search, $category);
$totalPages = ceil($totalArticles / $limit);

require "./View/article.php";
?>
