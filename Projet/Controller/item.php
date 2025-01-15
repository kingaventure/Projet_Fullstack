<?php
require "./Model/item.php";

$errors = [];

function validateNumeric($value) {
    return is_numeric($value);
}

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

        $fileName = null;

        if (!empty($_FILES["Image"]["name"])) {
            $tmpName = $_FILES["Image"]['tmp_name'];
            $fileName = $_FILES["Image"]["name"];
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $uniqFilename = uniqid();
            $finalName = $uniqFilename . "." . $ext;
    
            move_uploaded_file($tmpName, $_SERVER["DOCUMENT_ROOT"] . UPLOAD_DIRECTORY . $finalName);
            var_dump($_FILES);
        } 
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
                    exit();
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

        $fileName = null;

        if (!empty($_FILES["image"]["name"])) {
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
            $category = cleanString($category);
            $price = cleanString($price);
            $stock = cleanString($stock);

            $res = verify_item($pdo, $name);
            if ($res['item_number'] != 0) {
                $errors[] = 'Le nom est déjà utilisé';
            } else {
                $res = item_create($pdo, $name, $description, $category, $price, $stock, $finalName);
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

    if (file_exists($_SERVER["DOCUMENT_ROOT"] . UPLOAD_DIRECTORY . $item['image'])) {
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
}

require "./View/item.php";