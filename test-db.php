<?php

require_once __DIR__ . '/vendor/autoload.php';

use iutnc\deefy\repository\DeefyRepository;

try {
    DeefyRepository::setConfig(__DIR__ . '/config/deefy.db.ini');

    $repo = DeefyRepository::getInstance();

    
    $playlists = $repo->findAllPlaylists();

    foreach ($playlists as $playlist) {
    echo $playlist->id . " - " . $playlist->nom . "\n";
}


} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
