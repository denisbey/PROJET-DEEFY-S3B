<?php

namespace iutnc\deefy\render;

use iutnc\deefy\audio\lists\AudioList;

class AudioListRenderer implements Renderer
{
    protected AudioList $liste;

    public function __construct(AudioList $liste)
    {
        $this->liste = $liste;
    }

    public function render(int $selector): string
    {
        $nom = htmlspecialchars($this->liste->nom);
        $html = "<h2>" . $nom . "</h2>";

        foreach ($this->liste->pistes as $piste) {
            $titre = htmlspecialchars($piste->titre);
            $html .= "<p>" . $titre . "</p>";
        }

        $html .= "<p>Nombre de pistes : " . $this->liste->nombrePistes . "</p>";
        $html .= "<p>Durée totale : " . $this->liste->dureeTotale . " secondes</p>";

        return $html;
    }
}
