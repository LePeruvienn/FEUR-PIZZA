<?php

    require_once("objet.php");

    class Pizza extends objet {

        protected static string $classe = "Pizza";

        protected static string $identifiant = "numPizza";

        protected int $numPizza;
        protected string $nomPizza;
        protected float $prixPizza;
        protected ?bool $enAvant;
        protected ?string $descCourt;

        public function __construct(int $numPizza = null, string $nomPizza = null, float $prixPizza = null, bool $enAvant = null, string $descCourt = null){
            
            if (!is_null($numPizza)) {
            
                $this->numPizza = $numPizza;
                $this->nomPizza = $nomPizza;
                $this->prixPizza = $prixPizza;
                $this->enAvant = $enAvant;
                $this->descCourt = $descCourt;
            }
        }
        
        public function __toString() {
            $chaine = "Pizza $this->nomPizza, prix : $this->prixPizza € | $this->enAvant ";
            return $chaine;
        }

        public function getNom() {
            $chaine = "$this->nomPizza";
            return $chaine;
        }

        public static function getAll() {
            $requete = "SELECT * FROM Pizza;";
            $resultat = connexion::pdo()->query($requete);
            $resultat->setFetchmode(PDO::FETCH_CLASS,"Pizza");
            $tableau = $resultat->fetchAll();
            return $tableau;
        }

        public static function getIdFromNom($nomPizza) {
            $requete = 'SELECT numPizza FROM Pizza Where `nomPizza` = "'.$nomPizza.'";';
            //echo $requete;
            $resultat = connexion::pdo()->query($requete);
            //$resultat->setFetchmode(PDO::FETCH_CLASS,"Ingredient_Pizza");
            $tableau = $resultat->fetchAll();
            $tableau2 = $tableau[0];
            return $tableau2["numPizza"];
        }

        
        public static function supprimer($numPizza){

            $requetePreparee = "DELETE FROM `Pizza` WHERE `numPizza` = :pizzaIdToDelete";
    
            $resultat = connexion::pdo()->prepare($requetePreparee);

            $resultat->bindParam(':pizzaIdToDelete', $numPizza, PDO::PARAM_INT);

            try{
                $resultat->execute();
            }catch(PDOExeption $e){
                echo $e->getMessage();
            }
        }

        public static function create($donnees){
            $requetePreparee = "INSERT INTO Pizza ( `nomPizza`, `prixPizza`, `enAvant`, `descCourt`) 
            VALUES ( :nomPizza, :prixPizza, :enAvant, :descCourt);";

            $resultat = connexion::pdo()->prepare($requetePreparee);
            // Assuming $donnees is your associative array with values
            $valueForNomPizza = $donnees['nom'];
            $valueForPrixPizza = $donnees['prix'];
            if (isset($donnees['enAvant'])){
                $valueForEnAvant = $donnees['enAvant'];
            }else{
                $valueForEnAvant = 0;
            }
            $valueForDescCourt = $donnees['description'];

            // Bind parameters
            $resultat->bindParam(':nomPizza', $valueForNomPizza);
            $resultat->bindParam(':prixPizza', $valueForPrixPizza, PDO::PARAM_STR); // Use PDO::PARAM_STR for numerical values
            $resultat->bindParam(':enAvant', $valueForEnAvant, PDO::PARAM_INT);
            $resultat->bindParam(':descCourt', $valueForDescCourt);
            try{
                $resultat->execute();
            }catch(PDOExeption $e){
                echo $e->getMessage();

            }
            
        }
        
        public static function update($donnees){
            $requetePreparee = "UPDATE `Pizza` SET 
                `numPizza` = :numPizza, 
                `nomPizza` = :nomPizza, 
                `prixPizza` = :prixPizza, 
                `enAvant` = :enAvant, 
                `descCourt` = :descCourt
                WHERE `Pizza`.`numPizza` = :numPizza;";
                
                $resultat = connexion::pdo()->prepare($requetePreparee);
                // Assuming $donnees is your associative array with values
                $valueForNumPizza = $donnees['numPizza'];
                $valueForNomPizza = $donnees['nomPizza'];
                $valueForPrixPizza = $donnees['prixPizza'];
                if (isset($donnees['enAvant'])){
                    $valueForEnAvant = $donnees['enAvant'];
                }else{
                    $valueForEnAvant = 0;
                }
                $valueForDescCourt = $donnees['descCourt'];
    
                // Bind parameters
                $resultat->bindParam(':numPizza', $valueForNumPizza, PDO::PARAM_INT);
                $resultat->bindParam(':nomPizza', $valueForNomPizza);
                $resultat->bindParam(':prixPizza', $valueForPrixPizza, PDO::PARAM_STR); // Use PDO::PARAM_STR for numerical values
                $resultat->bindParam(':enAvant', $valueForEnAvant, PDO::PARAM_INT);
                $resultat->bindParam(':descCourt', $valueForDescCourt);
            try{
                $resultat->execute();
            }catch(PDOExeption $e){
                echo $e->getMessage();

            }
        }

    }

?>