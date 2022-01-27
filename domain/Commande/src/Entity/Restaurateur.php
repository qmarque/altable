<?php
namespace Domain\Commande\Entity; 
use PDO;

class Restaurateur{
    // Connexion
    private $connexion;
    private $table = "restaurateur";

    // object properties
    public $id;
    public $roles;
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