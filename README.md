# PROJET-DEEFY-S3B

Mini-projet Deefy - BUT Informatique S3

Projet réalisé en binôme dans le cadre du cours de développement web.

## Présentation

Deefy est une application web développée en PHP permettant de gérer des playlists et des pistes audio.

Le projet utilise la programmation orientée objet, les sessions PHP et une base de données MySQL avec PDO.

## Fonctionnalités réalisées

- Afficher les playlists enregistrées dans la base de données.
- Sélectionner une playlist et afficher ses pistes.
- Conserver la playlist courante dans une session PHP.
- Ajouter un podcast à la playlist courante.
- Créer une nouvelle playlist vide.
- Afficher la playlist courante.

## Technologies utilisées

- PHP 8
- HTML et CSS
- MySQL / MariaDB
- PDO
- Composer avec autoload PSR-4
- Sessions PHP

## Installation

1. Cloner le dépôt GitHub :

   `git clone https://github.com/denisbey/PROJET-DEEFY-S3B.git`

2. Se placer dans le dossier du projet :

   `cd PROJET-DEEFY-S3B`

3. Installer les dépendances avec Composer :

   `composer install`

4. Démarrer MySQL avec XAMPP.

5. Créer une base de données nommée `deefy` dans phpMyAdmin.

6. Importer le script SQL fourni par le professeur.

7. Créer un dossier `config` contenant le fichier `deefy.db.ini` avec les paramètres de connexion à la base de données :

   ```ini
   host = "localhost"
   database = "deefy"
   username = "root"
   password = ""
   ```

   Ces paramètres sont des exemples pour une installation locale XAMPP.

## Lancement

Depuis le dossier du projet, lancer le serveur PHP :

`php -S localhost:8000`

Si PHP n'est pas dans le PATH sous Windows avec XAMPP :

`C:\xampp\php\php.exe -S localhost:8000`

Ouvrir ensuite dans le navigateur :

`http://localhost:8000/index.php`

## Organisation du projet

- `index.php` : point d'entrée de l'application.
- `src/classes/action/` : actions de l