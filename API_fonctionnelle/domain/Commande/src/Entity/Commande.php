<?php
namespace Domain\Commande\Entity; 
use PDO;

class Commande{
    // Connexion
    private $connexion;
    private $table = "commande";

    // object properties
    public $id;
    public $pourboire;
    public $addition;
    public $al_table_id;
    public $client_id;
    public $restaurateur_id;
    public $service_id;


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
     * Créer une carte
     *
     * @return void
     */
    public function creer($nbConvives){

        // Ecriture de la requête SQL en y insérant le nom de la table
        $sql1 = "INSERT INTO " . $this->table . " SET pourboire=:pourboire, addition=:addition, al_table_id=:al_table_id, client_id=:client_id, restaurateur_id=:restaurateur_id, service_id=:service_id, ";

        // Préparation de la requête
        $query1 = $this->connexion->prepare($sql1);

        // Protection contre les injections
        $this->pourboire=htmlspecialchars(strip_tags($this->pourboire));
        $this->addition=htmlspecialchars(strip_tags($this->addition));
        $this->al_table_id=htmlspecialchars(strip_tags($this->al_table_id));
        $this->client_id=htmlspecialchars(strip_tags($this->client_id));
        $this->restaurateur_id=htmlspecialchars(strip_tags($this->restaurateur_id));
        $this->service_id=htmlspecialchars(strip_tags($this->service_id));

        // Ajout des données protégées
        $query1->bindParam(":pourboire", $this->pourboire);
        $query1->bindParam(":addition", $this->addition);
        $query1->bindParam(":al_table_id", $this->al_table_id);
        $query1->bindParam(":client_id", $this->client_id);
        $query1->bindParam(":restaurateur_id", $this->restaurateur_id);
        $query1->bindParam(":service_id", $this->service_id);
        
        $sql2 = "UPDATE al_table SET nbConvives=:nbConvives WHERE id=:al_table_id";

        $query2 = $this->connexion->prepare($sql2);

        $query2->bindParam(":nbConvives", $nbConvives);
        $query2->bindParam(":al_table_id", $this->al_table_id);

        // Exécution de la requête
        if($query1->execute()){
            if ($query2->execute()) {
                return true;
            }
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
        $sql = "UPDATE " . $this->table . " SET nom = :nom, prix = :prix, description = :description, categories_id = :categories_id WHERE id = :id";
        
        // On prépare la requête
        $query = $this->connexion->prepare($sql);
        
        // On sécurise les données
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->prix=htmlspecialchars(strip_tags($this->prix));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->categories_id=htmlspecialchars(strip_tags($this->categories_id));
        $this->id=htmlspecialchars(strip_tags($this->id));
        
        // On attache les variables
        $query->bindParam(':nom', $this->nom);
        $query->bindParam(':prix', $this->prix);
        $query->bindParam(':description', $this->description);
        $query->bindParam(':categories_id', $this->categories_id);
        $query->bindParam(':id', $this->id);
        
        // On exécute
        if($query->execute()){
            return true;
        }
        
        return false;
    }

}