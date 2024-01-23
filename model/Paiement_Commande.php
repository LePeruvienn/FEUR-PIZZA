<?php

    require_once("objet.php");

    class Paiement_Commande extends objet {

        protected int $numCommande;
        protected ?int $numEspece;
        protected ?int $numCarteDeCredit;

        public function __construct(int $numCommande = null, int $numEspece = null, int $numCarteDeCredit = null){
            
            if (!is_null($numCommande)) {
            
                $this->numCommande = $numCommande;
                $this->numEspece = $numEspece;
                $this->numCarteDeCredit = $numCarteDeCredit;

            }
        }
        
        public function __toString() {
            $chaine = "Commande numéro $this->numCommande ";
            if(is_null($this->numEspece)){$chaine = $chaine . " Payer avec la carte de credit numero $this->numCarteDeCredit";}
            else if(is_null($this->numCarteDeCredit)){$chaine = $chaine . " Payer avec l'espece numero $this->numEspece";}
            else {$chaine = $chaine . " Payer avec l'espece numero $this->numEspece et la carte numéro $this->numCarteDeCredit";}
            return $chaine;
        }

        public static function getAll() {
            $requete = "SELECT * FROM Paiement_Commande;";
            $resultat = connexion::pdo()->query($requete);
            $resultat->setFetchmode(PDO::FETCH_CLASS,"Paiement_Commande");
            $tableau = $resultat->fetchAll();
            return $tableau;
        }
    }

?>