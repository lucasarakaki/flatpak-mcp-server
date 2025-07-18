<?php

declare(strict_types = 1);

date_default_timezone_set('America/Sao_Paulo');

require_once __DIR__.'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = require_once __DIR__.'/config/server.php';
