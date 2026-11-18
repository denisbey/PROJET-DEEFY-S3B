<?php

namespace iutnc\deefy\action;

use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\repository\DeefyRepository;

class AddTrackAction
{
    public function execute(): string
    {
        if (!isset($_SESSION['playlist']) ||
            !($_SESSION['playlist'] instanceof Playlist)) {
            return "<p>Aucune playlist sélectionnée.</p>";
        }

        $idPlaylist = $_SESSION['playlist']->id;

        if ($idPlaylist === null) {
            return "<p>Playlist non enregistrée.</p>";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return '
                <h2>Ajouter un podcast</h2>

                <form method="post" action="index.php?action=add-track">
                    <label>Titre :</label>
                    <input type="text" name="titre" required><br>

                    <label>Fichier audio :</label>
                    <input type="text" name="fichier" required><br>

                    <label>Genre :</label>
                    <input type="text" name="genre"><br>

                    <label>Durée en secondes :</label>
                    <input type="number" name="duree" min="0" required><br>

                    <label>Auteur :</label>
                    <input type="text" name="auteur" required><br>

                    <label>Date :</label>
                    <input type="date" name="date" required><br>

                    <button type="submit">Ajouter</button>
                </form>
            ';
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return "<p>Méthode non autorisée.</p>";
        }

        $titre = trim($_POST['titre'] ?? '');
        $fichier = trim($_POST['fichier'] ?? '');
        $genre = trim($_POST['genre'] ?? '');

        $duree = filter_var(
            $_POST['duree'] ?? null,
            FILTER_VALIDATE_INT
        );

        $auteur = trim($_POST['auteur'] ?? '');
        $date = trim($_POST['date'] ?? '');

        if ($titre === '' || $fichier === '' ||
            $duree === false || $duree === null ||
            $duree < 0 || $auteur === '' ||
            $date === '') {
            return "<p>Informations invalides.</p>";
        }

        $podcast = new PodcastTrack($titre, $fichier);

        $podcast->setGenre($genre);
        $podcast->setDuree($duree);
        $podcast->setAuteur($auteur);
        $podcast->setDate($date);

        $repository = DeefyRepository::getInstance();

        $idTrack = $repository->savePodcastTrack($podcast);

        $repository->addTrackToPlaylist(
            $idPlaylist,
            $idTrack
        );

        $_SESSION['playlist']->ajouterPiste($podcast);

        return "<p>Podcast ajouté à la playlist avec succès !</p>";
    }
}
