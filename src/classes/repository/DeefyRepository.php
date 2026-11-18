<?php

namespace iutnc\deefy\repository;

use PDO;

class DeefyRepository
{
    private PDO $pdo;
    private static ?DeefyRepository $instance = null;
    private static array $config = [];

    private function __construct(array $conf)
    {
        $dsn = "mysql:host=" . $conf['host'] .
            ";dbname=" . $conf['database'] . ";charset=utf8";

        $this->pdo = new PDO(
            $dsn,
            $conf['username'],
            $conf['password'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    public static function setConfig(string $file): void
    {
        $conf = parse_ini_file($file);

        if ($conf === false) {
            throw new \Exception("Erreur de lecture du fichier de configuration");
        }

        self::$config = $conf;
    }

    public static function getInstance(): DeefyRepository
    {
        if (self::$instance === null) {
            self::$instance = new DeefyRepository(self::$config);
        }

        return self::$instance;
    }


    public function findAllPlaylists(): array
    {
    $query = "SELECT id, nom FROM playlist";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute();

    $playlists = [];

    while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $playlist = new \iutnc\deefy\audio\lists\Playlist($ligne['nom']);
        $playlist->setID((int) $ligne['id']);

        $playlists[] = $playlist;
    }

    return $playlists;
    }   

    public function saveEmptyPlaylist(\iutnc\deefy\audio\lists\Playlist $playlist): \iutnc\deefy\audio\lists\Playlist
    {
    $query = "INSERT INTO playlist (nom) VALUES (:nom)";

    $stmt = $this->pdo->prepare($query);
    $stmt->execute([
        'nom' => $playlist->nom
    ]);

    $playlist->setID((int) $this->pdo->lastInsertId());

    return $playlist;
    }


    public function savePodcastTrack(\iutnc\deefy\audio\tracks\PodcastTrack $track): int
    {
    $query = "INSERT INTO track
        (titre, genre, duree, filename, type, auteur_podcast, date_posdcast)
        VALUES
        (:titre, :genre, :duree, :filename, :type, :auteur, :date)";

    $stmt = $this->pdo->prepare($query);

    $stmt->execute([
        'titre' => $track->titre,
        'genre' => $track->genre,
        'duree' => $track->duree,
        'filename' => $track->nomFichier,
        'type' => 'P',
        'auteur' => $track->auteur,
        'date' => $track->date
    ]);

    return (int) $this->pdo->lastInsertId();
    }
    
    public function addTrackToPlaylist(int $idPlaylist, int $idTrack): void
    {
    $query = "SELECT COALESCE(MAX(no_piste_dans_liste), 0) + 1
              FROM playlist2track
              WHERE id_pl = :idPlaylist";

    $stmt = $this->pdo->prepare($query);
    $stmt->execute([
        'idPlaylist' => $idPlaylist
    ]);

    $numero = (int) $stmt->fetchColumn();

    $query = "INSERT INTO playlist2track
              (id_pl, id_track, no_piste_dans_liste)
              VALUES (:idPlaylist, :idTrack, :numero)";

    $stmt = $this->pdo->prepare($query);
    $stmt->execute([
        'idPlaylist' => $idPlaylist,
        'idTrack' => $idTrack,
        'numero' => $numero
    ]);
    }
}
