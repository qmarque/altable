<?php
namespace Domain\Commande\Entity;

use DateTime;
use DateTimeInterface;

class Commande {
    public string $titile;
    public string $content;
    public string $uuid;

    public function __construct(string $title = '', string $content = '', ?string $uuid = null)
    {
        $this->title = $title;
        $this->content = $content;
        $this->uuid =$uuid ?? uniqid();
    }
}