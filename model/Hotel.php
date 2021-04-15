<?php

namespace Source\model;

use Source\model\Dao;
use PDO;


class Hotel
{
    public $NumHotel;
    public $NomHotel;
    public $AdresseHotel;
    public $CodePostalHotel;
    public $VilleHotel;
    public $TelHotel;

    public static function listHotel()
    {
        $dbh = Dao::openDatabase();
        $query = "SELECT * FROM `hotel`;";
        $sth = $dbh->prepare($query);
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_CLASS, "Source\\model\\Hotel");
        $items = $sth->fetchAll();
        Dao::CloseDatabase();
        return $items;
    }
}