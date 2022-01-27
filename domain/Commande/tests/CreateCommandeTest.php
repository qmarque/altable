<?php

use Domain\Commande\UseCase\CreateCommande;
use Domain\Commande\Entity\Commande;
use Domain\Commande\Test\Adapters\InMemoryCommandeRepository;
use Domain\Commande\Test\Adapters\Database;

use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertEquals;

it("should create a commande", function() {
    $repository = new Database;
    
    $useCase = new Commande($repository);

    $commande = $useCase->creer([
        'pourboire' => '4',
        'addition' => '12',
        'al_table_id' => '1',
        'client_id' => '1',
        'restaurateur_id' => '1'
    ]);

    assertInstanceOf(Commande::class, $commande);
    // assertEquals($commande, $repository->findOne($commande->uuid));
});