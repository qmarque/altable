<?php

namespace Domain\Commande\Test\Adapters;

use Domain\Commande\Entity\Commande;
use Domain\Commande\Port\CommandeRepositoryInterface;
use PDO;
use DateTime;

class PDOCommandeRepository implements CommandeRepositoryInterface {
    protected PDO $pdo;
    
    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=altable;port=3308','qmarque','qmarque', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
    
    public function save(Commande $commande)
    {
        $query = $this->pdo->prepare(
            'INSERT INTO commande SET
            title = :title,
            content = :content,
            uuid = :uuid'
        );
        $query->execute([
            'title' => $commande->title,
            'content' => $commande->content,
            'uuid' => $commande->uuid
            ]);
    }

    public function findOne(string $uuid): ?Commande
    {
        $query = $this->pdo->prepare('
        SELECT c.* FROM commande AS c WHERE c.uuid = :uuid');

        $query->execute([
            'uuid' => $uuid
        ]);

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if(!$result) {
            return null;
        }

        $commande = new Commande($result['title'], $result['content'], $result['uuid']);

        return $commande;
    }
}