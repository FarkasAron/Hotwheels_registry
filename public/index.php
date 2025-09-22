<?php
// Composer autoload (ha használsz)
require_once __DIR__ . '/../vendor/autoload.php';

// Konfiguráció betöltése
require_once __DIR__ . '/../config/config.php';

// Router betöltése
use App\Routing\Router;

$router = new Router();
$router->dispatch();
