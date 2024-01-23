<?php

    require_once("objet.php");
    require_once("./controller/controllerCompte.php");
    

    class Commande_Desserts extends objet {

        protected int $numCommande;
        protected int $numDessertExemplaire;

        public function __construct(int $numCommande = null, int $numDessertExemplaire = null){
            
            if (!is_null($numCommande)) {
            
                $this->numCommande = $numCommande;
                $this->numDessertExemplaire = $numDessertExemplaire;

            }
        }
        
        public function __toString() {
            $chaine = "Commande numéro $this->numCommande possede l'exemplaire dessert numéro $this->numDessertExemplaire";
            return $chaine;
        }

        public static function getAll() {
            $requete = "SELECT * FROM Commande_Desserts;";
            $resultat = connexion::pdo()->query($requete);
            $resultat->setFetchmode(PDO::FETCH_CLASS,"Commande_Desserts");
            $tableau = $resultat->fetchAll();
            return $tableau;
        }

        public static function create($numDessert,$derniereCommande) {
            // Proceed with the insertion
            $requetePreparee = "INSERT INTO Commande_Desserts (numCommande, numDessertExemplaire) 
            VALUES (:numCommande, :numDessertExemplaire);";
            
            $resultat = connexion::pdo()->prepare($requetePreparee);


            $requetePreparee2 = "select Dessert_Exemplaire.numDessertExemplaire from Dessert_Exemplaire 
            left join Commande_Desserts on Dessert_Exemplaire.numDessertExemplaire = Commande_Desserts.numDessertExemplaire 
            where numCommande is null 
            And  Dessert_Exemplaire.numDessert = :numDessert  
            and datePermetionDessert > CURDATE()
            LIMIT 1; ";
            $resultat2 = connexion::pdo()->prepare($requetePreparee2);
            $resultat2->bindParam(':numDessert', $numDessert);
            try {
                $resultat2->execute();
                $DessertExemplaire = $resultat2->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
                //controllerCompte::displayAll();
            }


            $numCommande = $derniereCommande["numCommande"];
            $numDessertExemplaire = $DessertExemplaire["numDessertExemplaire"];

            // Bind parameters
            $resultat->bindParam(':numCommande', $numCommande);
            $resultat->bindParam(':numDessertExemplaire', $numDessertExemplaire);
           
            try {
                $resultat->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
              
            }
        }
    }

?>