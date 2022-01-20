<?php

use Domain\Commande\UseCase\CreateCommande;
use Domain\Commande\Entity\Commande;
use Domain\Commande\Test\Adapters\InMemoryCommandeRepository;


use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertEquals;

it("should create a commande", function() {
    $repository = new InMemoryCommandeRepository;
    
    $useCase = new CreateCommande($repository);

    $commande = $useCase->execute([
        'title' => 'Mon titre',
        'content' => 'Mon contenu',
        'publishedAt' => new DateTime()
    ]);

    assertInstanceOf(Commande::class, $commande);
    assertEquals($commande, $repository->findOne($commande->uuid));
});