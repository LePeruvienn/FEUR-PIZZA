<?php

    require_once("objet.php");

    class Ingredient extends objet {

        protected static string $classe = "Ingredient";

        protected static string $identifiant = "numIngredient";

        protected int $numIngredient;
        protected string $nomIngredient;
        protected int $quantiteEnStock;
        protected string $mesure;
        protected float $prixSupplement;
        protected int $quantiteSupplement;
        protected ?int $numAllergene;

        public function __construct(int $numIngredient = null, string $nomIngredient = null, int $quantiteEnStock = null, string $mesure = null, float $prixSupplement = null, int $quantiteSupplement = null, int $numAllergene = null){
            
            if (!is_null($numIngredient)) {
            
                $this->numIngredient = $numIngredient;
                $this->nomIngredient = $nomIngredient;
                $this->quantiteEnStock = $quantiteEnStock;
                $this->mesure = $mesure;
                $this->prixSupplement = $prixSupplement;
                $this->quantiteSupplement = $quantiteSupplement;
                $this->numAllergene = $numAllergene;
            }
        }
        
        public function __toString() {
            $chaine = "Ingredient $this->nomIngredient, prix supllément : $this->prixSupplement €, quantite dispnible : $this->quantiteEnStock $this->mesure";
            return $chaine;
        }

        public function upadteQuantite($quantite){

            $id = $this->numIngredient;

            $requetePreparee = "UPDATE `Ingredient` SET `quantiteEnStock` = $quantite
            WHERE `numIngredient` = $id;";

            $resultat = connexion::pdo()->prepare($requetePreparee);

            try{
                $resultat->execute();
            }
            catch(PDOExeption $e){
                
                echo $e->getMessage();
            }
        }
        
        public static function update(){
            $i = 0 ;
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
            }

        }
    }

?>