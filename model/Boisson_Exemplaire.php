<?php

    require_once("objet.php");

    class Boisson_Exemplaire extends objet {

        protected static string $classe = "Boisson_Exemplaire";

        protected static string $identifiant = "numBoissonExemplaire";

        protected int $numBoissonExemplaire;
        protected string $dateAchatBoisson;
        protected string $datePeremptionBoisson;
        protected int $numBoisson;

        public function __construct(int $numBoissonExemplaire = null, string $dateAchatBoisson = null, string $datePeremptionBoisson = null, int $numBoisson = null){
            
            if (!is_null($numBoissonExemplaire)) {
                
                $this->numBoissonExemplaire = $numBoissonExemplaire;
                $this->dateAchatBoisson = $dateAchatBoisson;
                $this->datePeremptionBoisson = $datePeremptionBoisson;
                $this->numBoisson = $numBoisson;

            }
        }
        
        public function __toString() {
            $chaine = "Exemplaire Boisson numéro $this->numBoissonExemplaire, acheter le $this->dateAchatBoisson"; // a ajouter : $this->datePeremtionBoisson
            return $chaine;
        }

        
        public static function create(){

            $requetePreparee = "INSERT INTO Boisson_Exemplaire ( datePermetionBoisson, dateAchatBoisson, numBoisson) 
                            VALUES ( :datePermetionBoisson, :dateAchatBoisson, :numBoisson);";

            $resultat = connexion::pdo()->prepare($requetePreparee);


            $currentDate = new DateTime('now');
            $currentDate->add(new DateInterval('P6M'));
            $datePermetion = $currentDate->format('Y-m-d');
            $dateAchatBoisson =  date('Y-m-d', strtotime('now'));
            $numBoisson = $_GET['selectBoissonForm']; 

            // Bind parameters
            $resultat->bindParam(':datePermetionBoisson', $datePermetion);
            $resultat->bindParam(':dateAchatBoisson', $dateAchatBoisson);
            $resultat->bindParam(':numBoisson', $numBoisson);

            try {
                $resultat->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public static function nbDispo($numBoisson){
            $requetePreparee = "select Boisson_Exemplaire.numBoissonExemplaire from Boisson_Exemplaire 
            left join Commande_Boissons on Boisson_Exemplaire.numBoissonExemplaire = Commande_Boissons.numBoissonExemplaire 
            where numCommande is null 
            And  Boisson_Exemplaire.numBoisson = $numBoisson
            and datePermetionBoisson > CURDATE()";
            
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

        public  static function existe($numBoisson){

            $requetePreparee2 = "select Boisson_Exemplaire.numBoissonExemplaire from Boisson_Exemplaire 
            left join Commande_Boissons on Boisson_Exemplaire.numBoissonExemplaire = Commande_Boissons.numBoissonExemplaire 
            where numCommande is null 
            And  Boisson_Exemplaire.numBoisson = :numBoisson  
            and datePermetionBoisson > CURDATE()
            LIMIT 1; ";

            $resultat2 = connexion::pdo()->prepare($requetePreparee2);
            $resultat2->bindParam(':numBoisson', $numBoisson);
            try {
                $resultat2->execute();
                $BoissonExemplaire = $resultat2->fetch(PDO::FETCH_ASSOC);
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