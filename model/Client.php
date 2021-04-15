<?php

namespace Source\model;

use Source\model\Dao;
use PDO;


class Client
{
    public $CodeClient;
    public $NomClient;
    public $PrenomClient;
    public $AdresseClient;
    public $CodePostalClient;
    public $VilleClient;
    public $PaysClient;
    public $TelClient;
    public $EmailClient;
    public $PasswordClient;
    public $RoleClient = "CLIENT_ROLE";


    public function insertClient()
    {
        $dbh = Dao::openDatabase();
        $query = "INSERT INTO client (NomClient,PrenomClient,AdresseClient,CodePostalClient,VilleClient,PaysClient,TelClient,EmailClient,PasswordClient,RoleClient) VALUES (:NomClient,:PrenomClient,:AdresseClient,:CodePostalClient,:VilleClient,:PaysClient,:TelClient,:EmailClient,:PasswordClient,:RoleClient)";
        $sth = $dbh->prepare($query);
        $sth->bindParam(":NomClient", $this->NomClient);
        $sth->bindParam(":PrenomClient", $this->PrenomClient);
        $sth->bindParam(":AdresseClient", $this->AdresseClient);
        $sth->bindParam(":CodePostalClient", $this->CodePostalClient);
        $sth->bindParam(":VilleClient", $this->VilleClient);
        $sth->bindParam(":PaysClient", $this->PaysClient);
        $sth->bindParam(":TelClient", $this->TelClient);
        $sth->bindParam(":EmailClient", $this->EmailClient);
        $sth->bindParam(":PasswordClient", $this->PasswordClient);
        $sth->bindParam(":RoleClient", $this->RoleClient);
        $sth->execute();
        Dao::CloseDatabase();
    }

    public static function login(string $login, string $password)
    {
        $dbh = Dao::openDatabase();
        $query = "SELECT * FROM `client` WHERE `EmailClient` = :email AND `PasswordClient` = :password;";
        $sth = $dbh->prepare($query);
        $sth->bindParam(":email", $login);
        $sth->bindParam(":password", $password);
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_CLASS, "Source\\model\\Client");
        $item = $sth->fetch();
        //var_dump($item);
        Dao::closeDatabase();
        return $item;
    }
}
