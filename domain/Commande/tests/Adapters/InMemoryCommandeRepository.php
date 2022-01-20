<?php

namespace Domain\Commande\Test\Adapters;

use Domain\Commande\Entity\Commande;
class InMemoryCommandeRepository
{
    public array $commandes = [];

    public function save(Commande $commande): Commande {
        $this->commandes[$commande->uuid] = $commande;

        return $commande;
    }

    public function findOne(string $uuid): ?Commande {
        return $this->commandes[$uuid] ?? null;
    }
}