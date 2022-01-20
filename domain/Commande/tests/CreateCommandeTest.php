<?php

use Domain\Commande\UseCase\CreateCommande;
use Domain\Commande\Entity\Commande;
use function PHPUnit\Framework\assertInstanceOf;

it("should create a post", function() {
    $useCase = new CreateCommande;

    $commande = $useCase->execute([
        'title' => 'Mon titre',
        'content' => 'Mon contenu',
        'publishedAt' => new DateTime()
    ]);

    assertInstanceOf(Commande::class, $commande);
});