<?php
    require_once("./model/session.php");




    $objet = "Pizza";

    if(isset($_GET["objet"])){
        $objet = $_GET["objet"];
    }

    $action = "displayAll";

    if(isset($_GET["action"])){ // !!!
        $action = $_GET["action"];
    }


    if(session::compteConnected()){
        if($_SESSION["isAdmin"] == 1){ 


            $objet = "Compte";
            $action = "displayAdmin";

            if (isset($_GET["objet"]) && $_GET["objet"] == "Dessert_Exemplaire" && $_GET["action"] == "supprimer") {
                $objet = "Dessert_Exemplaire";
                $action = "supprimer";
            }else if (isset($_GET["selectDessertForm"]) && $_GET["action"] == "stockAdmin") {
                $objet = "Dessert_Exemplaire";
                $action = "create";
            }
            else if (isset($_GET["objet"]) && $_GET["objet"] == "Boisson_Exemplaire" && $_GET["action"] == "supprimer") {
                $objet = "Boisson_Exemplaire";
                $action = "supprimer";
            }
            else if (isset($_GET["selectBoissonForm"]) && $_GET["action"] == "stockAdmin") {
                $objet = "Boisson_Exemplaire";
                $action = "create";
            }else if (isset($_GET["prix"]) && $_GET["action"] == "create") {
                $objet = "Pizza";
                $action = "create";
            }else if (isset($_GET["objet"]) && $_GET["objet"] == "Ingredient" ) {
                $objet = "Ingredient";
                $action = "update";
            }else {
                if (isset($_GET["action"])) {
                    switch ($_GET["action"]) {
                        case "enAvantPizzaAdmin":
                            $action = "displayAdminEnAvantPizza";
                            break;
                        case "Day":
                            $action = "displayAdminChiffreAffaireDay";
                            break;
                        case "Mensuel":
                            $action = "displayAdminChiffreAffaireMensuel";
                            break;
                        case "Annuel":
                            $action = "displayAdminChiffreAffaireAnnuel";
                            break;
                        case "stockAdmin":
                            $action = "displayAdminStock";
                            break;
                        case "chiffreAffaire":
                            $action = "displayAdminChiffreAffaire";
                            break;
                        case "supprimer":
                            $objet = "Pizza";
                            $action = "supprimer";
                            break;
                        case "modifyListPizzaAdmin":
                            $objet = "Pizza";
                            $action = "displayAll";
                            break;
                        case "allergene":
                            $action = "displayAllergene";
                            break;
                        case "Update":
                            $objet = "Pizza";
                            $action = "update";
                            break;
                        case "modifyPizzaAdmin":
                            $action = "displayAdminModifyPizza";
                            break;
                        case "addNewPizzaAdmin":
                            $action = "displayAdminAddNewPizza";
                            break;
                        case "PizzaMenuAdmin":
                            $action = "displayAdminGererPizza";
                            break;
                        
                        case "disconnect":
                            $action = "disconnect";
                            break;

                        case "ajouterImagePizza":
                            $action = "displayAdminAjouterImagePizza";
                            break;
                        case "updateImagePizza":
                            $action = "updateImagePizza";
                            break;
                        case "alertAdmin":
                            $action = "displayAdminAlertAdmin";
                            break;
                             
                        // Add more cases as needed
                    }
                }
            }
        }else {
            if( isset($_GET["action"]) && $_GET["action"] == "payer"){

                $action = "displayPayerForm";
            }
            if( isset($_GET["action"]) && $_GET["action"] == "Payment"){

                $action = "displayPayment";

            }
            
        }
    }//index.php?objet=Compte&action=disconnect
    else {

        $objet = "Compte";

        if(session::compteConnecting()){
            $action = "connect";
            
        }

        else {
            
            $action = "displayConnectionForm";

            if( isset($_GET["action"]) && $_GET["action"] == "displayCreationForm"){

                $action = "displayCreationForm";
            }
        

            if( isset($_GET["action"]) && $_GET["action"] == "create"){

                $action = "create";
            }

        }
    }


    $controller = "controller".ucfirst($objet);
    //echo $controller;
    require_once("$controller.php");
    require_once("./config/connexion.php");
    connexion::connect();
    $controller::$action();
?>