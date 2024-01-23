<?php

    require_once("objet.php");

    class Ingredient_Pizza extends objet {

        protected int $numPizza;
        protected int $numIngredient;
        protected ?int $quantite;

        public function __construct(int $numPizza = null, int $numIngredient = null, int $quantite = null){
            
            if (!is_null($numPizza)) {
            
                $this->numPizza = $numPizza;
                $this->numIngredient = $numIngredient;
                $this->quantite = $quantite;

            }
        }
        
        public function __toString() {
            $chaine = "La pizza numéro $this->numPizza possede l'ingredient numéro $this->numIngredient avec une quantite de $this->quantite.";
            return $chaine;
        }

        public static function getAll() {
            $requete = "SELECT * FROM Ingredient_Pizza;";
            $resultat = connexion::pdo()->query($requete);
            $resultat->setFetchmode(PDO::FETCH_CLASS,"Ingredient_Pizza");
            $tableau = $resultat->fetchAll();
            return $tableau;
        }

        public static function supprimer($numPizza){

            $requetePreparee = "DELETE FROM `Ingredient_Pizza` WHERE `numPizza` = :pizzaIdToDelete";

            $resultat = connexion::pdo()->prepare($requetePreparee);

            $resultat->bindParam(':pizzaIdToDelete', $numPizza, PDO::PARAM_INT);

            try{
                $resultat->execute();
            }catch(PDOExeption $e){
                echo $e->getMessage();
            }
        }

        public static function create($donnees){
            $i = 0 ;
            foreach ($donnees as $key => $value) {
                if($key == "numIngredient".$i){
                    $requetePreparee = "INSERT INTO Ingredient_Pizza ( `numPizza`,`numIngredient`, `quantite`) 
                    VALUES ( :numPizza,:numIngredient, :quantite);";

                    $resultat = connexion::pdo()->prepare($requetePreparee);
                    // Assuming $donnees is your associative array with values
                    $valueFornumPizza = $donnees['numPizza'];
                    $valueFornumIngredient = $donnees['numIngredient'.$i];
                    $valueForquantite = $donnees['quantite'.$i];

                    // Bind parameters
                    $resultat->bindParam(':numPizza', $valueFornumPizza, PDO::PARAM_INT); // Use PDO::PARAM_STR for numerical values
                    $resultat->bindParam(':numIngredient', $valueFornumIngredient, PDO::PARAM_INT); // Use PDO::PARAM_STR for numerical values
                    $resultat->bindParam(':quantite', $valueForquantite, PDO::PARAM_INT);
                    try{
                        $resultat->execute();
                        $i = $i+1;
                    }catch(PDOExeption $e){
                        echo $e->getMessage();

                    }
                }
            }  
        }

        public static function update($donnees){
            $i = 0 ;
            foreach ($donnees as $key => $value) {
                if($key == "numIngredient".$i){
                    $requetePreparee = "INSERT INTO `Ingredient_Pizza` (`numPizza`, `numIngredient`, `quantite`)
                    VALUES (:numPizza, :numIngredient, :quantite)
                    ON DUPLICATE KEY UPDATE 
                    `numIngredient` = VALUES(`numIngredient`), 
                    `quantite` = VALUES(`quantite`);";
                    
                    $resultat = connexion::pdo()->prepare($requetePreparee);
                    // Assuming $donnees is your associative array with values
                    $valueForNumPizza = $_GET['numPizza'];
                    $valueForNumIngredient = $donnees['numIngredient'.$i];
                    $valueForQuantite = $donnees['quantite'.$i];
        
                    // Bind parameters
                    $resultat->bindParam(':numPizza', $valueForNumPizza, PDO::PARAM_INT);
                    $resultat->bindParam(':numIngredient', $valueForNumIngredient, PDO::PARAM_INT);
                    $resultat->bindParam(':quantite', $valueForQuantite, PDO::PARAM_INT);

                    try{
                        $resultat->execute();
                        $i = $i+1;
                    }catch(PDOExeption $e){
                        echo $e->getMessage();

                    }
                }   
            }

        }

        public static function getOnePizza($id) {

            $requetePreparee = "SELECT * FROM Ingredient_Pizza WHERE numPizza = :id_tag;";

            $resultat = connexion::pdo()->prepare($requetePreparee);

            $tags = array("id_tag" => $id);

            try {

                $resultat->execute($tags);

                $resultat->setFetchmode(PDO::FETCH_CLASS,"Ingredient_Pizza");

                $tableau = $resultat->fetchAll();

                return $tableau;
        
            }

            catch(PDOException $e){
                echo $e->getMessage();
            }

            return $tableau;
        }

        
        public static function getAllOfid($id) {

            $classeRecupere = "Ingredient_Pizza";
            $identifiant = "numPizza";

            $requetePreparee = "SELECT * FROM $classeRecupere WHERE $identifiant = :id_tag;";

            $resultat = connexion::pdo()->prepare($requetePreparee);

            $tags = array("id_tag" => $id);

            try {

                $resultat->execute($tags);

                $resultat->setFetchmode(PDO::FETCH_CLASS,$classeRecupere);

                $element = $resultat->fetchAll();

                return $element;
        
            }

            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }

?>