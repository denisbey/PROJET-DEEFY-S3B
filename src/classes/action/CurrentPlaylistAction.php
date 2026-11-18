<?php

namespace iutnc\deefy\action;

use iutnc\deefy\render\AudioListRenderer;

class CurrentPlaylistAction
{
    public function execute(): string
    {
        if (!isset($_SESSION['playlist'])) {
            return "<p>Aucune playlist sélectionnée.</p>";
        }

        $playlist = $_SESSION['playlist'];
        $renderer = new AudioListRenderer($playlist);

        return $renderer->render(1);
    }
}
