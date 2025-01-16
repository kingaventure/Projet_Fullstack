<?php
require "./Model/item.php";

if (!defined('UPLOAD_DIRECTORY')) {
    define('UPLOAD_DIRECTORY', '/uploads/');
}

$errors = [];

function validateNumeric($value) {
    return is_numeric($value);
}

if (!function_exists('cleanString')) {
    function cleanString($string) {
        return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
    }
}

if (isset($_POST['edit_button'])) {
    $name = !empty($_POST['Name']) ? $_POST['Name'] : null;
    $description = !empty($_POST['Description']) ? $_POST['Description'] : null;
    $category_id = !empty($_POST['category_id']) ? $_POST['category_id'] : null;
    $price = !empty($_POST['Prix']) ? $_POST['Prix'] : null;
    $stock = !empty($_POST['Stock']) ? $_POST['Stock'] : null;
    $id = $_GET['id'];
    $fileName = null;

    if (isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])) {
        $tmpName = $_FILES["image"]['tmp_name'];
        $fileName = $_FILES["image"]["name"];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $uniqFilename = uniqid();
        $finalName = $uniqFilename . "." . $ext;

        move_uploaded_file($tmpName, $_SERVER["DOCUMENT_ROOT"] . UPLOAD_DIRECTORY . $finalName);
    } else {
        $finalName = null;
    }

    if (empty($errors)) {
        $name = cleanString($name);
        $description = cleanString($description);
        $category_id = cleanString($category_id);
        $price = cleanString($price);
        $stock = cleanString($stock);

        $res = verifyName($pdo, $name, $id);
        if ($res['item_number'] != 0) {
            $errors[] = "Le nom est déjà utilisé";
        }
        if (empty($errors)) {
            $category_id = getIdCategory_id($pdo, $category_id);
            if (is_array($category_id)) {
                $category_id = $category_id['Id'];
            } else {
                $errors[] = $category_id;
            }
            $res = updateItem($pdo, $id, $name, $description, $category_id, $price, $stock, $finalName);
            if (!empty($res)) {
                $errors[] = $res;
            } else {
                header("Location: index.php?component=items");
                exit();
            }
        }
    }
}

if (isset($_POST['valid_button'])) {
    $name = !empty($_POST['Name']) ? $_POST['Name'] : null;
    $description = !empty($_POST['Description']) ? $_POST['Description'] : null;
    $category_id = !empty($_POST['category_id']) ? $_POST['category_id'] : null;
    $price = !empty($_POST['Prix']) ? $_POST['Prix'] : null;
    $stock = !empty($_POST['Stock']) ? $_POST['Stock'] : null;

    if (!empty($name) && !empty($description) && !empty($category_id) && !empty($price) && !empty($stock)) {
        if (!validateNumeric($price)) {
            $errors[] = "Le prix doit être un nombre";
        }
        if (!validateNumeric($stock)) {
            $errors[] = "Le stock doit être un nombre";
        }

        $fileName = null;

        if (isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])) {
            $tmpName = $_FILES["image"]['tmp_name'];
            $fileName = $_FILES["image"]["name"];
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $uniqFilename = uniqid();
            $finalName = $uniqFilename . "." . $ext;

            move_uploaded_file($tmpName, $_SERVER["DOCUMENT_ROOT"] . UPLOAD_DIRECTORY . $finalName);
        }

        if (empty($errors)) {
            $name = cleanString($name);
            $description = cleanString($description);
            $category_id = cleanString($category_id);
            $price = cleanString($price);
            $stock = cleanString($stock);

            $res = verify_item($pdo, $name);
            if ($res['item_number'] != 0) {
                $errors[] = 'Le nom est déjà utilisé';
            } else {
                $res = item_create($pdo, $name, $description, $category_id, $price, $stock, $finalName);
                if (!empty($res)) {
                    $errors[] = $res;
                } else {
                    header("Location: index.php?component=items");
                    exit();
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
    $id = !empty($_GET['id']) ? (int)cleanString($_GET['id']) : null;
    if (null === $id || !is_int($id)) {
        header("Content-Type: application/json");
        echo json_encode(['error' => "id incorrect"]);
        exit();
    }

    $item = item($pdo, $id);
    if (is_string($item) || empty($item)) {
        header("Content-Type: application/json");
        echo json_encode(['error' => "Impossible de sélectionner l'article"]);
        exit();
    }
    
    if (isset($item['image']) && file_exists($_SERVER["DOCUMENT_ROOT"] . UPLOAD_DIRECTORY . $item['image'])) {
        try {
            unlink($_SERVER["DOCUMENT_ROOT"] . UPLOAD_DIRECTORY . $item['image']);
        } catch (Exception $e) {
            header("Content-Type: application/json");
            echo json_encode(['error' => "Impossible de détruire le fichier " . $e->getMessage()]);
            exit();
        }
        $reset = resetImage($pdo, $id);
    
        if (is_string($reset)) {
            header("Content-Type: application/json");
            echo json_encode(['error' => $reset]);
            exit();
        } else {
            header("Content-Type: application/json");
            echo json_encode(['success' => true]);
            exit();
        }
    }
    $categorys = getArticleCategoryNames($pdo, $item['category_id']);
    $item['category_id'] = $categorys['category_name'];
    $categories = getAllCategories($pdo);
}

require "./View/item.php";