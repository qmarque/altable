<?php
namespace Domain\Commande\Entity; 
use PDO;

class Table{
    // Connexion
    private $connexion;
    private $table = "al_table";

    // object properties
    public $id;
    public $nbMaxConvives;
    public $nbConvives;
    public $disponible;
    public $etat;
    public $plan_id;

    /**
     * Constructeur avec $db pour la connexion à la base de données
     *
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }
}