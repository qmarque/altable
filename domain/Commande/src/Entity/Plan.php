<?php
namespace Domain\Commande\Entity; 
use PDO;

class Plan{
    // Connexion
    private $connexion;
    private $table = "plan";

    // object properties
    public $id;
    public $restaurant_id;

    /**
     * Constructeur avec $db pour la connexion à la base de données
     *
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }
}