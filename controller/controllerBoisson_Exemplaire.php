<?php
    require_once("./model/Boisson.php");
    require_once("./model/Boisson_Exemplaire.php");
    require_once("controllerObjet.php");
    require_once("controllerCompte.php");

    class controllerBoisson_Exemplaire extends controllerObjet {

        protected static string $classe = "Boisson_Exemplaire";

        protected static string $identifiant = "numBoissonExemplaire";

        public static function supprimer(){
            $numBoissonExemplaire = $_GET["numBoissonExemplaire"];
            Boisson_Exemplaire::delete($numBoissonExemplaire);

            controllerCompte::displayAdminStock();
        }

        public static function create(){
            $numbreBoissonAdd = $_GET['numbreBoissonAdd'];
            for($i = 0 ; $i < $numbreBoissonAdd; $i++){
                Boisson_Exemplaire::create();
            }


            header('Location: '."index.php?objet=Compte&action=stockAdmin");

            //controllerCompte::displayAdminStock();
        }

    }
?>