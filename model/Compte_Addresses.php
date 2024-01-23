<?php

    require_once("objet.php");

    class Compte_Addresses extends objet {

        protected string $login;
        protected int $numAdresse;

        public function __construct(string $login = null, int $numAdresse = null){
            
            if (!is_null($numCommande)) {
            
                $this->login = $login;
                $this->numAdresse = $numAdresse;

            }
        }
        
        public function __toString() {
            $chaine = "Le compte $this->login possede l'addresse $this->numAdresse";
            return $chaine;
        }

        public static function getAll() {
            $requete = "SELECT * FROM Compte_Addresses;";
            $resultat = connexion::pdo()->query($requete);
            $resultat->setFetchmode(PDO::FETCH_CLASS,"Compte_Addresses");
            $tableau = $resultat->fetchAll();
            return $tableau;
        }
    }

?>