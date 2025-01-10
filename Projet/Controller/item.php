<?php
require "./Model/item.php";

$errors = [];

if (isset($_POST['edit_button'])) {
    $name = !empty($_POST['Name']) ? $_POST['Name'] : null;
    $description = !empty($_POST['Description']) ? $_POST['Description'] : null;
    $category = !empty($_POST['Category']) ? $_POST['Category'] : null;
    $price = !empty($_POST['Prix']) ? $_POST['Prix'] : null;
    $stock = !empty($_POST['Stock']) ? $_POST['Stock'] : null;
    $id = $_GET['id'];

    if (!is_numeric($id)) {
        $errors[] = "Id au mauvais format";
    }

    if (!empty($name) && !empty($description) && !empty($category) && !empty($price) && !empty($stock)) {

        if (empty($errors)) {
            $name = cleanString($name);
            $description = cleanString($description);
            $category = cleanString($category);
            $price = cleanString($price);
            $stock = cleanString($stock);

            $res = verifyName($pdo, $name, $id);
            if ($res['item_number'] != 0) {
                $errors[] = "Le nom est déjà utilisé";
            }
            if (empty($errors)) {
                $res = updateItem($pdo, $id, $name, $description, $category, $price, $stock);
                if (!empty($res)) {
                    $errors[] = $res;
                } else {
                    header("Location: index.php?component=items");
                    
                }
            }
        }
    } else {
        $errors[] = "Tous les champs sont obligatoires";
    }
}

if (isset($_POST['valid_button'])) {
    $name = !empty($_POST['Name']) ? $_POST['Name'] : null;
    $description = !empty($_POST['Description']) ? $_POST['Description'] : null;
    $category = !empty($_POST['Category']) ? $_POST['Category'] : null;
    $price = !empty($_POST['Prix']) ? $_POST['Prix'] : null;
    $stock = !empty($_POST['Stock']) ? $_POST['Stock'] : null;

    if (!empty($name) && !empty($description) && !empty($category) && !empty($price) && !empty($stock)) {
        if (!validateNumeric($price)) {
            $errors[] = "Le prix doit être un nombre";
        }
        if (!validateNumeric($stock)) {
            $errors[] = "Le stock doit être un nombre";
        }

        if (empty($errors)) {
            $name = cleanString($name);
            $description = cleanString($description);
            $category = cleanString($category);
            $price = cleanString($price);
            $stock = cleanString($stock);

            $res = verify_item($pdo, $name);
            if ($res['item_number'] != 0) {
                $errors[] = 'Le nom est déjà utilisé';
            } else {
                $res = item_create($pdo, $name, $description, $category, $price, $stock);
                if (!empty($res)) {
                    $errors[] = $res;
                } else {
                    header("Location: index.php?component=items");
                    
                }
            }
        }
    } else {
        $errors[] = 'Tous les champs sont obligatoires';
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (!is_numeric($id)) {
        $errors[] = 'Id au mauvais format';
    } else {
        $item = item($pdo, $id);
        if (!is_array($item)) {
            $errors[] = $item;
        }
    }
}

require "./View/item.php";