<?php

    require_once("objet.php");

    class Commande extends objet {

        protected static string $classe = "Commande";

        protected static string $identifiant = "numCommande";

        protected int $numCommande;
        protected string $dateCommande;
        protected ?string $dateLivraison;
        protected string $typeCommande;
        protected ?int $numEspece;
        protected ?int $numCarteDeCredit;
        protected string $login;

        public function __construct(int $numCommande = null, string $dateCommande = null, string $dateLivraison = null,string $typeCommande = null, int $numEspece = null, int $numCarteDeCredit = null, string $login = null){
            
            if (!is_null($numCommande)) {
            
                $this->numCommande = $numCommande;
                $this->dateCommande = $dateCommande;
                $this->dateLivraison = $dateLivraison;
                $this->typeCommande = $typeCommande;
                $this->numEspece = $numEspece;
                $this->numCarteDeCredit = $numCarteDeCredit;
                $this->login = $login;
            }
        }
        
        public function __toString() {
            $chaine = "Commande numéro $this->numCommande $this->typeCommande, Date commande $this->dateCommande, ";
            if(!is_null($this->dateLivraison)){
                $chaine = $chaine."Date Livraison $this->dateLivraison";
            }
            else {
                $chaine = $chaine."Pas livré encore !";
            }
            return $chaine;
        }
        
        public static function create($donnees) {

            $requetePreparee = "INSERT INTO `Commande` (`numCommande`, `dateCommande`, `datePreparation`, `dateLivraison`, `typeCommande`, `numEspece`, `numCarteDeCredit`, `login`) 
            VALUES ( NULL, NOW(), NULL, NULL, :typeCommande, NULL, :numCarteDeCredit, :login );";

            $donnees["typeCommande"] = "Livraison";
            $donnees["login"] = strval($_SESSION["login"]);

            $resultat = connexion::pdo()->prepare($requetePreparee);

            try{
                $resultat->execute($donnees);
                
            }catch(PDOExeption $e){
                echo $e->getMessage();

            }

            /*
            // Proceed with the insertion
            $requetePreparee = "INSERT INTO Commande ( dateCommande, datePreparation, dateLivraison, typeCommande, numEspece, numCarteDeCredit,  login) 
            VALUES ( NOW(), NULL, :dateLivraison, :typeCommande, :numEspece, :numCarteDeCredit, :login);";
            //date(".'"'."Y-m-d".'"'.") et date(".'"'."H:i:s".'"'.")
            $resultat = connexion::pdo()->prepare($requetePreparee);

            
            $carteActuelle = CarteDeCredit::getOne($donnees['card_number']);
            echo $carteActuelle;
            //echo $carteActuelle;
            // Extract relevant data
            $numCarteDeCredit = $carteActuelle->get("numCarteDeCredit");
            $typeCommande = "Livraison";
            $valueForDateLivraison = NULL;
            $valueForNumEspece = NULL; 
            $valueForLogin = $_SESSION['login'];
            //print_r($carteActuelle);
            //echo $numCarteDeCredit;

            // Bind parameters
            
            $resultat->bindParam(':dateLivraison', $valueForDateLivraison);
            $resultat->bindParam(':typeCommande', $typeCommande);
            $resultat->bindParam(':numEspece', $valueForNumEspece);
            $resultat->bindParam(':numCarteDeCredit', $numCarteDeCredit);
            $resultat->bindParam(':login', $valueForLogin);
        
            try {
                $resultat->execute();
                echo "Commande inséré";

            } 
            catch (PDOException $e) {
                echo $e->getMessage();
            }

            */
        }

        public static function deleteCarte($id) {
            $requetePreparee = "UPDATE Commande 
                   SET numCarteDeCredit = NULL
                   WHERE numCarteDeCredit = :id;";
            //date(".'"'."Y-m-d".'"'.") et date(".'"'."H:i:s".'"'.")
            $resultat = connexion::pdo()->prepare($requetePreparee);

            $resultat->bindParam(':id', $id);
            try {
                $resultat->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

?>