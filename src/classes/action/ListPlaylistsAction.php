<?php

namespace iutnc\deefy\action;

use iutnc\deefy\repository\DeefyRepository;

class ListPlaylistsAction
{
    public function execute(): string
    {
        $repo = DeefyRepository::getInstance();
        $playlists = $repo->findAllPlaylists();

        $html = "<h2>Mes playlists</h2>";

        
        foreach ($playlists as $playlist) {
            $nom = htmlspecialchars($playlist->nom);
            $id = $playlist->id;

            $html .= "<p><a href='index.php?action=show-playlist&id=$id'>$nom</a></p>";
}


        return $html;
    }
}
