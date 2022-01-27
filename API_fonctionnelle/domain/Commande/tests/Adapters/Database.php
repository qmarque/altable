<?php

namespace Domain\Commande\Test\Adapters;

use Domain\Commande\Entity\Commande;
use Domain\Commande\Port\CommandeRepositoryInterface;
use PDO;
use PDOException;
use DateTime;

// class PDOCommandeRepository implements CommandeRepositoryInterface {
//     protected PDO $pdo;
    
//     public function __construct()
//     {
//         $this->pdo = new PDO('mysql:host=localhost;dbname=altable_;port=3308','qmarque','qmarque', [
//             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
//         ]);
//     }
    
//     public function save(Commande $commande)
//     {
//         $query = $this->pdo->prepare(
//             'INSERT INTO commande SET
//             title = :title,
//             content = :content,
//             uuid = :uuid'
//         );
//         $query->execute([
//             'title' => $commande->title,
//             'content' => $commande->content,
//             'uuid' => $commande->uuid
//             ]);
//     }

//     public function findOne(string $uuid): ?Commande
//     {
//         $query = $this->pdo->prepare('
//         SELECT c.* FROM commande AS c WHERE c.uuid = :uuid');

//         $query->execute([
//             'uuid' => $uuid
//         ]);

//         $result = $query->fetch(PDO::FETCH_ASSOC);

//         if(!$result) {
//             return null;
//         }

//         $commande = new Commande($result['title'], $result['content'], $result['uuid']);

//         return $commande;
//     }
// }

class Database{
    // Connexion à la base de données
    private $host = "localhost";
    private $db_name = "altable";
    private $username = "qmarque";
    private $password = "qmarque";
    private $port = "3308";
    public $connexion;

    // getter pour la connexion
    public function getConnection(){

        $this->connexion = null;

        try{
            $this->connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name .";port=" . $this->port, $this->username, $this->password);
            $this->connexion->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Erreur de connexion : " . $exception->getMessage();
        }

        return $this->connexion;
    }   
}