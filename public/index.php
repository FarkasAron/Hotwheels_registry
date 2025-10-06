<?php
// Konfiguráció betöltése
require_once __DIR__ . '/../config/config.php';

// Autoload – egyszerűbb megoldás, hogy ne kelljen minden fájlt kézzel include-olni
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../App/';

    // Ellenőrizzük, hogy a névtér az App\ kezdetű-e
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Osztálynév → fájl elérési út
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Router indítása
use App\Routing\Router;

$router = new Router();
$router->dispatch();
