<?php
    function getUser(PDO $pdo, string $username) : array | string {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT username, password, enabled FROM user WHERE username = :username";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':username', $username, PDO::PARAM_STR);
        try {
            $prep->execute();
        }
        catch (PDOException $e)
        {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }
        $res = $prep->fetch(PDO::FETCH_ASSOC);
        $prep->closeCursor();
        return $res;
    }
?>
