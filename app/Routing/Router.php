<?php
namespace App\Routing;

class Router {
    public function dispatch() {
        $controllerName = $_GET['controller'] ?? 'cars';
        $actionName = $_GET['action'] ?? 'index';

        $controllerClass = 'App\\Controllers\\' . ucfirst($controllerName) . 'Controller';

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            if (method_exists($controller, $actionName)) {
                $controller->$actionName();
            } else {
                $this->error404("Action '$actionName' nem található.");
            }
        } else {
            $this->error404("Controller '$controllerName' nem található.");
        }
    }

    private function error404($message) {
        http_response_code(404);
        echo "<h1>404 - Nem található</h1><p>$message</p>";
        exit;
    }
}
