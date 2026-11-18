<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action\ListPlaylistsAction;
use iutnc\deefy\action\ShowPlaylistAction;
use iutnc\deefy\action\CurrentPlaylistAction;
use iutnc\deefy\action\CreatePlaylistAction;
use iutnc\deefy\action\AddTrackAction;

class Dispatcher
{
    private string $action;

    public function __construct()
    {
        $this->action = $_GET['action'] ?? 'default';
    }

    public function run(): string
    {
        switch ($this->action) {
            case 'default':
                return "<h2>Bienvenue sur Deefy !</h2>";

            case 'list-playlists':
                $action = new ListPlaylistsAction();
                return $action->execute();

            case 'show-playlist':
                $action = new ShowPlaylistAction();
                return $action->execute();

            case 'current-playlist':
                $action = new CurrentPlaylistAction();
                return $action->execute();

            case 'create-playlist':
                $action = new CreatePlaylistAction();
                return $action->execute();

            case 'add-track':
                $action = new AddTrackAction();
                return $action->execute();

            default:
                return "<p>Action inconnue</p>";
        }
    }

    public function renderPage(): void
    {
        $contenu = $this->run();

        echo <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Deefy</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <h1>Deefy</h1>

            <nav>
                <a href="index.php?action=default">Accueil</a>
                <a href="index.php?action=list-playlists">Mes playlists</a>
                <a href="index.php?action=current-playlist">Playlist courante</a>
                <a href="index.php?action=create-playlist">Créer une playlist</a>
                <a href="index.php?action=add-track">Ajouter un podcast</a>
            </nav>

            <main>
                $contenu
            </main>
        </body>
        </html>
        HTML;
    }
}
