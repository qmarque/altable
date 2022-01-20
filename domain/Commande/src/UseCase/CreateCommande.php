<?php

namespace Domain\Commande\UseCase;

use Domain\Commande\Entity\Commande;

class CreateCommande
{
    public function execute(array $postData) : ?Commande {
        $commande = new Commande($postData['title'], $postData['content'], $postData['publishedAt']);
        
        return $commande;
    }
}