<?php

    require_once("objet.php");

    class Dessert_Exemplaire extends objet {

        protected static string $classe = "Dessert_Exemplaire";

        protected static string $identifiant = "numDessertExemplaire";

        protected int $numDessertExemplaire;
        protected string $dateAchatDessert;
        protected string $datePeremptionDessert;
        protected int $numDessert;

        public function __construct(int $numDessertExemplaire = null, string $dateAchatDessert = null, string $datePeremptionDessert = null, int $numDessert = null){
            
            if (!is_null($numDessertExemplaire)) {
                
                $this->numDessertExemplaire = $numDessertExemplaire;
                $this->dateAchatDessert = $dateAchatDessert;
                $this->datePeremptionDessert = $datePeremptionDessert;
                $this->numDessert = $numDessert;

            }
        }
        
        public function __toString() {
            $chaine = "Exemplaire Dessert numéro $this->numDessertExemplaire, acheter le $this->dateAchatDessert"; // a ajouter : $this->dateDessert
            return $chaine;
        }

        public static function create(){

                $requetePreparee = "INSERT INTO Dessert_Exemplaire ( datePermetionDessert, dateAchatDessert, numDessert) 
                                VALUES ( :datePermetionDessert, :dateAchatDessert, :numDessert);";

                $resultat = connexion::pdo()->prepare($requetePreparee);


                $currentDate = new DateTime('now');
                $currentDate->add(new DateInterval('P2M'));
                $datePermetion = $currentDate->format('Y-m-d');
                $dateAchatDessert =  date('Y-m-d', strtotime('now'));
                $numDessert = $_GET['selectDessertForm']; 

                // Bind parameters
                $resultat->bindParam(':datePermetionDessert', $datePermetion);
                $resultat->bindParam(':dateAchatDessert', $dateAchatDessert);
                $resultat->bindParam(':numDessert', $numDessert);

                try {
                    $resultat->execute();
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            
            
        }

        public static function nbDispo($numDessert){
            $requetePreparee = "select Dessert_Exemplaire.numDessertExemplaire from Dessert_Exemplaire 
            left join Commande_Desserts on Dessert_Exemplaire.numDessertExemplaire = Commande_Desserts.numDessertExemplaire 
            where numCommande is null 
            And  Dessert_Exemplaire.numDessert = $numDessert
            and datePermetionDessert > CURDATE()";
            
            $resultat = connexion::pdo()->prepare($requetePreparee);

            try {

                $resultat->execute();

                $resultat->setFetchmode(PDO::FETCH_ASSOC);

                $element = $resultat->fetch();

                return $resultat->rowCount();
        
            }

            catch(PDOException $e){
                echo $e->getMessage();
            }

        }

        public  static function existe($numDessert){

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
                if ($resultat2->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                return false;
            }
        }
    }

?>