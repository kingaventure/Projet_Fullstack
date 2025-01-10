<?php

require "./Model/items.php";

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
                    $delete = "Impossible de supprimer l'utilisateur car celui-ci est encore lié !";
                    $errors[] = $delete;
                } else {
                    header("Location: index.php?component=items");
                }

                break;
            default:
                break;
        }


    }

    $search = isset($_POST['search']) ? $_POST['search'] : null;
    $sortby = isset($_GET['sortby']) ? $_GET['sortby'] : null;
    $items = getAll($pdo, $search, $sortby);

    if (!is_array($items))
    {
        $errors[] = $items;
    }


require "./View/items.php";