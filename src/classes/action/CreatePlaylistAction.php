<?php

namespace iutnc\deefy\action;

use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\repository\DeefyRepository;

class CreatePlaylistAction
{
    public function execute(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return '
                <h2>Créer une playlist</h2>
                <form method="post" action="index.php?action=create-playlist">
                    <label>Nom de la playlist :</label>
                    <input type="text" name="nom" required>
                    <button type="submit">Créer</button>
                </form>
            ';
        }

        $nom = trim($_POST['nom'] ?? '');

        if ($nom === '') {
            return "<p>Le nom de la playlist est obligatoire.</p>";
        }

        $playlist = new Playlist($nom);

        $repository = DeefyRepository::getInstance();
        $repository->saveEmptyPlaylist($playlist);

        return "<p>La playlist " .
            htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') .
            " a été créée avec succès !</p>";
    }
}
