<?php

namespace iutnc\deefy\action;

use iutnc\deefy\repository\DeefyRepository;
use iutnc\deefy\render\AudioListRenderer;

class ShowPlaylistAction
{
    public function execute(): string
    {
        $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);

        if ($id === false || $id === null || $id < 1) {
            return "<p>Identifiant de playlist invalide.</p>";
        }

        $repo = DeefyRepository::getInstance();
        $playlist = $repo->findPlaylistById($id);

        if ($playlist === null) {
            return "<p>Playlist introuvable.</p>";
        }

        $_SESSION['playlist'] = $playlist;

        $renderer = new AudioListRenderer($playlist);

        return $renderer->render(1);
    }
}
