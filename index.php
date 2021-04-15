<?php

namespace Source;


// Chargement automatique des classes
require_once "vendor/autoload.php";

// début de l'application web
session_start();

$router = new Router();
$router->addRoute(new Route("/", "HomeController"));
$router->addRoute(new Route("/accueil", "HomeController"));
$router->addRoute(new Route("/inscription", "ClientController"));
$router->addRoute(new Route("/addClient", "ClientController"));
$router->addRoute(new Route("/connexion", "ClientController"));
$router->addRoute(new Route("/login", "ClientController"));
$router->addRoute(new Route("/logout", "ClientController"));
$router->addRoute(new Route("/reserver", "BookingController"));
$router->addRoute(new Route("/reserver/{NumHotel}", "BookingController"));
$router->addRoute(new Route("/addBooking", "BookingController"));
$router->addRoute(new Route("/mesreservations", "BookingController"));
$router->addRoute(new Route("/validerReservations", "BookingController"));




$route = $router->findRoute();

if ($route) {
    $route->execute();
} else {
    echo "Page Not Found";
}
