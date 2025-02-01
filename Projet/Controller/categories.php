<?php

require "./Model/categories.php";

if (
    isset($_GET['action']) &&
    isset($_GET['Id']) &&
    is_numeric($_GET['Id'])
) {
    $id = cleanString($_GET['Id']);
    switch ($_GET['action']) {
        case 'delete':
            $delete = delete($pdo, $id);
            if (!empty($delete))
            {
                $delete = "Impossible de supprimer la catégorie car celle-ci est encore liée !";
                $errors[] = $delete;
            } else {
                header("Location: index.php?component=categories");
            }

            break;
        default:
            break;
    }
}

$search = isset($_POST['search']) ? $_POST['search'] : null;
$sortby = isset($_GET['sortby']) ? $_GET['sortby'] : null;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 15;
$offset = ($page - 1) * $limit;

$categories = getAll($pdo, $search, $sortby, $limit, $offset);
$totalCategories = getCategoryCount($pdo, $search);
$totalPages = ceil($totalCategories / $limit);

if (!is_array($categories)) {
    $errors[] = $categories;
}

require "./View/categories.php";