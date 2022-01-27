<?php
namespace Domain\Commande\Entity; 
use PDO;

class Ticket{
    // Connexion
    private $connexion;
    private $table = "ticket";

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