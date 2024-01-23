<?php

    require_once("objet.php");

    class Pizza_exemplaire extends objet {

        protected static string $classe = "Pizza_exemplaire";

        protected static string $identifiant = "numPizzaExemplaire";

        protected int $numPizzaExemplaire;
        protected string $DateFabrication;
        protected int $numPizza;

        public function __construct(int $numPizzaExemplaire = null, string $DateFabrication = null, int $numPizza = null){
            
            if (!is_null($numPizzaExemplaire)) {
                
                $this->numPizzaExemplaire = $numPizzaExemplaire;
                $this->DateFabrication = $DateFabrication;
                $this->numPizza = $numPizza;

            }
        }
        
        public function __toString() {
            $chaine = "Pizza exemplaire numéro : $this->numPizzaExemplaire, faite le $this->DateFabrication, avec comme base la pizza numéro : $this->numPizza";
            return $chaine;
        }

        public static function create($numPizza){

            $requetePreparee = "INSERT INTO Pizza_exemplaire ( dateFabrication, numPizza) 
                            VALUES ( :dateFabrication, :numPizza);";

            $resultat = connexion::pdo()->prepare($requetePreparee);

            $dateFabrication =  date('Y-m-d', strtotime('now'));

            // Bind parameters
            $resultat->bindParam(':dateFabrication', $dateFabrication);
            $resultat->bindParam(':numPizza', $numPizza);

            try {
                $resultat->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

?>