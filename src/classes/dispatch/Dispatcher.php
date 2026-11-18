<?php

namespace iutnc\deefy\dispatch;

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
        </head>
        <body>
            <h1>Deefy</h1>

            <nav>
                <a href="index.php?action=default">Accueil</a>
            </nav>

            <main>
                $contenu
            </main>
        </body>
        </html>
        HTML;
    }
}
