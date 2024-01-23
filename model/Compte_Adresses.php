<?php
    require_once("objet.php");

    class Compte_Adresses extends objet {

        protected string $login;
        protected int $numAdresse;


        protected static string $classe = "Compte_Adresses";

        protected static string $identifiant = "numAdresse";

        public function __construct(string $login = null, int $numAdresse = null){
            
            if (!is_null($login)) {
            
                $this->login = $login;
                $this->numAdresse = $numAdresse;

            }
        }

        public function get($attribut) {
            return $this->$attribut;
        }
        
        public function __toString() {
            $chaine = "Le compte $this->login possede l'addresse $this->numAdresse";
            return $chaine;
        }

        public static function getAll() {
            $requete = "SELECT * FROM Compte_Adresses;";
            $resultat = connexion::pdo()->query($requete);
            $resultat->setFetchmode(PDO::FETCH_CLASS,"Compte_Adresses");
            $tableau = $resultat->fetchAll();
            return $tableau;
        }

        public static function getAllOfLogin($id) {

            $classeRecupere = "Compte_Adresses";
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
            $requetePreparee = "INSERT INTO Compte_Adresses ( login, numAdresse) 
            VALUES ( :login, :numAdresse)";

            $resultat = connexion::pdo()->prepare($requetePreparee);

            // Assuming $donnees is your associative array with values
            $valueForLogin = $_SESSION['login'];
            $valueForNumAdresse = intval($donnees['numAdresse']);
            // Bind parameters
            $resultat->bindParam(':login', $valueForLogin);
            $resultat->bindParam(':numAdresse', $valueForNumAdresse);

            try {
                $resultat->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

    }

?>