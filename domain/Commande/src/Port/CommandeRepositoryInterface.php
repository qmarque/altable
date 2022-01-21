<?php

namespace Domain\Commande\Port;

use Domain\Commande\Entity\Commande;

interface commandeRepositoryInterface {
    public function save(Commande $commande);
    public function findOne(string $uuid): ?Commande;
}