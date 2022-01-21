<?php

namespace Domain\Commande\UseCase;

use Domain\Commande\Port\CommandeRepositoryInterface;
use Domain\Commande\Entity\Commande;

class CreateCommande
{
    protected CommandeRepositoryInterface $commandeRepository;
    public function __construct(CommandeRepositoryInterface $repository)
    {
        $this->commandeRepository = $repository;
    }

    public function execute(array $postData) : ?Commande {
        $commande = new Commande($postData['title'], $postData['content']);
        
        $this->commandeRepository->save($commande);

        return $commande;
    }
}