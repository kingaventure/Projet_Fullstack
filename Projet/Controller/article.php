
<?php
require './Model/article.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 15;
$search = isset($_GET['search']) ? $_GET['search'] : '';
$category_id = isset($_GET['category']) ? (int)$_GET['category'] : null;

$articles = getArticlesByPage($pdo, $page, $limit, $search, $category_id);
$totalArticles = getTotalArticles($pdo, $search, $category_id);
$totalPages = ceil($totalArticles / $limit);

require "./View/article.php";
?>