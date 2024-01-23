<?php
    class objet {

        public function get($attribut) {
            return $this->$attribut;
        }
        public function set($attribut, $valeur) {
            $this->$attribut = $valeur;
        }

        public static function getAll() {
            $classeRecupere = static::$classe;
            $requete = "SELECT * FROM $classeRecupere;";
            $resultat = connexion::pdo()->query($requete);
            $resultat->setFetchmode(PDO::FETCH_CLASS,$classeRecupere);
            $tableau = $resultat->fetchAll();
            return $tableau;
        }

        public static function getOne($id) {

            $classeRecupere = static::$classe;
            $identifiant = static::$identifiant;

            $requetePreparee = "SELECT * FROM $classeRecupere WHERE $identifiant = :id_tag;";

            $resultat = connexion::pdo()->prepare($requetePreparee);

            $tags = array("id_tag" => $id);

            try {

                $resultat->execute($tags);

                $resultat->setFetchmode(PDO::FETCH_CLASS,$classeRecupere);

                $element = $resultat->fetch();

                return $element;
        
            }

            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public static function delete($id){
            //echo $id;
            $classeRecupere = static::$classe;
            $identifiant = static::$identifiant;

            $requetePreparee = "DELETE FROM $classeRecupere WHERE $identifiant = :id_tag;";
            
            $resultat = connexion::pdo()->prepare($requetePreparee);

            $tags = array("id_tag" => $id);

            try {

                $resultat->execute($tags);  
            }

            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function affichable() {
            return true;
        }

    }
?>