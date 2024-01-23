<?php
    require_once("./model/Dessert.php");
    require_once("./model/Dessert_Exemplaire.php");
    require_once("controllerObjet.php");

    class controllerDessert extends controllerObjet {

        protected static string $classe = "Dessert";

        protected static string $identifiant = "numDessert";

        public static function update(){

            //Dessert_Exemplaire::update();
        
            controllerCompte::displayAdminStock();

        }

        public static function supprimer(){

            Dessert::delete($_GET["numDessert"]);
        

            controllerCompte::displayAdminStock();
        }
    }
?>