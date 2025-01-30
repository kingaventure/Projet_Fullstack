<?php
require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../Projet');
$dotenv->load();
require 'Projet/includes/database.php';
$faker = Faker\Factory::create();

// Insert categories
$categories = ['télevision', 'papetrie', 'Informatique', 'Mobilier', 'avion'];
foreach ($categories as $category) {
    $query = $pdo->prepare("INSERT INTO category (category_name) VALUES (:category_name)");
    $query->execute(['category_name' => $category]);
}

// Always create an admin user
$adminPassword = password_hash('admin', PASSWORD_DEFAULT, ['cost' => 10]);
$query = $pdo->prepare("INSERT INTO user (username, password, email, enabled) VALUES (:username, :password, :email, :enabled)");
$query->execute([
    'username' => 'admin',
    'password' => $adminPassword,
    'email' => 'admin@example.com',
    'enabled' => 1,
]);

// Insert users and articles
for ($i = 0; $i < 100; $i++) {
    $username = $faker->userName();
    $email = $faker->email();
    $password = $faker->password();
    $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
    $disabled = $faker->numberBetween(0, 1);

    $name = $faker->word();
    $description = $faker->paragraph();
    $category = mt_rand(1, 5); // Random number between 1 and 5
    $image = "6799fcaa9eb6d.jpg";
    $prix = $faker->randomNumber();
    $stock = $faker->randomNumber();

    $query = $pdo->prepare("INSERT INTO user (username, password, email, enabled) VALUES (:username, :password, :email, :enabled)");
    $query->execute([
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'enabled' => $disabled,
    ]);

    $query = $pdo->prepare("INSERT INTO article (name, description, category_id, image, prix, stock) VALUES (:name, :description, :category_id, :image, :prix, :stock)");
    $query->execute([
        'name' => $name,
        'description' => $description,
        'category_id' => $category,
        'image' => $image,
        'prix' => $prix,
        'stock' => $stock,
    ]);
}

// Insert promotions
for ($i = 0; $i < 50; $i++) {
    $article_id = mt_rand(1, 100);
    $reduction = mt_rand(2, 70);

    // Current date/time as start date
    $start_date = date("Y-m-d\TH:i");

    // Faker: any time from now to +1 year
    $end_date = $faker
        ->dateTimeBetween('now', '+1 year')
        ->format("Y-m-d\TH:i");

    $query = $pdo->prepare("INSERT INTO promotion (article_id, reduction, start, end) VALUES (:article_id, :reduction, :start, :end)");
    $query->execute([
        'article_id' => $article_id,
        'reduction' => $reduction,
        'start' => $start_date,
        'end' => $end_date,
    ]);
}
?>