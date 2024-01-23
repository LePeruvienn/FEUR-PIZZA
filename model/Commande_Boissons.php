<?php

    require_once("objet.php");

    class Commande_Boissons extends objet {

        protected int $numCommande;
        protected int $numBoissonExemplaire;

        public function __construct(int $numCommande = null, int $numBoissonExemplaire = null){
            
            if (!is_null($numCommande)) {
            
                $this->numCommande = $numCommande;
                $this->numBoissonExemplaire = $numBoissonExemplaire;

            }
        }
        
        public function __toString() {
            $chaine = "Commande numéro $this->numCommande possede l'exemplaire boisson numéro $this->numBoissonExemplaire";
            return $chaine;
        }

        public static function getAll() {
            $requete = "SELECT * FROM Commande_Boissons;";
            $resultat = connexion::pdo()->query($requete);
            $resultat->setFetchmode(PDO::FETCH_CLASS,"Commande_Boissons");
            $tableau = $resultat->fetchAll();
            return $tableau;
        }

        public static function create($numBoisson,$derniereCommande) {
            // Proceed with the insertion
            $requetePreparee = "INSERT INTO Commande_Boissons (numCommande, numBoissonExemplaire) 
            VALUES (:numCommande, :numBoissonExemplaire);";
            
            $resultat = connexion::pdo()->prepare($requetePreparee);


            $requetePreparee2 = "select Boisson_Exemplaire.numBoissonExemplaire from Boisson_Exemplaire 
            left join Commande_Boissons on Boisson_Exemplaire.numBoissonExemplaire = Commande_Boissons.numBoissonExemplaire 
            where numCommande is null 
            And  Boisson_Exemplaire.numBoisson = :numBoisson 
            and datePermetionBoisson > CURDATE() 
            LIMIT 1; ";//add si non périmé 
            $resultat2 = connexion::pdo()->prepare($requetePreparee2);
            $resultat2->bindParam(':numBoisson', $numBoisson);
            try {
                $resultat2->execute();
                $BoissonExemplaire = $resultat2->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }


            $numCommande = $derniereCommande["numCommande"];
            $numBoissonExemplaire = $BoissonExemplaire["numBoissonExemplaire"];

            // Bind parameters
            $resultat->bindParam(':numCommande', $numCommande);
            $resultat->bindParam(':numBoissonExemplaire', $numBoissonExemplaire);
        
            try {
                $resultat->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

?>