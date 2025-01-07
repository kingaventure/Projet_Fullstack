<?php
require_once 'vendor/autoload.php';

$pdo = new PDO('mysql:host=localhost;dbname=ecommerce_julien', 'root');
$faker = Faker\Factory::create();

for ($i = 0; $i < 100; $i++) {
    $username = $faker->userName();
    $email = $faker->email();
    $password = $faker->password();
    $disabled = $faker->numberBetween(0, 1);

    $name = $faker->word();
    $description = $faker->paragraph();
    $category = $faker->randomElement(['télevision', 'papetrie', 'Informatique', 'Mobilier', 'avion']);
    $image = "https://cds.thalesgroup.com/sites/default/files/2023-12/csm_16920180628_fuego_thinkstock_489587e013.png";
    $prix = $faker->randomNumber();
    $stock = $faker->randomNumber();


    $query = $pdo->prepare("INSERT INTO user (Username, Password, Email, Disabled) VALUES (:Username, :Password, :Email, :Disabled)");
    $query->execute([
        'Username' => $username,
        'Email' => $email,
        'Password' => $password,
        'Disabled' => $disabled,
    ]);

    $query = $pdo->prepare("INSERT INTO article (Name, Description, Category, Image, Prix, Stock) VALUES (:Name, :Description, :Category, :Image, :Prix, :Stock)");
    $query->execute([
        'Name' => $name,
        'Description' => $description,
        'Category' => $category,
        'Image' => $image,
        'Prix' => $prix,
        'Stock' => $stock,
    ]);


}

for ($i = 0; $i < 5; $i++) {
    $query = $pdo->prepare("INSERT INTO category (Name) VALUES (:Name)");
        if($i === 0){
            $value = "télevision";
        } else if ($i === 1){
            $value = "papetrie";
        } else if ($i === 2){
            $value = "Informatique";
        } else if ($i === 3){
            $value = "Mobilier";
        } else if ($i === 4){
            $value = "avion";
        }

        $query->execute([
            'Name' => $value,
        ]);
    }
?>