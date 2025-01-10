<?php
require_once 'vendor/autoload.php';

$pdo = new PDO('mysql:host=localhost;dbname=ecommerce_julien', 'root');
$faker = Faker\Factory::create();

for ($i = 0; $i < 100; $i++) {
    $username = $faker->userName();
    $email = $faker->email();
    $password = $faker->password();
    $password = password_hash(`$password`, PASSWORD_DEFAULT, ['cost' => 10]);
    $disabled = $faker->numberBetween(0, 1);

    $name = $faker->word();
    $description = $faker->paragraph();
    $category = $faker->randomElement(['télevision', 'papetrie', 'Informatique', 'Mobilier', 'avion']);
    $image = $faker->randomElement(["https://cds.thalesgroup.com/sites/default/files/2023-12/csm_16920180628_fuego_thinkstock_489587e013.png", "https://letsenhance.io/static/8f5e523ee6b2479e26ecc91b9c25261e/1015f/MainAfter.jpg", 'https://assets.zyrosite.com/cdn-cgi/image/format=auto,w=1920,fit=crop/YD04QOJ93VCzWj6J/macro-eye-iris_23-2151618644-AGB4DQ180oswOLj4.jpg', 'https://emotions-numeriques.com/wp-content/uploads/2018/10/fleur-2.jpg', 'https://st.depositphotos.com/1057668/4156/i/450/depositphotos_41568091-stock-photo-seljalandfoss-waterfall.jpg']); ;
    $prix = $faker->randomNumber();
    $stock = $faker->randomNumber();


    $query = $pdo->prepare("INSERT INTO user (username, password, email, enabled) VALUES (:Username, :Password, :Email, :Disabled)");
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