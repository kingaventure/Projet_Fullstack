Projet de Julien Groult (eCommerce)

Comment initier le projet ?

Avant de commencer

La racine du projet est l'endroit où se trouvent les dossiers Bdd, Documentation, Projet et, une fois installé, vendor. C'est ici que vous exécuterez toutes les lignes de commande.

Étapes d'installation

Étape 1 :

Clonez le dépôt dans htdocs et démarrez MySQL et Apache sur XAMPP.

Étape 2 :

Créez un dossier uploads dans le dossier Projet, puis mettez la photo qui se trouve dans Bdd dans uploads.

Étape 3 :

Dans le fichier .env.dist, mettez votre mot de passe et votre nom d'utilisateur pour la base de données en fonction de ce que vous avez configuré, puis renommez le fichier en .env.

Étape 4 :

Créez une base de données nommée ecommerce_julien.

Étape 5 :

Importez le fichier base_de_donnee.sql qui se trouve dans Bdd.

Étape 6 :

Initialisez Faker PHP avec ces ligne de commandes dans le projet :

composer install

composer require fakerphp/faker

Étape 7 :

Exécutez cette ligne de commande :

php Bdd/generate_data.php

Étape 8 :

Allez sur votre navigateur et entrez l'URL :

http://localhost/Projet_fullstack/Projet/index.php?component=article

Étape 9 :

Pour passer l'écran de login, le nom d'utilisateur et le mot de passe sont : admin.

Fonctionnalités

Inscription et authentification des utilisateurs

Ajout, modification et suppression de produits

Gestion du panier et des commandes

Paiement sécurisé

Interface administrateur pour la gestion du site

Technologies utilisées

Front-end : HTML, CSS, JavaScript

Back-end : PHP

Base de données : MySQL

Contribuer

Les contributions sont les bienvenues ! Merci de soumettre une pull request avec vos modifications.

Licence

Ce projet est sous licence MIT.

