<?php

require_once __DIR__ . '/vendor/autoload.php';

use iutnc\deefy\repository\DeefyRepository;

try {
    DeefyRepository::setConfig(__DIR__ . '/config/deefy.db.ini');

    $repo = DeefyRepository::getInstance();

    echo "Connexion à la base de données réussie !";

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
