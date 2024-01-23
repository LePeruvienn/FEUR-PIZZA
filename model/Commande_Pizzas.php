<?php

    require_once("objet.php");

    class Commande_Pizzas extends objet {

        protected int $numCommande;
        protected int $numPizzaExemplaire;

        public function __construct(int $numCommande = null, int $numPizzaExemplaire = null){
            
            if (!is_null($numCommande)) {
            
                $this->numCommande = $numCommande;
                $this->numPizzaExemplaire = $numPizzaExemplaire;

            }
        }
        
        public function __toString() {
            $chaine = "Commande numéro $this->numCommande possede l'exemplaire Pizza numéro $this->numPizzaExemplaire";
            return $chaine;
        }

        public static function getAll() {
            $requete = "SELECT * FROM Commande_Pizzas;";
            $resultat = connexion::pdo()->query($requete);
            $resultat->setFetchmode(PDO::FETCH_CLASS,"Commande_Pizzas");
            $tableau = $resultat->fetchAll();
            return $tableau;
        }

        public static function create($numPizza,$derniereCommande) {
            // Proceed with the insertion
            $requetePreparee = "INSERT INTO Commande_Pizzas (numCommande, numPizzaExemplaire) 
            VALUES (:numCommande, :numPizzaExemplaire);";
            
            $resultat = connexion::pdo()->prepare($requetePreparee);


            $requetePreparee2 = "select Pizza_exemplaire.numPizzaExemplaire from Pizza_exemplaire 
            left join Commande_Pizzas on Pizza_exemplaire.numPizzaExemplaire = Commande_Pizzas.numPizzaExemplaire 
            where numCommande is null 
            And  Pizza_exemplaire.numPizza = :numPizza  
            LIMIT 1; ";
            $resultat2 = connexion::pdo()->prepare($requetePreparee2);
            $resultat2->bindParam(':numPizza', $numPizza);
            try {
                $resultat2->execute();
                $PizzaExemplaire = $resultat2->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }


            $numCommande = $derniereCommande["numCommande"];
            $numPizzaExemplaire = $PizzaExemplaire["numPizzaExemplaire"];

            // Bind parameters
            $resultat->bindParam(':numCommande', $numCommande);
            $resultat->bindParam(':numPizzaExemplaire', $numPizzaExemplaire);
            try {
                $resultat->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

?>