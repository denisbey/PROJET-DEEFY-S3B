<?php

namespace iutnc\deefy\audio\tracks;

class AudioTrack
{
    protected string $titre;
    protected string $genre = "";
    protected int $duree = 0;
    protected string $nomFichier;

    public function __construct(string $titre, string $nomFichier)
    {
        $this->titre = $titre;
        $this->nomFichier = $nomFichier;
    }

    public function __get(string $attrname): mixed
    {
        if (property_exists($this, $attrname)) {
            return $this->$attrname;
        }

        throw new \Exception("invalid property : " . $attrname);
    }

    public function setGenre(string $genre): void
    {
        $this->genre = $genre;
    }

    public function setDuree(int $duree): void
    {
        if ($duree < 0) {
            throw new \Exception("Durée invalide");
        }

        $this->duree = $duree;
    }

    public function __toString(): string
    {
        return json_encode(get_object_vars($this));
    }
}
