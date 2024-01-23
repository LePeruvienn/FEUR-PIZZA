<?php
    require_once("./model/Boisson.php");
    require_once("controllerObjet.php");

    class controllerBoisson extends controllerObjet {

        protected static string $classe = "Boisson";

        protected static string $identifiant = "numBoisson";


        public static function update(){

            Boisson::update();
        
            controllerCompte::displayAdminStock();
        }
    }
?>