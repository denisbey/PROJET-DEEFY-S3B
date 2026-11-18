<?php

require_once __DIR__ . '/vendor/autoload.php';

session_start();

use iutnc\deefy\repository\DeefyRepository;
use iutnc\deefy\dispatch\Dispatcher;

DeefyRepository::setConfig(__DIR__ . '/config/deefy.db.ini');

$dispatcher = new Dispatcher();
$dispatcher->renderPage();
