<?php 

require './Model/categories.php'; 

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
                $delete = "Impossible de supprimer la catégorie car celui-ci est encore lié !";
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
$categories = getAll($pdo, $search, $sortby);

if (!is_array($categories))
{
    $errors[] = $categories;
}

require './View/categories.php'


?>