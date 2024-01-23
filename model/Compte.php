<?php

    require_once("objet.php");

    class Compte extends objet {

        protected static string $classe = "Compte";

        protected static string $identifiant = "login";

        protected string $login;
        protected string $nom;
        protected string $prenom;
        protected string $mdp;
        protected string $email;
        protected string $telephone;
        protected bool $isAdmin;

        public function __construct(string $login = null, string $nom = null, string $prenom = null, string $mdp = null, string $email = null, string $telephone = null, bool $isAdmin = null){
            
            if (!is_null($login)) {
            
                $this->login = $login;
                $this->nom = $nom;
                $this->prenom = $prenom;
                $this->mdp = $mdp;
                $this->email = $email;
                $this->telephone = $telephone;
                $this->isAdmin = $isAdmin;
            }
        }
        
        public function __toString() {
            $chaine = "Client $this->login ($this->nom $this->prenom) $this->email";
            return $chaine;
        }

        public function affichable() {
            $res = $this->isAdmin == 0;
            return $res;
        }

        public function isAdmin() {
            return $this->isAdmin == 1;
        }

        public static function create($donnees){


            $requetePreparee = "INSERT INTO Compte (`login`, `nom`, `prenom`, `mdp`, `email`, `telephone`) 
            VALUES (:login, :nomAdherent, :prenomAdherent, :mdp, :email, :telephone);";

            $resultat = connexion::pdo()->prepare($requetePreparee);
            try{
                $resultat->execute($donnees);
                
            }catch(PDOExeption $e){
                echo "<h1> ERREUR </h1>
                <h1> ERREUR CE LOGIN EST DEJA UTILISER</h1>";
            }
            
            
        }

        public static function update($donnees){
            $requetePreparee = "UPDATE `Compte` SET 
                `login` = :login, 
                `nom` = :nom, 
                `prenom` = :prenom, 
                `mdp` = :mdp, 
                `email` = :email, 
                `telephone` = :telephone 
                WHERE `Compte`.`login` = :id;";
                
            $resultat = connexion::pdo()->prepare($requetePreparee);
            try{
                foreach ($donnees as $key => $value) {
                    if($key == "mdp"){
                        $hashedPassword = password_hash($value, PASSWORD_BCRYPT);
                        $donnees[$key] = $hashedPassword;
                    }
                }
                $resultat->execute($donnees);
            }catch(PDOExeption $e){
                echo $e->getMessage();

            }
        }

        public static function checkMDP($l,$m) {

            $requetePreparee = "SELECT mdp FROM Compte WHERE login = :login_tag";

            $resultat = connexion::pdo()->prepare($requetePreparee);

            $resultat->bindParam(':login_tag', $l);

            try {

                $resultat->execute();
                //print_r( $resultat);
                $resultat->setFetchmode(PDO::FETCH_CLASS,"Compte");
                
                $tableau = $resultat->fetchAll();
                //print_r( $tableau);
                foreach ($tableau as $hashedPassword) {
                    if (password_verify($m, $hashedPassword->get("mdp"))) {
                        return 1;
                    }
                }
                return 0;
            }

            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }

?>