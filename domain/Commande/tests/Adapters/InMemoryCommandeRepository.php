<?php

namespace Domain\Commande\Test\Adapters;

use Domain\Commande\Port\CommandeRepositoryInterface;
use Domain\Commande\Entity\Commande;

class InMemoryCommandeRepository implements commandeRepositoryInterface
{
    public array $commandes = [];

    public function save(Commande $commande) {
        $this->commandes[$commande->uuid] = $commande;
    }

    public function findOne(string $uuid): ?Commande {
        return $this->commandes[$uuid] ?? null;
    }
}