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
}
