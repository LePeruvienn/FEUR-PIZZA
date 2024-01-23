<?php

    require_once("objet.php");

    class Boisson extends objet {

        protected static string $classe = "Boisson";

        protected static string $identifiant = "numBoisson";

        protected int $numBoisson;
        protected string $nomBoisson;
        protected float $prixBoisson;

        public function __construct(int $numBoisson = null, string $nomBoisson = null, float $prixBoisson = null){
            
            if (!is_null($numBoisson)) {
            
                $this->numBoisson = $numBoisson;
                $this->nomBoisson = $nomBoisson;
                $this->prixBoisson = $prixBoisson;

            }
        }
        
        public function __toString() {
            $chaine = "Boisson $this->nomBoisson : $this->prixBoisson €";
            return $chaine;
        }

        public function getNom() {
            $chaine = "$this->nomBoisson";
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