<?php

/**
 * @var PDO $pdo
 */


require "./Model/login.php";
if (
    !empty($_SERVER['CONTENT_TYPE']) && (
        $_SERVER['CONTENT_TYPE'] === 'application/json' ||
        str_starts_with($_SERVER['CONTENT_TYPE'], 'application/x-www-form-urlencoded')
    )
    
) {
    
    $errors = [];
    $username = !empty($_POST["username"]) ? $_POST['username'] : null;
    $password = !empty($_POST["password"]) ? $_POST["password"] : null;

    if (
        $username != null &&
        $password != null
    ) {
        $username = cleanString($username);
        $password = cleanString($password);

        // Bloquer les utilisateurs dont le pseudo n'est pas "admin"
        if ($username !== 'admin') {
            $errors[] = "Seul l'utilisateur 'admin' peut se connecter";
            header("Content-Type: application/json");
            echo json_encode(['errors' => $errors]);
            exit();
        }

        $user = getUser($pdo, $username);
        if (is_array($user)) {

            if (password_verify($password, $user['password']) && $user['enabled'] === 1) {
                $_SESSION["authentication"] = true;
                $_SESSION["user_username"] = $user['username'];
                header("Content-Type: application/json");
                echo json_encode(['authentication' => true]);
                exit();
            } elseif ($user['enabled'] === 0 && password_verify($password, $user['password'])) {
                $errors[] = "L'utilisateur n'est pas actif";
                header("Content-Type: application/json");
                echo json_encode(['errors' => $errors]);
                exit();
            } else {
                $errors[] = "L'identification a échoué";
                header("Content-Type: application/json");
                echo json_encode(['errors' => $errors]);
                exit();
            }
        }

    } else {
        $errors[] = "Veuillez remplir tous les champs";
        header("Content-Type: application/json");
        echo json_encode(['errors' => $errors]);
        exit();
    } 
}

require "./View/login.php";