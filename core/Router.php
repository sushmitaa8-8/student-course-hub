<?php

class Router {

    protected $routes = [];

    public function get($page, $controller, $method) {
        $this->routes[] = [
            'method'     => 'GET',
            'page'       => $page,
            'controller' => $controller,
            'action'     => $method
        ];
    }

    public function post($page, $controller, $method) {
        $this->routes[] = [
            'method'     => 'POST',
            'page'       => $page,
            'controller' => $controller,
            'action'     => $method
        ];
    }

    public function dispatch($requestMethod) {

        // Read the page from the URL, default to 'home'
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';

        // Loop through all registered routes
        foreach ($this->routes as $route) {

            if ($route['method'] == strtoupper($requestMethod)
                && $route['page'] == $page) {

                $controllerName = $route['controller'];
                $action         = $route['action'];

                // Load the controller file
                require_once __DIR__ . '/../app/controllers/' . $controllerName . '.php';

                // Create the controller and call the method
                $obj = new $controllerName();
                $obj->$action();
                return;
            }
        }

        // Nothing matched
        http_response_code(404);
        echo '<h1>404 - Page not found</h1>';
    }
}