<?php

namespace Domain\Commande\UseCase;

use Domain\Commande\Port\CommandeRepositoryInterface;
use Domain\Commande\Entity\Commande;
use Domain\Commande\Test\Adapters\Database;

// class CreateCommande
// {
//     protected CommandeRepositoryInterface $commandeRepository;
//     public function __construct(CommandeRepositoryInterface $repository)
//     {
//         $this->commandeRepository = $repository;
//     }

//     public function execute(array $postData) : ?Commande {
//         $commande = new Commande($postData['title'], $postData['content']);
        
//         $this->commandeRepository->save($commande);

//         return $commande;
//     }
// }

// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// On vérifie la méthode
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // On inclut les fichiers de configuration et d'accès aux données


    include_once '..\..\tests\Adapters\Database.php';
    include_once '..\Entity\Commande.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les produits
    $commande = new Commande($db);

    // On récupère les informations envoyées
    $donnees = json_decode(file_get_contents("php://input"));
    
    // if(!empty($donnees->pourboire) && !empty($donnees->addition) && !empty($donnees->al_table_id) && !empty($donnees->client_id) && !empty($donnees->restaurateur_id) && !empty($donnees->service_id) && !empty($donnees->nbConvives)){
        // Ici on a reçu les données
        // On hydrate notre objet

        $commande->pourboire = $donnees->pourboire;
        $commande->addition = $donnees->addition;
        $commande->al_table_id = $donnees->al_table_id;
        $commande->client_id = $donnees->client_id;
        $commande->restaurateur_id = $donnees->restaurateur_id;
        $commande->service_id = $donnees->service_id;

        if($commande->creer($donnees->nbConvives)){
            // Ici la création a fonctionné
            // On envoie un code 201
            http_response_code(201);
            echo json_encode(["message" => "L'ajout a été effectué"]);
        }else{
            // Ici la création n'a pas fonctionné
            // On envoie un code 503
            http_response_code(503);
            echo json_encode(["message" => "L'ajout n'a pas été effectué"]);         
        }
    // }
}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}