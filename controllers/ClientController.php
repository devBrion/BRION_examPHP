<?php

namespace Source\controllers;

use Source\model\Client;
use Source\Router;
use Source\Route;
use Source\View;

class ClientController
{

    public static function route()
    {
        $router = new Router();
        $router->addRoute(new Route("/inscription", "ClientController", "register"));
        $router->addRoute(new Route("/connexion", "ClientController", "connection"));
        $router->addRoute(new Route("/addClient", "ClientController", "addClient"));
        $router->addRoute(new Route("/login", "ClientController", "login"));
        $router->addRoute(new Route("/logout", "ClientController", "logout"));

        $route = $router->findRoute();

        if ($route) {
            $route->execute();
        } else {
            echo "Page Not Found";
        }
    }

    public static function register()
    {
        View::setTemplate('register');
        View::display();
    }

    public static function connection()
    {
        View::setTemplate('connection');
        View::display();
    }

    public static function addClient()
    {
        $client = new client;
        $client->NomClient = $_POST['nom'];
        $client->PrenomClient = $_POST['prenom'];
        $client->AdresseClient = $_POST['adresse'];
        $client->CodePostalClient = $_POST['codepostal'];
        $client->VilleClient = $_POST['ville'];
        $client->PaysClient = $_POST['pays'];
        $client->TelClient = $_POST['telephone'];
        $client->EmailClient = $_POST['email'];
        $client->PasswordClient = $_POST['password'];
        $client->insertClient();

        $_SESSION['client'] = $client;

        $router = new Router();
        $path = $router->getBasePath();
        header("location:{$path}/mesreservations");
    }

    public static function login()
    {
        $login = $_POST['email'];
        $password = $_POST['password'];
        $client = new Client();
        $client = $client->login($login, $password);
        if ($client != null) {
            $_SESSION['client'] = $client;

            if ($_SESSION['client']->RoleClient === "ADMIN_ROLE") {
                $router = new Router();
                $path = $router->getBasePath();
                header("location:{$path}/validerReservations");
            } else if ($_SESSION['client']->RoleClient === "CLIENT_ROLE") {
                $router = new Router();
                $path = $router->getBasePath();
                header("location:{$path}/mesreservations");
            } else {
                echo "page not found";
            }
        } else {
            unset($_SESSION['user']);
            $router = new Router();
            $path = $router->getBasePath();
            header("location:{$path}/");
        }
    }

    public static function logout()
    {
        unset($_SESSION['client']);

        $router = new Router();
        $path = $router->getBasePath();
        header("location:{$path}/");
    }
}
