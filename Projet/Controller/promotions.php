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

                if (!empty($delete))
                {
                    $delete = "Impossible de supprimer la promotion car celui-ci est encore lié !";
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
    $offres = getAll($pdo, $search, $sortby);

    if (!is_array($offres))
    {
        $errors[] = $offres;
    }


require "./View/promotions.php";