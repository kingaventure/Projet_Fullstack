<?php

    require "./Model/article.php";

    $articles = getAll($pdo);

    require "./View/article.php";
?>