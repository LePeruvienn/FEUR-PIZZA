<?php

    require_once("objet.php");

    class Dessert extends objet {

        protected static string $classe = "Dessert";

        protected static string $identifiant = "numDessert";

        protected int $numDessert;
        protected string $nomDessert;
        protected float $prixDessert;

        public function __construct(int $numDessert = null, string $nomDessert = null, float $prixDessert = null){
            
            if (!is_null($numDessert)) {
            
                $this->numDessert = $numDessert;
                $this->nomDessert = $nomDessert;
                $this->prixDessert = $prixDessert;

            }
        }
        
        public function __toString() {
            $chaine = "Dessert $this->nomDessert : $this->prixDessert €";
            return $chaine;
        }

        public function getNom() {
            $chaine = "$this->nomDessert";
            return $chaine;
        }

        public static function update(){
            /*$i = 0 ;
            foreach ($_GET as $key => $value) {
                if($key == "numIngredient".$i){
                    $requetePreparee = "UPDATE `Ingredient` SET `quantiteEnStock` = :quantite
                    WHERE `numIngredient` = :numIngredient";

                    $resultat = connexion::pdo()->prepare($requetePreparee);
                    // Assuming $donnees is your associative array with values

                    $valueForNumIngredient = $_GET['numIngredient'.$i];
                    $valueForQuantite = $_GET['quantite'.$i];
        
                    // Bind parameters
                    $resultat->bindParam(':numIngredient', $valueForNumIngredient, PDO::PARAM_INT);
                    $resultat->bindParam(':quantite', $valueForQuantite, PDO::PARAM_INT);

                    try{
                        $resultat->execute();
                        $i = $i+1;
                    }catch(PDOExeption $e){
                        echo $e->getMessage();

                    }
                }   
            }*/

        }
    }

?>