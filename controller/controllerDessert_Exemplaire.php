<?php
    require_once("./model/Dessert.php");
    require_once("./model/Dessert_Exemplaire.php");
    require_once("controllerObjet.php");
    require_once("controllerCompte.php");

    class controllerDessert_Exemplaire extends controllerObjet {

        protected static string $classe = "Dessert_Exemplaire";

        protected static string $identifiant = "numDessertExemplaire";

        public static function supprimer(){
            $numDessertExemplaire = $_GET["numDessertExemplaire"];
            Dessert_Exemplaire::delete($numDessertExemplaire);

            controllerCompte::displayAdminStock();
        }

        public static function create(){
            $numbreDessertAdd = $_GET['numbreDessertAdd'];
            for($i = 0 ; $i < $numbreDessertAdd; $i++){
                Dessert_Exemplaire::create();
            }



            controllerCompte::displayAdminStock();
        }

    }
?>