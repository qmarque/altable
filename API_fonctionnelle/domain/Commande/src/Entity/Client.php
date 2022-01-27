<?php
namespace Domain\Commande\Entity; 
use PDO;

class Client{
    // Connexion
    private $connexion;
    private $table = "client";

    // object properties
    public $id;
    public $commande_id;

    /**
     * Constructeur avec $db pour la connexion à la base de données
     *
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }
}