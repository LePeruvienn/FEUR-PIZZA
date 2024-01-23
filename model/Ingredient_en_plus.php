<?php

    require_once("objet.php");

    class Ingredient_en_plus extends objet {

        protected int $numIngredient;
        protected int $numPizzaExemplaire;

        public function __construct(int $numIngredient = null, int $numPizzaExemplaire = null){
            
            if (!is_null($numIngredient)) {
            
                $this->numIngredient = $numIngredient;
                $this->numPizzaExemplaire = $numPizzaExemplaire;

            }
        }
        
        public function __toString() {
            $chaine = "Ingredient numéro $this->numIngredient est en plus dans la pizza numéro $this->numPizzaExemplaire";
            return $chaine;
        }

        public static function getAll() {
            $requete = "SELECT * FROM Ingredient_en_plus;";
            $resultat = connexion::pdo()->query($requete);
            $resultat->setFetchmode(PDO::FETCH_CLASS,"Ingredient_en_plus");
            $tableau = $resultat->fetchAll();
            return $tableau;
        }

        public static function create($numIngredient, $numPizzaExemplaire){

            $requetePreparee = "INSERT INTO `Ingredient_en_plus` (`numIngredient`, `numPizzaExemplaire`) VALUES ('$numIngredient', '$numPizzaExemplaire');";

            $resultat = connexion::pdo()->prepare($requetePreparee);

            try{
                $resultat->execute();
                
            }catch(PDOExeption $e){
                echo $e->getMessage();

            }
        }
    }

?>