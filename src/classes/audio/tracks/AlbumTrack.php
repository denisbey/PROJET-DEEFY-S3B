<?php

namespace iutnc\deefy\audio\tracks;

class AlbumTrack extends AudioTrack
{
    protected string $artiste = "";
    protected string $album;
    protected int $annee = 0;
    protected int $numeroPiste;

    public function __construct(
        string $titre,
        string $nomFichier,
        string $album,
        int $numeroPiste
    ) {
        parent::__construct($titre, $nomFichier);

        $this->album = $album;
        $this->numeroPiste = $numeroPiste;
    }

    public function setArtiste(string $artiste): void
    {
        $this->artiste = $artiste;
    }

    public function setAnnee(int $annee): void
    {
        $this->annee = $annee;
    }
}
