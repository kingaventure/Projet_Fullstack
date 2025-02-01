<?php
    require "./Model/promotion.php";

    if (isset($_POST['edit_button'])) {
        $article_id = !empty($_POST['article_id']) ? $_POST['article_id'] : null;
        $reduction = !empty($_POST['reduction']) ? $_POST['reduction'] : null;
        $start = !empty($_POST['start']) ? $_POST['start'] : null;
        $end = !empty($_POST['end']) ? $_POST['end'] : null;
        $id = $_GET['id'];

        if (!is_numeric($id)){
            $errors[] = "id au mauvais format";
        }

        if (
            !empty($article_id) &&
            !empty($reduction)
        ){
            $reduction = cleanString($reduction);
            $start = cleanString($start);
            $end = cleanString($end);

            if (empty($errors)){
                $res = updatePromo($pdo, $id, $article_id, $reduction, $start, $end);
                if (!empty($res)){
                    $errors[] = $res;
                }
            }

            
        }
        if (empty($errors)) {
            header("Location: index.php?component=promotions");
            exit;
        }
    }

    if (isset($_POST['valid_button'])) {
        $article_id = !empty($_POST['article_id']) ? $_POST['article_id'] : null;
        $reduction = !empty($_POST['reduction']) ? $_POST['reduction'] : null;
        $start = !empty($_POST['start']) ? $_POST['start'] : null;
        $end = !empty($_POST['end']) ? $_POST['end'] : null;

        if (
            !empty($article_id) &&
            !empty($reduction) &&
            !empty($start) &&
            !empty($end)
        ) {
            $reduction = cleanString($reduction);
            $start = cleanString($start);
            $end = cleanString($end);

            if (empty($errors)) {
                
                $res = promotion_create($pdo, $article_id, $reduction, $start, $end);
                    if(!empty($res)) {
                        $errors[] = $res;
                    }
                    header("Location: index.php?component=promotions");
                    exit;
            }
        } else {
            $errors[] = 'Tous les champs sont obligatoires';
        }
    }


    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (!is_numeric($id)) {
            $errors[] = 'id au mauvais format';
        } else {
            $offre = promotion($pdo, $id);
            if(!is_array($offre)) {
                $errors[] = $offre;
            }
        }
    }

    $articles = getAllItems($pdo);

    require "./View/promotion.php";
