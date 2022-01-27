<?php
class Plat
{
    public $id;
    public $type;
    public $nom;
    public $quantite;
    public $description;
    public $prix;
    public $note;
    public $commentaire;
    public $carte_id;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method))
                $this->$method($value);
        }
    }
}