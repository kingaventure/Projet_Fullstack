<?php
require_once 'vendor/autoload.php';

$pdo = new PDO('mysql:host=localhost;dbname=ma_base', 'root');
$faker = Faker\Factory::create();

for ($i = 0; $i < 10; $i++) {
    $nom = $faker->name();
    $email = $faker->email();
    $adresse = $faker->address();

    $query = $pdo->prepare("INSERT INTO user (nom, email, adresse) VALUES (:nom, :email, :adresse)");
    $query->execute([
        'nom' => $nom,
        'email' => $email,
        'adresse' => $adresse,
    ]);
}

echo "10 utilisateurs insérés avec succès !\n";
?>