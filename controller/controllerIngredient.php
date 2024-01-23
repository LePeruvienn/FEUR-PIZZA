<?php
    require_once("./model/Pizza.php");
    require_once("./model/Ingredient_Pizza.php");
    require_once("./controller/controllerCompte.php");
    require_once("controllerObjet.php");

    class controllerIngredient extends controllerObjet {

        protected static string $classe = "Ingredient";

        protected static string $identifiant = "numIngredient";

        protected static $champsIngredient = array( 
            "numIngredient" => ["text", "numIngredient"], 
            "quantite" => ["text", "quantite"]
        );

        public static function update(){

            Ingredient::update();
        
            controllerCompte::displayAdminStock();
        }
    }
?>