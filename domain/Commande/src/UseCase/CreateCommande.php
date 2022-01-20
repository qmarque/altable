<?php

namespace Domain\Commande\UseCase;

use Domain\Commande\Entity\Commande;
use Domain\Commande\Test\Adapters\InMemoryCommandeRepository;

class CreateCommande
{
    protected InMemoryCommandeRepository $commandeRepository;
    public function __construct(InMemoryCommandeRepository $repository)
    {
        $this->commandeRepository = $repository;
    }

    public function execute(array $postData) : ?Commande {
        $commande = new Commande($postData['title'], $postData['content'], $postData['publishedAt']);
        
        $this->commandeRepository->save($commande);
        
        return $commande;
    }
}