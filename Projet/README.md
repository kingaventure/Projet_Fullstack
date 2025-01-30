Projet de Julien Groult (eCommerce)

Comment faire pour initier le projet ? 

Avant de commencer

La root du Projet est l'endroit ou ce trouve les dossier Bdd, Documentation, Projet et une fois installé, vendor, c'est ici que vous ferez toute les lignes de commandes

Etape 1 :

Clone le repo dans htdocs et allumé sur Xampp Mysql et Apache

Etape 2 : 

Crée un dossier uploads dans le dossier Projet puis mettez la photo qui ce trouve dans Bdd dans uploads

Etape 3 : 

dans le fichier .env.dist mettez votre mot de passe et votre username à la base de donnée en fonction de ce que vous avez fait vous même, puis renommer le fichier en .env  

Etape 4 : 

Crée une base de donnée nommé "ecommerce_julien"

Etape 5 : 

Importé le base de donnée.sql qui est dans Bdd

Etape 6 :

Initialisé faker php avec cet ligne de commande dans le projet : composer require fakerphp/faker
(il faut comperser déja installé)

Etape 7 :

Rentrer cet ligne : php Bdd/generate_data.php

Etape 8 : 

aller sur votre navigateur et rentrer l'Url : http://localhost/Projet_fullstack/Projet/index.php?component=article