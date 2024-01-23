<?php

    require_once("Pizza.php");
    require_once("Dessert.php");
    require_once("Boisson.php");

    class Panier {

        public static function createPanier(){

            if(!isset($_SESSION["panier"])){
                $_SESSION["panier"] = array(
                    "Pizza" => array(),
                    "Boisson" => array(),
                    "Dessert" => array(),
                    "Ingredient_en_plus" => array(),
                    "Ingredient_en_moins" => array()

                );
            }
        }

        public static function suppPanier() {
            if(isset($_SESSION["panier"])){
                reset($_SESSION["panier"]);
            }
        }

        public static function nbArticle(){
            return count($_SESSION["panier"]["Pizza"]) + count($_SESSION["panier"]["Boisson"]) + count($_SESSION["panier"]["Dessert"]);
        }

        public static function add($article,$type){
            array_push($_SESSION["panier"][$type],$article);
            if($type == "Pizza"){
                $index = array_key_last($_SESSION["panier"]["Pizza"]);
                $_SESSION["panier"]["Ingredient_en_plus"][$index] = array();
                $_SESSION["panier"]["Ingredient_en_moins"][$index] = array();
            }
        }

        public static function supp($id,$type){
            unset($_SESSION["panier"][$type][$id]);
            if($type == "Pizza"){
                unset($_SESSION["panier"]["Ingredient_en_plus"][$id]);
                unset($_SESSION["panier"]["Ingredient_en_moins"][$id]);
            }
        }

        public static function addSupplement($idPizza, $idIng){
            if(!in_array($idIng,$_SESSION["panier"]["Ingredient_en_plus"][$idPizza])){
                array_push($_SESSION["panier"]["Ingredient_en_plus"][$idPizza],$idIng);
            }
        }

        public static function deleteSupplement($idPizza, $idIng){
            if(in_array($idIng,$_SESSION["panier"]["Ingredient_en_plus"][$idPizza])){
                $key = array_search($idIng, $_SESSION["panier"]["Ingredient_en_plus"][$idPizza]);
                unset($_SESSION["panier"]["Ingredient_en_plus"][$idPizza][$key]);

            }
        }

        public static function addIngredientEnMoins($idPizza, $idIng){
            if(!in_array($idIng,$_SESSION["panier"]["Ingredient_en_moins"][$idPizza])){
                array_push($_SESSION["panier"]["Ingredient_en_moins"][$idPizza],$idIng);
            }
        }

        public static function suppIngredientEnMoins($idPizza, $idIng){
            if(in_array($idIng,$_SESSION["panier"]["Ingredient_en_moins"][$idPizza])){
                $key = array_search($idIng, $_SESSION["panier"]["Ingredient_en_moins"][$idPizza]);
                unset($_SESSION["panier"]["Ingredient_en_moins"][$idPizza][$key]);
            }
        }

    }
?>