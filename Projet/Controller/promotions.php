<?php
require "./Model/promotions.php";

if (
    isset($_GET['action']) &&
    isset($_GET['id']) &&
    is_numeric($_GET['id'])
) {
    $id = cleanString($_GET['id']);
    switch ($_GET['action']) {
        case 'delete':
            $delete = delete($pdo, $id);
            if (!empty($delete)) {
                $delete = "Impossible de supprimer la promotion car celle-ci est encore liée !";
                $errors[] = $delete;
            } else {
                header("Location: index.php?component=promotions");
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

$promotions = getAll($pdo, $search, $sortby, $limit, $offset);
$totalPromotions = getPromotionCount($pdo, $search);
$totalPages = ceil($totalPromotions / $limit);

if (!is_array($promotions)) {
    $errors[] = $promotions;
}

require "./View/promotions.php";