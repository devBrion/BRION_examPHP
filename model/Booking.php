
<?php

namespace Source\model;

use Source\model\Dao;
use PDO;


class Booking
{
    public $NumChambre;
    public $DateDebutReserv;
    public $DateFinReserv;
    public $NumHotel;
    public $CodeCategorie;
    public $CodeClient;
    public $estValide;

    public static function roomReservation()
    {
        $dbh = Dao::openDatabase();
        $query = "INSERT INTO chambre (DateDebutReserv,DateFinReserv,NumHotel,CodeCategorie,CodeClient,estValide) VALUES (:DateDebutReserv,:DateFinReserv,:NumHotel,:CodeCategorie,:CodeClient,false)";
        $sth = $dbh->prepare($query);
        $sth->bindParam(":DateDebutReserv", $this->DateDebutReserv);
        $sth->bindParam(":DateFinReserv", $this->DateFinReserv);
        $sth->bindParam(":NumHotel", $this->NumHotel);
        $sth->bindParam(":CodeCategorie", $this->CodeCategorie);
        $sth->bindParam(":CodeClient", $this->CodeClient);

        $sth->execute();
        Dao::CloseDatabase();
    }
}