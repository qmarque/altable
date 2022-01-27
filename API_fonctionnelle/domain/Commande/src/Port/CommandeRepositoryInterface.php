<?php

namespace Domain\Commande\Port;

use Domain\Commande\Entity\Commande;

interface CommandeRepositoryInterface {
    public function save(Commande $commande);
    public function findOne(string $uuid): ?Commande;
}