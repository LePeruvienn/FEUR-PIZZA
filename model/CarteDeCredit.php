<?php

    require_once("objet.php");

    class CarteDeCredit extends objet {

        protected static string $classe = "CarteDeCredit";

        protected static string $identifiant = "numCarteDeCredit";

        protected int $numCarteDeCredit;
        protected string $nomTitulaire;
        protected string $numeros;
        protected string $dateExpiration;
        protected int $CCV;
        protected string $login;

        public function __construct(int $numCarteDeCredit = null, string $nomTitulaire = null, int $numeros= null, string $dateExpiration = null, int $CCV = null, string $login = null){
            
            if (!is_null($numCarteDeCredit)) {
            
                $this->numCarteDeCredit = $numCarteDeCredit;
                $this->nomTitulaire = $nomTitulaire;
                $this->numeros = $numeros;
                $this->dateExpiration = $dateExpiration;
                $this->CCV = $CCV;
                $this->login = $login;
            }
        }
        
        public function __toString() {
            $chaine = "Carte de $this->nomTitulaire, numéro : $this->numeros, date d'expiration $this->dateExpiration, CCV : $this->CCV.";
            return $chaine;
        }

        public function getNumCarteDeCredit() {
            return $this->numCarteDeCredit;
        }

        public static function getOneNumero($numeros) {

            $requetePreparee = "SELECT * FROM CarteDeCredit WHERE numeros = :numeros;";

            $resultat = connexion::pdo()->prepare($requetePreparee);

            $tags = array("numeros" => $numeros);

            try {

                $resultat->execute($tags);

                $resultat->setFetchmode(PDO::FETCH_CLASS,"CarteDeCredit");

                $element = $resultat->fetch();

                return $element;
        
            }

            catch(PDOException $e){
                echo $e->getMessage();
            }
        } 
        
        public static function getOneNameCCV($Name,$CCV) {

            $requetePreparee = "SELECT * FROM CarteDeCredit WHERE nomTitulaire = :nomTitulaire AND CCV = :CCV;";

            $resultat = connexion::pdo()->prepare($requetePreparee);

            $resultat->bindParam(':nomTitulaire', $Name);
            $resultat->bindParam(':CCV', $CCV);

            try {

                $resultat->execute();

                $resultat->setFetchmode(PDO::FETCH_CLASS,"CarteDeCredit");

                $element = $resultat->fetch();

                return $element;
        
            }

            catch(PDOException $e){
                echo $e->getMessage();
            }
        } 


        public static function getAllOfLogin($id) {

            $classeRecupere = "CarteDeCredit";
            $identifiant = "login";

            $requetePreparee = "SELECT * FROM $classeRecupere WHERE $identifiant = :id_tag;";

            $resultat = connexion::pdo()->prepare($requetePreparee);

            $tags = array("id_tag" => $id);

            try {

                $resultat->execute($tags);

                $resultat->setFetchmode(PDO::FETCH_CLASS,$classeRecupere);

                $element = $resultat->fetchAll();

                return $element;
        
            }

            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public static function create($donnees){
            // cardholder_name=max&card_number=4224242424&expiry_date=24&cvv=42
            $numeroCarteDeCredit = $donnees['card_number'];
            $requeteVerification = "SELECT COUNT(*) FROM CarteDeCredit WHERE numeros = :numero";
            $resultatVerification = connexion::pdo()->prepare($requeteVerification);
            $resultatVerification->bindParam(':numero', $numeroCarteDeCredit);
            $resultatVerification->execute();
            $carteExiste = $resultatVerification->fetchColumn();

            if ($carteExiste > 0) {
                // La carte existe déjà, vous pouvez gérer cela comme vous le souhaitez (par exemple, afficher un message d'erreur)
                //echo "La carte de crédit existe déjà.";
            } else {
                // La carte n'existe pas, procéder à l'insertion
                $requetePreparee = "INSERT INTO CarteDeCredit ( nomTitulaire, numeros, dateExpiration, CCV, login) 
                                VALUES ( :nomTitulaire, :numeros, :dateExpiration, :CCV, :login);";

                $resultat = connexion::pdo()->prepare($requetePreparee);

                // Assuming $donnees is your associative array with values
                $valueForNomTitulaire = $donnees['cardholder_name'];
                $hashedPassword = password_hash($donnees['card_number'], PASSWORD_BCRYPT);
                $hashedPasswordSmall = substr($hashedPassword,  0, 16);
                $valueForNumeros = $hashedPasswordSmall;
                $valueForDateExpiration = $donnees['expiry_date']; 
                $valueForCCV = $donnees['cvv'];
                $valueForLogin = $_SESSION['login'];

                // Bind parameters
                $resultat->bindParam(':nomTitulaire', $valueForNomTitulaire);
                $resultat->bindParam(':numeros', $valueForNumeros);
                $resultat->bindParam(':dateExpiration', $valueForDateExpiration);
                $resultat->bindParam(':CCV', $valueForCCV);
                $resultat->bindParam(':login', $valueForLogin);

                try {
                    $resultat->execute();
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
            
        }
    }

?>