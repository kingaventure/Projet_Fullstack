<?php
require "./Model/category.php";

$errors = [];

if (isset($_POST['edit_button'])) {
    $category_name = !empty($_POST['category_name']) ? $_POST['category_name'] : null;
    $id = $_GET['Id'];

    if (!is_numeric($id)){
        $errors[] = "id au mauvais format";
    }

    if (!empty($category_name)) {
        $category_name = cleanString($category_name);

        $res = verifyName($pdo, $category_name, $id);
        if ($res['category_number'] != 0){
            $errors[] = "La categorie est déjà utilisé";
        }
        if (empty($errors)){
            $res = updateCategory($pdo, $id, $category_name);
            if (!empty($res)){
                $errors[] = $res;
            }
        }

        if (empty($errors)) {
            header("Location: index.php?component=categories");
            exit();
        }
    }
}

if (isset($_POST['valid_button'])) {
    $category_name = !empty($_POST['category_name']) ? $_POST['category_name'] : null;

    if (!empty($category_name)) {
        $category_name = cleanString($category_name);

        $res = verifyName($pdo, $category_name, 0);
        if ($res['category_number'] != 0){
            $errors[] = "La categorie est déjà utilisé";
        }
        if (empty($errors)){
            $res = createCategory($pdo, $category_name);
            if (!empty($res)){
                $errors[] = $res;
            }
        }

        if (empty($errors)) {
            header("Location: index.php?component=categories");
            exit();
        }
    } else {
        $errors[] = 'Tous les champs sont obligatoires';
    }
}

if (isset($_GET['Id'])) {
    $id = $_GET['Id'];
    if (!is_numeric($id)) {
        $errors[] = 'id au mauvais format';
    } else {
        $category = Category($pdo, $id);
        if(!is_array($category)) {
            $errors[] = $category;
        }
    }
}

require "./View/category.php";