<?php

namespace iutnc\deefy\audio\lists;

class AudioList
{
    protected string $nom;
    protected int $nombrePistes = 0;
    protected int $dureeTotale = 0;
    protected array $pistes;

    public function __construct(string $nom, array $pistes = [])
    {
        $this->nom = $nom;
        $this->pistes = $pistes;

        foreach ($pistes as $piste) {
            $this->nombrePistes++;
            $this->dureeTotale += $piste->duree;
        }
    }

    public function __get(string $attrname): mixed
    {
        if (property_exists($this, $attrname)) {
            return $this->$attrname;
        }

        throw new \Exception("invalid property : " . $attrname);
    }
}
