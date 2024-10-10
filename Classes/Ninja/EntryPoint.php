<?php
namespace Ninja;

class Entrypoint {
    private $route;
    private $method;
    private $routes;

    public function __construct(string $route, $method, Routes $routes) 
    {
        $this->route= $route;
        $this->method= $method;
        $this->routes= $routes;
    }

    private function loadTemplate($template, $variables=[]) {
        extract($variables);
        ob_start();
        include __DIR__ . '/../../templates/' . $template;

        return ob_get_clean();
    }

    public function run() {
        $routes= $this->routes->getRoutes();
        $authentication= $this->routes->getAuthentication();

        if(isset($routes[$this->route]['login']) && !$authentication->isLoggedIn()) {
            header('Location:/error');
        } else {
            $controller= $routes[$this->route][$this->method]['controller'];
            $action= $routes[$this->route][$this->method]['action'];
    
            $page= $controller->$action();
            $title= $page['title'];
    
            if(isset($page['variables'])) {
                $output= $this->loadTemplate($page['template'], $page['variables']);
            } else {
                $output= $this->loadTemplate($page['template']);
            }
    
            include __DIR__ . '/../../templates/layout.html.php';

           //echo $this->loadTemplate('layout.html.php');
        }

    }
}