<?php

namespace Source\controllers;

use Source\Router;
use Source\Route;
use Source\View;
use Source\model\Hotel;
use Source\model\Booking;

class BookingController
{

    public static function route()
    {
        $router = new Router();
        $router->addRoute(new Route("/reserver", "BookingController", "addBooking"));
        $router->addRoute(new Route("/reserver/{NumHotel}", "BookingController", "roomBooking"));
        $router->addRoute(new Route("/addBooking", "BookingController", "Booking"));
        $router->addRoute(new Route("/mesreservations", "BookingController", "listBooking"));
        $router->addRoute(new Route("/validerReservations", "BookingController", "validateBooking"));


        $route = $router->findRoute();

        if ($route) {
            $route->execute();
        } else {
            echo "Page Not Found";
        }
    }

    public static function addBooking()
    {
        $hotels = Hotel::listHotel();

        View::setTemplate('addBooking');
        View::bindVariable("hotels", $hotels);
        View::display();
    }

    public static function roomBooking($NumHotel)
    {
        //var_dump($NumHotel);

        View::setTemplate('roomBooking');
        View::display();
    }

    public static function Booking()
    {
        //var_dump($_POST);
       
        $booking = new Booking;
        $booking->CodeClient=$_SESSION['client']->CodeClient;
        $booking->DateDebutReserv = $_POST['dateDebut'];
        $booking->DateFinReserv = $_POST['dateFin'];
        $booking->CodeCategorie = $_POST['categorie'];
        $booking->roomReservation();

        $router = new Router();
        $path = $router->getBasePath();
        header("location:{$path}/mesreservations");

      
    }


    public static function listBooking()
    {
        View::setTemplate('listBooking');
        View::display();
    }

    public static function validateBooking()
    {
        View::setTemplate('validateBooking');
        View::display();
    }
}
