<?php
namespace Domain\Commande\Entity;

use DateTime;
use DateTimeInterface;

class Commande {
    public string $titile;
    public string $content;
    public string $uuid;
    public DateTime $publishedAt;

    public function __construct(string $title = '', string $content = '', ?DateTimeInterface $publishedAt = null, ?string $uuid = null)
    {
        $this->title = $title;
        $this->content = $content;
        $this->publisedAt = $publishedAt;
        $this->uuid =$uuid ?? uniqid();
    }
}