<?php
    require_once("./model/Panier.php");
    require_once("./controller/controllerBoisson.php");
    require_once("./controller/controllerDessert.php");
    require_once("./controller/controllerPizza.php");

    class controllerPanier {

        protected static string $classe = "Panier";

        public static function displayPanier(){

            if(!empty($_SESSION["panier"]["Pizza"])){
                $selectType = "Pizza";
            }
            elseif(!empty($_SESSION["panier"]["Dessert"])){
                $selectType = "Dessert";
            }
            else {
                $selectType = "Boisson";
            }

            if(isset($_GET["selectPanier"])){
                $select = $_GET["selectPanier"];
            }
            else {
                if(isset(array_values($_SESSION["panier"][$selectType])[0])){
                    $val = array_values($_SESSION["panier"][$selectType])[0];
    
                    $select = array_search($val,$_SESSION["panier"][$selectType]);
    
                    $title = "Panier";
                }
                else {
                    $select = 0;
                }
            }

            if(isset($_GET["selectType"])){
                $selectType = $_GET["selectType"];
            }

            $title = "Panier";

            include("./view/debut.php");
            include("./view/menu.php");
            include("./view/PanierVue.php");
            include("./view/fin.php");
        }

        public static function add(){
            if(isset($_GET["articleAdd"])){
                $article = $_GET["articleAdd"];
                $type = $_GET["type"];
                Panier::add($article,$type);
                $objet="controller".$type;
                $objet::displayAll();
            }
        }

        public static function addSupplement(){

            if(isset($_GET["suppSelect"]) && isset($_GET["idPizza"])){
                $numIngredient = $_GET["suppSelect"];
                $NumPizza = $_GET["idPizza"];

                Panier::addSupplement($NumPizza,$numIngredient);

                self::displayPanier();
            }
        }

        public static function deleteSupplement(){

            if(isset($_GET["Ingredient"]) && isset($_GET["idPizza"])){
                $numIngredient = $_GET["Ingredient"];
                $NumPizza = $_GET["idPizza"];

                Panier::deleteSupplement($NumPizza,$numIngredient);

                self::displayPanier();
            }
            else {
                echo "erreur";
            }
        }

        public static function addIngredientEnMoins(){

            if(isset($_GET["Ingredient"]) && isset($_GET["idPizza"])){
                $numIngredient = $_GET["Ingredient"];
                $NumPizza = $_GET["idPizza"];

                Panier::addIngredientEnMoins($NumPizza,$numIngredient);

                self::displayPanier();
            }
        }

        public static function suppIngredientEnMoins(){

            if(isset($_GET["Ingredient"]) && isset($_GET["idPizza"])){
                $numIngredient = $_GET["Ingredient"];
                $NumPizza = $_GET["idPizza"];

                Panier::suppIngredientEnMoins($NumPizza,$numIngredient);

                self::displayPanier();
            }
        }

        public static function supp(){
            if(isset($_GET["idSupp"])){
                $id = $_GET["idSupp"];
                $type = $_GET["type"];
                Panier::supp($id,$type);
                self::displayPanier();
            }
        }

        public static function addIngredient(){
            if(isset($_GET["idIngredientEnPlus"])){
                $id = $_GET["idIngredientEnPlus"];
                $type = "Ingredient_en_plus";
                Panier::supp($id,$type);
                self::displayPanier();
            }
        }
    }
?>