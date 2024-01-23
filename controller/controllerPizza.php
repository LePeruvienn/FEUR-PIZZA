<?php
    require_once("./model/Pizza.php");
    require_once("./model/Ingredient_Pizza.php");
    require_once("./controller/controllerCompte.php");
    require_once("controllerObjet.php");

    class controllerPizza extends controllerObjet {

        protected static string $classe = "Pizza";

        protected static string $identifiant = "numPizza";

        protected static $champsPizza = array( 
            "nomPizza" => ["text", "nom"], 
            "prixPizza" => ["number", "prix"], 
            "enAvant" => ["text", "enAvant"], 
            "descCourt" => ["text", "description"]
        );

        protected static $champsIngredient = array( 
            "numIngredient" => ["text", "numIngredient"], 
            "quantite" => ["text", "quantite"]
        );


        public static function supprimer(){
            $champsPizza = static::$champsPizza;
            $champsIngredient = static::$champsIngredient;

            $numPizza = $_GET["numPizza"];

            Ingredient_Pizza::supprimer($numPizza);

            Pizza::supprimer($numPizza);

            controllerPizza::displayAll();
        }

        public static function create(){
            $champsPizza = static::$champsPizza;
            $champsIngredient = static::$champsIngredient;
            $donnees = array();
            foreach ($_GET as $key => $value) { 
                    if($key == "nom" || $key == "prix" || $key == "description"|| $key == "enAvant"){
                        $donnees[$key] = $value;
                    }
                }


            /*echo "<pre>";
            print_r($donnees);
            echo "</pre>";*/
            Pizza::create($donnees);

            $donneesIngredient = array();
            $i = 0 ;
            foreach ($_GET as $key => $value) {
                if($value == NULL){
                    break;
                }
                if($key == "numIngredient".$i ){
                    $donneesIngredient[$key] = $value;
                }
                if($key == "quantite".$i){
                    $donneesIngredient[$key] = $value;
                    $i = $i+1;
                }
            }
            /*echo "<pre>";
            print_r($donneesIngredient);
            echo "</pre>";*/
            $donneesIngredient["numPizza"] = Pizza::getIdFromNom($donnees["nom"]);
           /* echo "<pre>";
            print_r($donneesIngredient);
            echo "</pre>";*/
            Ingredient_Pizza::create($donneesIngredient);
            controllerCompte::displayAdminAddNewPizza();
        }

        public static function update(){
            $champsPizza = static::$champsPizza;
            $champsIngredient = static::$champsIngredient;
            $donnees = array();
            foreach ($_GET as $key => $value) { 
                if($key == "numPizza" || $key == "nomPizza" || $key == "prixPizza" || $key == "descCourt"|| $key == "enAvant"){
                    $donnees[$key] = $value;
                    if($key == "enAvant"){
                        $donnees[$key] = (isset($_GET['enAvant'])) ? 1 : 0;
                    }
                }
            }
            Pizza::update($donnees);

            $donneesIngredient = array();
            $i = 0 ;
            foreach ($_GET as $key => $value) {
                if($value == 0){
                    break;
                }
                if($key == "numIngredient".$i ){
                    $donneesIngredient[$key] = $value;
                }
                if($key == "quantite".$i){
                    $donneesIngredient[$key] = $value;
                    $i = $i+1;
                }
            }


            /*echo "<pre>";
            print_r($donneesIngredient);
            echo "</pre>";*/
            Ingredient_Pizza::update($donneesIngredient);
        
            controllerCompte::displayAdminModifyPizza();
        }
    }
?>