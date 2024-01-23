<?php

    require_once("objet.php");

    class Adresse extends objet {

        protected static string $classe = "Adresse";

        protected static string $identifiant = "numAdresse";

        protected int $numAdresse;
        protected string $rue;
        protected int $numero;
        protected string $ville;
        protected int $codePostal;

        public function __construct(int $numAdresse = null, string $rue = null, int $numero = null, string $ville = null, int $codePostal = null){
            
            if (!is_null($numAdresse)) {
            
                $this->numAdresse = $numAdresse;
                $this->rue = $rue;
                $this->numero = $numero;
                $this->ville = $ville;
                $this->codePostal = $codePostal;

            }
        }
        
        public function __toString() {
            $chaine = "$this->numero $this->rue, $this->ville $this->codePostal";
            return $chaine;
        }

        public static function create($donnees){
       
                $requetePreparee = "INSERT INTO Adresse ( rue, numero, ville, codePostal) 
                                VALUES ( :rue, :numero, :ville, :codePostal);";

                $resultat = connexion::pdo()->prepare($requetePreparee);

                // Assuming $donnees is your associative array with values
                $valueForRue = $donnees['rue'];
                $valueForNumero = $donnees['numero'];
                $valueForVille = $donnees['ville']; 
                $valueForCodePostal = $donnees['codePostal'];

                // Bind parameters
                $resultat->bindParam(':rue', $valueForRue);
                $resultat->bindParam(':numero', $valueForNumero);
                $resultat->bindParam(':ville', $valueForVille);
                $resultat->bindParam(':codePostal', $valueForCodePostal);

                try {
                    $resultat->execute();
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

            
        }
    }

?>