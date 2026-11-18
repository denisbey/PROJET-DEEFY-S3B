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

}
