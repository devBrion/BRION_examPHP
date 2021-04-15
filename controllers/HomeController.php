<?php

namespace Source\controllers;

use Source\Router;
use Source\Route;
use Source\View;

class HomeController
{

    public static function route()
    {
        $router = new Router();
        $router->addRoute(new Route("/", "HomeController", "home"));
        $router->addRoute(new Route("/accueil", "HomeController", "home"));
        
        $route = $router->findRoute();

        if ($route) {
            $route->execute();
        } else {
            echo "Page Not Found";
        }
    }

    public static function home()
    {
        View::setTemplate('home');
        View::display();
    }


   
}
