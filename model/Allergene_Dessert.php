<?php

    require_once("objet.php");

    class Allergene_Dessert extends objet {

        protected int $numDessert;
        protected int $numAllergene;

        public function __construct(int $numDessert = null, int $numAllergene = null){
            
            if (!is_null($numDessert)) {
            
                $this->numDessert = $numDessert;
                $this->numAllergene = $numAllergene;

            }
        }
        
        public function __toString() {
            $chaine = "Dessert num : $this->numDessert, à l'allergène num : $this->numAllergene.";
            return $chaine;
        }

        public static function getAll() {
            $requete = "SELECT * FROM Allergene_Dessert;";
            $resultat = connexion::pdo()->query($requete);
            $resultat->setFetchmode(PDO::FETCH_CLASS,"Allergene_Dessert");
            $tableau = $resultat->fetchAll();
            return $tableau;
        }
    }

?>