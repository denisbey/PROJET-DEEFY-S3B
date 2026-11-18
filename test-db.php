<?php

require_once __DIR__ . '/vendor/autoload.php';

use iutnc\deefy\repository\DeefyRepository;

try {
    DeefyRepository::setConfig(__DIR__ . '/config/deefy.db.ini');

    $repo = DeefyRepository::getInstance();

    $repo->addTrackToPlaylist(5, 10);

    echo "Piste ajoutée à la playlist !\n";


    $track = new \iutnc\deefy\audio\tracks\PodcastTrack(
    "Podcast Test",
    "podcast.mp3"
    );

    $track->setGenre("Podcast");
    $track->setDuree(180);
    $track->setAuteur("Test");
    $track->setDate("2026-11-18");

    $id = $repo->savePodcastTrack($track);

    echo "Piste enregistrée avec ID : " . $id   . "\n";


    $playlist = new \iutnc\deefy\audio\lists\Playlist("Playlist Test");

    $playlist = $repo->saveEmptyPlaylist($playlist);

    echo "Playlist créée : " . $playlist->nom . " (ID : " . $playlist->id . ")\n";

    
    $playlists = $repo->findAllPlaylists();

    foreach ($playlists as $playlist) {
    echo $playlist->id . " - " . $playlist->nom . "\n";
}

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
