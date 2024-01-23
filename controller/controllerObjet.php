<?php

    class controllerObjet {

        public static function displayAll(){
            if($_SESSION["isAdmin"] == 1){ 
                $classeRecupere = static::$classe;
                $identifiant = static::$identifiant;
                $title = "$classeRecupere";
                include("./view/debut.php");
                include("./view/debutAdmin.php");
                $tableau = $classeRecupere::getAll();
                include("./view/list.php");
                include("./view/finAdminIndex.php");
            }else{

                $classeRecupere = static::$classe;
                $identifiant = static::$identifiant;
                
                $title = "$classeRecupere";
    
                include("./view/debut.php");
                include("./view/menu.php");
                $tableau = $classeRecupere::getAll();
    
                if($classeRecupere == "Pizza"){
                    require_once("./model/Ingredient_Pizza.php");
                    require_once("./model/Ingredient.php");
                    include("./view/Pizza/affichePizza.php");
                }
    
                include("./view/list.php");
    
                include("./view/fin.php");
            }
        }

        public static function displayOne() {

            $classeRecupere = static::$classe;
            $identifiant = static::$identifiant;

            $id = $_GET[$identifiant];

            $title = "un(e) $classeRecupere";

            if(isset($_GET["identifiant"])){
                $identifiant = $_GET["identifiant"];
            }

            include("./view/debut.php");
            include("./view/menu.php");

            $element = $classeRecupere::getOne($id);

            include("./view/detail.php");

            include("./view/fin.php");
        }

        public static function ChiffreAffaireJournalier() {
            $requete = " SELECT `ChiffreAffaireJournalier`() AS `ChiffreAffaireJournalier`;";
            $resultat = connexion::pdo()->query($requete);
            $tableau = $resultat->fetchAll();
            return $tableau;
        }

        public static function ChiffreAffaireMensuel() {
            $requete = " SELECT `ChiffreAffaireMensuel`() AS `ChiffreAffaireMensuel`;";
            $resultat = connexion::pdo()->query($requete);
            $tableau = $resultat->fetchAll();
            return $tableau;
        }

        public static function ChiffreAffaireAnnuel() {
            $requete = " SELECT `ChiffreAffaireAnnuel`() AS `ChiffreAffaireAnnuel`;";
            $resultat = connexion::pdo()->query($requete);
            $tableau = $resultat->fetchAll();
            return $tableau;
        }

        public static function PizzaPlusVendue() {
            $requete = " SELECT `PizzaPlusVendue`() AS `PizzaPlusVendue`;";
            $resultat = connexion::pdo()->query($requete);
            $tableau = $resultat->fetchAll();
            return $tableau;
        }

        
        public static function DessertPlusVendu() {
            $requete = " SELECT `DessertPlusVendu`() AS `DessertPlusVendu`;";
            $resultat = connexion::pdo()->query($requete);
            $tableau = $resultat->fetchAll();
            return $tableau;
        }

        
        public static function BoissonPlusVendue() {
            $requete = " SELECT `BoissonPlusVendue`() AS `BoissonPlusVendue`;";
            $resultat = connexion::pdo()->query($requete);
            $tableau = $resultat->fetchAll();
            return $tableau;
        }
        

    }
?>