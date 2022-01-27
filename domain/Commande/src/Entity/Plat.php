<?php
namespace Domain\Commande\Entity; 
use PDO;
class Plat{
    // Connexion
    private $connexion;
    private $table = "plat";

    // object properties
    public $id;
    public $type;
    public $nom;
    public $quantite;
    public $description;
    public $prix;
    public $note;
    public $commentaire;
    public $carte_id;

    /**
     * Constructeur avec $db pour la connexion à la base de données
     *
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }

    /**
     * Lecture des cartes
     *
     * @return void
     */
    public function lire(){
        // On écrit la requête
        $sql = "SELECT * FROM " . $this->table;

        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // On exécute la requête
        $query->execute();

        // On retourne le résultat
        return $query;
    }

    /**
     * Lecture des cartes
     *
     * @return void
     */
    public function lireCarte(){
        // On écrit la requête
        $sql = "SELECT * FROM " . $this->table . " WHERE quantite > 0";

        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // On exécute la requête
        $query->execute();

        // On retourne le résultat
        return $query;
    }

    /**
     * Créer une carte
     *
     * @return void
     */
    public function creer(){

        // Ecriture de la requête SQL en y insérant le nom de la table
        $sql = "INSERT INTO " . $this->table . " SET type=:type, nom=:nom, quantite=:quantite, description=:description, prix=:prix, note=:note,
        commentaire=:commentaire, carte_id=:carte_id";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);

        // Protection contre les injections
        $this->type=htmlspecialchars(strip_tags($this->type));
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->quantite=htmlspecialchars(strip_tags($this->quantite));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->prix=htmlspecialchars(strip_tags($this->prix));
        $this->note=htmlspecialchars(strip_tags($this->note));
        $this->commentaire=htmlspecialchars(strip_tags($this->commentaire));
        $this->carte_id=htmlspecialchars(strip_tags($this->carte_id));


        // Ajout des données protégées
        $query->bindParam(":type", $this->type);
        $query->bindParam(":nom", $this->nom);
        $query->bindParam(":quantite", $this->quantite);
        $query->bindParam(":description", $this->description);
        $query->bindParam(":prix", $this->prix);
        $query->bindParam(":note", $this->note);
        $query->bindParam(":commentaire", $this->commentaire);
        $query->bindParam(":carte_id", $this->carte_id);

        // Exécution de la requête
        if($query->execute()){
            return true;
        }
        return false;
    }

    /**
     * Lire un produit
     *
     * @return void
     */
    public function lireUn(){
        // On écrit la requête
        $sql = "SELECT c.nom as categories_nom, p.id, p.nom, p.description, p.prix, p.categories_id, p.created_at FROM " . $this->table . " p LEFT JOIN categories c ON p.categories_id = c.id WHERE p.id = ? LIMIT 0,1";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On attache l'id
        $query->bindParam(1, $this->id);

        // On exécute la requête
        $query->execute();

        // on récupère la ligne
        $row = $query->fetch(PDO::FETCH_ASSOC);

        // On hydrate l'objet
        $this->nom = $row['nom'];
        $this->prix = $row['prix'];
        $this->description = $row['description'];
        $this->categories_id = $row['categories_id'];
        $this->categories_nom = $row['categories_nom'];
    }

    /**
     * Supprimer un produit
     *
     * @return void
     */
    public function supprimer(){
        // On écrit la requête
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On sécurise les données
        $this->id=htmlspecialchars(strip_tags($this->id));

        // On attache l'id
        $query->bindParam(1, $this->id);

        // On exécute la requête
        if($query->execute()){
            return true;
        }
        
        return false;
    }

    /**
     * Mettre à jour un produit
     *
     * @return void
     */
    public function modifier(){
        // On écrit la requête
        $sql = "UPDATE " . $this->table . " SET type=:type, nom=:nom, quantite=:quantite, description=:description, prix=:prix, note=:note,
        commentaire=:commentaire, carte_id=:carte_id WHERE id = :id";
        
        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // Protection contre les injections
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->quantite = htmlspecialchars(strip_tags($this->quantite));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->prix = htmlspecialchars(strip_tags($this->prix));
        $this->note = htmlspecialchars(strip_tags($this->note));
        $this->commentaire = htmlspecialchars(strip_tags($this->commentaire));
        $this->carte_id = htmlspecialchars(strip_tags($this->carte_id));
        $this->id = htmlspecialchars(strip_tags($this->id));



        // Ajout des données protégées
        $query->bindParam(":type", $this->type);
        $query->bindParam(":nom", $this->nom);
        $query->bindParam(":quantite", $this->quantite);
        $query->bindParam(":description", $this->description);
        $query->bindParam(":prix", $this->prix);
        $query->bindParam(":note", $this->note);
        $query->bindParam(":commentaire", $this->commentaire);
        $query->bindParam(":carte_id", $this->carte_id);
        $query->bindParam(':id', $this->id);
        
        // On exécute
        if($query->execute()){
            return true;
        }
        
        return false;
    }

}