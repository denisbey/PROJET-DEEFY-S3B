<?php

namespace iutnc\deefy\audio\lists;

use iutnc\deefy\audio\tracks\AudioTrack;

class Playlist extends AudioList
{
    protected ?int $id = null;

    public function setID(int $id): void
    {
        $this->id = $id;
    }

    public function ajouterPiste(AudioTrack $piste): void
    {
        $this->pistes[] = $piste;
        $this->nombrePistes++;
        $this->dureeTotale += $piste->duree;
    }

    public function supprimerPiste(int $indice): void
    {
        if (isset($this->pistes[$indice])) {
            $this->dureeTotale -= $this->pistes[$indice]->duree;
            unset($this->pistes[$indice]);
            $this->nombrePistes--;
        }
    }

    public function ajouterPistes(array $pistes): void
    {
        foreach ($pistes as $piste) {
            $this->ajouterPiste($piste);
        }
    }
}
