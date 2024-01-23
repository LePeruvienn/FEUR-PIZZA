<?php
    require_once("./model/Compte.php");
    require_once("./model/Pizza.php");
    require_once("./model/Dessert.php");
    require_once("./model/Boisson.php");
    require_once("./model/Dessert_Exemplaire.php");
    require_once("./model/Boisson_Exemplaire.php");
    require_once("./model/Commande_Desserts.php");
    require_once("./model/Commande_Boissons.php");
    require_once("./model/Ingredient.php");
    require_once("./model/Ingredient_en_moins.php");
    require_once("./model/Ingredient_en_plus.php");
    require_once("./model/Ingredient_Pizza.php");
    require_once("./model/Panier.php");
    require_once("./model/CarteDeCredit.php");
    require_once("./model/Commande.php");
    require_once("./model/Commande_Desserts.php");
    require_once("./model/Commande_Boissons.php");
    require_once("./model/Commande_Pizzas.php");
    require_once("./model/Pizza_exemplaire.php");
    require_once("./model/Adresse.php");
    require_once("./model/Compte_Adresses.php");
    require_once("./model/Alerte.php");
    
    require_once("controllerObjet.php");

    class controllerCompte extends controllerObjet {

        protected static string $classe = "Compte";

        protected static string $identifiant = "login";

        
        protected static $champs = array( 
            "login" => ["text", "identifiant"], 
            "mdp" => ["password", "mot de passe"], 
            "nomAdherent" => ["text", "nom"], 
            "prenomAdherent" => ["text", "prénom"], 
            "email" => ["email", "email"],
            "telephone" => ["text", "téléphone"]
        );


        public static function displayConnectionForm() {

            $title = "Connexion";

            include("./view/debut.php");
    
            include("./view/formulaireConnexion.html");
    
            include("./view/fin.php");
        }

        
        public static function displayPayment() {
            $erreur = false;
            
            //crée un nouvelle carte de crédit si elle existe pas
            if(isset($_GET["carteDeCredit"])){
                $idCarte = $_GET["carteDeCredit"];
                $carte = CarteDeCredit::getOne($idCarte);
                $dataCarte = array();
                $dataCarte["numCarteDeCredit"] = $carte->get("numCarteDeCredit");
            }
            else {
                $erreur = true;
            }

            $ruptureDeStockIngredient = array();
            $ruptureDeStockDessert = array();
            $ruptureDeStockBoisson = array();

            $nbDispoArray = array(
                "Boisson" => array(),
                "Dessert" => array(),
                "Ingredient" => array()
            );

            foreach($_SESSION["panier"]["Pizza"] as $idPanier => $numPizza){

                $IngredientPizza = Ingredient_Pizza::getOnePizza($numPizza);
                $listeIngredientQuantite = array();

                foreach($IngredientPizza as $unIngredientPizza){
                    if($unIngredientPizza->get("quantite") !== 0){
                        $listeIngredientQuantite[$unIngredientPizza->get("numIngredient")] = $unIngredientPizza->get("quantite");
                    }
                }

                foreach($_SESSION["panier"]["Ingredient_en_moins"][$idPanier] as $idIngredient){
                    if(array_key_exists($idIngredient, $listeIngredientQuantite)){
                        unset($listeIngredientQuantite[$idIngredient]);
                    }
                }

                foreach($_SESSION["panier"]["Ingredient_en_plus"][$idPanier] as $idIngredient){
                    $listeIngredientQuantite[$idIngredient] = Ingredient::getOne($idIngredient)->get("quantiteSupplement");
                }

                foreach($listeIngredientQuantite as $id => $quant){
                    $ingre = Ingredient::getOne($id);
                    $ingRestant = $ingre->get("quantiteEnStock");

                    if(isset($nbDispoArray["Ingredient"][$id])){
                        $nbDispoArray["Ingredient"][$id] += $quant;
                        $verif = $ingRestant - $nbDispoArray["Ingredient"][$id];
                        if($verif < 0){
                            $erreur = true;
                            if(!in_array($ingre,$ruptureDeStockIngredient)){
                                array_push($ruptureDeStockIngredient,$ingre);
                            }
                        }
                    }
                    else {
                        $nbDispoArray["Ingredient"][$id] = $quant;
                        $verif = $ingRestant - $nbDispoArray["Ingredient"][$id];
                        if($verif < 0){
                            $erreur = true;
                            if(!in_array($ingre,$ruptureDeStockIngredient)){
                                array_push($ruptureDeStockIngredient,$ingre);
                            }
                        }
                    }
    
                }
            }


            foreach($_SESSION["panier"]["Boisson"] as $numBoisson){

                if(isset($nbDispoArray["Boisson"][$numBoisson])){
                    $nbDispoArray["Boisson"][$numBoisson]++;
                    $verif = Boisson_Exemplaire::nbDispo($numBoisson) - $nbDispoArray["Boisson"][$numBoisson];
                    if($verif < 0){
                        $erreur = true;
                        if(!in_array($numBoisson,$ruptureDeStockBoisson)){
                            array_push($ruptureDeStockBoisson,$numBoisson);
                        }
                    }
                }
                else {
                    if(Boisson_Exemplaire::existe($numBoisson)){
                        $nbDispoArray["Boisson"][$numBoisson] = 1;
                    }
                    else {
                        $erreur = true;
                        if(!in_array($numBoisson,$ruptureDeStockBoisson)){
                            $nbDispoArray["Boisson"][$numBoisson] = 1;
                            array_push($ruptureDeStockBoisson,$numBoisson);
                        }
                    }
                }
            }

            foreach($_SESSION["panier"]["Dessert"] as $numDessert){

                if(isset($nbDispoArray["Dessert"][$numDessert])){
                    $nbDispoArray["Dessert"][$numDessert]++;
                    $verif = Dessert_Exemplaire::nbDispo($numDessert) - $nbDispoArray["Dessert"][$numDessert];
                    if($verif < 0){
                        $erreur = true;
                        if(!in_array($numDessert,$ruptureDeStockDessert)){
                            array_push($ruptureDeStockDessert,$numDessert);
                        }
                    }
                }
                else {
                    if(Dessert_Exemplaire::existe($numDessert)){
                        $nbDispoArray["Dessert"][$numDessert] = 1;
                    }
                    else {
                        $erreur = true;
                        if(!in_array($numDessert,$ruptureDeStockDessert)){
                            $nbDispoArray["Dessert"][$numDessert] = 1;
                            array_push($ruptureDeStockDessert,$numDessert);
                        }
                    }
                }
            }

            if(!$erreur){

                //------------------------

                //crée une commande avec la session
                Commande::create($dataCarte);

                //get la derniére commande
                $requetePreparee = "SELECT * FROM Commande ORDER BY dateCommande DESC LIMIT 1;";
                $resultat = connexion::pdo()->prepare($requetePreparee);
                try {
                    $resultat->execute();
                    $derniereCommande = $resultat->fetch(PDO::FETCH_ASSOC);
                    //print_r($derniereCommande);
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

                //crée une commande_Boisson avec la session
                foreach($_SESSION["panier"]["Boisson"] as $numBoisson){
                    Commande_Boissons::create($numBoisson,$derniereCommande);
                }
                //crée une commande_Dessert avec la session
                foreach($_SESSION["panier"]["Dessert"] as $numDessert){
                    Commande_Desserts::create($numDessert,$derniereCommande);
                }
                //crée une Pizza_exemplaire avec la session
                //crée une commande_Pizza avec la session

                foreach($_SESSION["panier"]["Pizza"] as $idPanier => $numPizza){

                    Pizza_exemplaire::create($numPizza);

                    // ON PREND LA DERNIERE PIZZA EXEMPLAIRE CREER
                    $requetePreparee = "SELECT * FROM Pizza_exemplaire ORDER BY numPizzaExemplaire DESC LIMIT 1;";
                    $resultat = connexion::pdo()->prepare($requetePreparee);
                    try {
                        $resultat->execute();
                        $denierePizzaExemplaire = $resultat->fetch(PDO::FETCH_ASSOC);
                        //print_r($derniereCommande);
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }

                    $numPizzaExemplaire = $denierePizzaExemplaire["numPizzaExemplaire"];

                    foreach($_SESSION["panier"]["Ingredient_en_moins"][$idPanier] as $idIngredient){
                        Ingredient_en_moins::create($idIngredient,$numPizzaExemplaire);
                    }

                    foreach($_SESSION["panier"]["Ingredient_en_plus"][$idPanier] as $idIngredient){
                        Ingredient_en_plus::create($idIngredient,$numPizzaExemplaire);
                    }

                    $IngredientPizza = Ingredient_Pizza::getOnePizza($numPizza);
                    $listeIngredientQuantite = array();

                    foreach($IngredientPizza as $unIngredientPizza){
                        if($unIngredientPizza->get("quantite") !== 0){
                            $listeIngredientQuantite[$unIngredientPizza->get("numIngredient")] = $unIngredientPizza->get("quantite");
                        }
                    }

                    foreach($_SESSION["panier"]["Ingredient_en_moins"][$idPanier] as $idIngredient){
                        if(array_key_exists($idIngredient, $listeIngredientQuantite)){
                            unset($listeIngredientQuantite[$idIngredient]);
                        }
                    }

                    foreach($_SESSION["panier"]["Ingredient_en_plus"][$idPanier] as $idIngredient){
                        $listeIngredientQuantite[$idIngredient] = Ingredient::getOne($idIngredient)->get("quantiteSupplement");
                    }

                    foreach($listeIngredientQuantite as $id => $quant){
                        $ingre = Ingredient::getOne($id);
                        $newQuantite = $ingre->get("quantiteEnStock") - $quant;
                        $ingre->upadteQuantite($newQuantite);
                    }

                    Commande_Pizzas::create($numPizza,$derniereCommande);
                }

                reset($_SESSION["panier"]["Pizza"]);
                reset($_SESSION["panier"]["Boisson"]);
                reset($_SESSION["panier"]["Dessert"]);
                reset($_SESSION["panier"]["Ingredient_en_plus"]);
                reset($_SESSION["panier"]["Ingredient_en_moins"]);
            }
            

            include("./view/debut.php");
    
            include("./view/menu.php");

            include("./view/apresPayer.php");
            
            include("./view/fin.php");
        }

        public static function displayCreationForm() {
            $champs = static::$champs;
            $classe = static::$classe;
            $identifiant = static::$identifiant;
            
            $title = "Create ".$classe;

            include("./view/debut.php");
    
            include("./view/formulaireCreation.php");
    
            include("./view/fin.php");
        }

        public static function displayAdminAlertAdmin(){


            $AllAlerteNotInv = Alerte::getall();

            $AllAlerte = array_reverse($AllAlerteNotInv);

            include("./view/debut.php");

            include("./view/alertAdmin.php");
            include("./view/fin.php");
        }

        public static function displayPayerForm() {
            include("./view/debutPayer.php");

            $Compte_Adresses = Compte_Adresses::getAllOfLogin($_SESSION["login"]);
            $cartes = CarteDeCredit::getAllOfLogin($_SESSION["login"]);
            //echo"<pre>";
            //print_r($Compte_Adresses);
            //echo"<pre>";
            $compteAdressesArray = array();
            $i = 0;
            foreach ($Compte_Adresses as $Ad){
                
                //print_r($Ad);
                $numAdresse = $Ad->get("numAdresse");
                //echo $numAdresse;
                $adresse = adresse::getOne($numAdresse);
                //print_r($adresse);
                $compteAdressesArray[$i] = $adresse;
                $i = $i + 1;
            }



            include("./view/menu.php");
            include("./view/payer.php");
            include("./view/fin.php");
        }

        public static function displayAdmin() {
            include("./view/debutAdmin.php");
            include("./view/menuAdmin.php");
            include("./view/fin.php");
        }

        public static function displayAdminGererPizza() {
            include("./view/debutAdmin.php");
            include("./view/pizzaMenuAdmin.php");
            include("./view/fin.php");
        }

        public static function displayAdminStock() {
            include("./view/debutAdmin.php");
            $ingredient = Ingredient::getAll();
            $dessert = Dessert::getAll();
            $boisson = Boisson::getAll();
            $dessert_Exemplaire = Dessert_Exemplaire::getAll();
            $boisson_Exemplaire = Boisson_Exemplaire::getAll();
            $commande_Desserts = Commande_Desserts::getAll();
            $commande_Boissons = Commande_Boissons::getAll();
            include("./view/stockAdmin.php");
            include("./view/fin.php");
        }

        public static function displayAdminChiffreAffaireDay() {
            include("./view/debutAdmin.php");
            $ChiffreAffaireJournalier = controllerCompte::ChiffreAffaireJournalier();
            $PizzaPlusVendue = controllerCompte::PizzaPlusVendue();
            $DessertPlusVendu = controllerCompte::DessertPlusVendu();
            $BoissonPlusVendue = controllerCompte::BoissonPlusVendue();
            include("./view/statAdminDay.php");
            include("./view/fin.php");
        }
        public static function displayAdminChiffreAffaireMensuel() {
            include("./view/debutAdmin.php");
            $ChiffreAffaireMensuel = controllerCompte::ChiffreAffaireMensuel();
            $PizzaPlusVendue = controllerCompte::PizzaPlusVendue();
            $DessertPlusVendu = controllerCompte::DessertPlusVendu();
            $BoissonPlusVendue = controllerCompte::BoissonPlusVendue();
            include("./view/statAdminMensuel.php");
            include("./view/fin.php");
        }
        public static function displayAdminChiffreAffaireAnnuel() {
            include("./view/debutAdmin.php");
            $ChiffreAffaireAnnuel = controllerCompte::ChiffreAffaireAnnuel();
            $PizzaPlusVendue = controllerCompte::PizzaPlusVendue();
            $DessertPlusVendu = controllerCompte::DessertPlusVendu();
            $BoissonPlusVendue = controllerCompte::BoissonPlusVendue();
            include("./view/statAdminAnnuel.php");
            include("./view/fin.php");
        }

        public static function displayAdminAddNewPizza() {
            include("./view/debutAdmin.php");
            $ingredient = Ingredient::getAll();
            include("./view/addNewPizzaAdmin.php");
            include("./view/fin.php");
        }

        public static function displayAdminModifyPizza() {
            include("./view/debutAdmin.php");
            
            $title = "Info Pizza";

            $pizza = Pizza::getOne($_GET["numPizza"]);

            $ingredient = Ingredient::getAll();

            $pizza_ingredient = Ingredient_Pizza::getAllOfid($_GET["numPizza"]);
            
            include("./view/modifyPizzaAdmin.php");
            include("./view/finAdmin.php");
        }

        public static function displayAdminAjouterImagePizza(){
            
            include("./view/debutAdmin.php");
            $title = "Image Pizza";

            $pizza = Pizza::getOne($_GET["numPizza"]);

            include("./view/addImagePizzaAdmin.php");

            include("./view/finAdmin.php");
        }

        public static function updateImagePizza(){
            
            // Vérifie si le formulaire a été soumis
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupérer le fichier envoyé
                $image = $_FILES["image"];

                $nomPizza = $_POST["nomPizza"];

            
                // Vérifier si le fichier existe
                $uploadDir = "/var/www/html/saes3-apinel2/interface_commande/img/Pizza/";
                $destination = $uploadDir .str_replace(' ','',$nomPizza). ".png";
            
                if (file_exists($destination)) {
                    // Supprimer le fichier existant
                    unlink($destination);
                }
            
                // Déplacer le nouveau fichier vers le dossier de destination
                move_uploaded_file($image["tmp_name"], $destination);

                clearstatcache();
                opcache_reset();

                self::displayAdminGererPizza();
            }
        }

        public static function displayAdminEnAvantPizza() {
            include("./view/debutAdmin.php");
            include("./view/enAvantPizzaAdmin.php");
            include("./view/fin.php");
        }

        public static function displayAllergene() {
            include("./view/debutAdmin.php");
            $article = Pizza::getOne($_GET["numPizza"]);
            include("./view/allergeneAdmin.php");
            include("./view/fin.php");
        }
        
        
        //objet=Compte& action=create& login=e&mdp=A24uCVeVjTbvWjw& nomAdherent=e& prenomAdherent=e& email=e%40m& telephone=e
        public static function create(){
            $champs = static::$champs;
            $donnees = array();
            foreach ($_GET as $key => $value) { 
                if(!($key == "objet" || $key == "action")){
                    $donnees[$key] = $value;
                }
                if($key == "mdp"){
                    $hashedPassword = password_hash($value, PASSWORD_BCRYPT);
                    $donnees[$key] = $hashedPassword;
                }
            }

            Compte::create($donnees);
            self::connect();
            self::displayAll();
        }

        public static function update(){
            $champs = static::$champs;
            $donnees = array();
            foreach ($_GET as $key => $value) { 
                if(!($key == "objet" || $key == "action")){
                    $donnees[$key] = $value;
                }
            }

            $donnees["id"] = $_SESSION["login"];

            Compte::update($donnees);
            self::displayCompte();
        }

        public static function connect() {
            
            $l = $_GET["login"];
            $m = $_GET["mdp"];

            if(Compte::checkMDP($l,$m)){
                $_SESSION["login"] = $l;
                $_SESSION["isAdmin"] = Compte::GetOne($l)->isAdmin();
                Panier::createPanier();
                header('Location:index.php'); 
            }
            else {
                self::displayConnectionForm();
            }
        }

        public static function creationadresse() {
            $dataAdresse = array();
            foreach ($_GET as $cle => $valeur) {
                if($cle != "compte" || $cle != "action" ){
                    $dataAdresse[$cle] = $valeur;
                }
            }
            Adresse::create($dataAdresse);

            //get la derniére commande
            $requetePreparee = "SELECT * FROM Adresse ORDER BY numAdresse DESC LIMIT 1;";
            $resultat = connexion::pdo()->prepare($requetePreparee);
            try {
                $resultat->execute();
                $derniereAdresse = $resultat->fetch(PDO::FETCH_ASSOC);
                //print_r($derniereAdresse);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            Compte_Adresses::create($derniereAdresse);
            
            self::displayCompte();
        }

        public static function creationCarte() {
            $dataCarte = array();
            foreach ($_GET as $cle => $valeur) {
                if($cle != "compte" || $cle != "action" ){
                    $dataCarte[$cle] = $valeur;
                }
            }

            CarteDeCredit::create($dataCarte);

            self::displayCompte();
         }

         public static function supprCarte() {
            $CCV = $_GET['CCV'];
            $Name = $_GET['nomTitulaire'];
            
            $carte = CarteDeCredit::getOneNameCCV($Name,$CCV);
            if($carte != ""){
                $id = $carte->getNumCarteDeCredit(); // Utilise la méthode getter pour obtenir le numéro de carte
                Commande::deleteCarte($id);
                CarteDeCredit::delete($id);
            }
                

                self::displayCompte();
         }     
         

         public static function supprAdresse() {

            $numAdresse = $_GET['numAdresse'];
            Compte_Adresses::delete($numAdresse);
            Adresse::delete($numAdresse);

            self::displayCompte();
         }

        public static function displayCompte(){

            require_once("./model/CarteDeCredit.php");
            require_once("./model/Compte_Adresses.php");
            require_once("./model/Adresse.php");
            
            $title = "Info Compte";

            $compte = Compte::getOne($_SESSION["login"]);

            $compte_adr = Compte_Adresses::getAllOfLogin($_SESSION["login"]);

            $adresses = array();

            foreach($compte_adr as $unCompte_Adr){
                array_push($adresses,Adresse::getOne($unCompte_Adr->get("numAdresse")));
            }

            $cartes = CarteDeCredit::getAllOfLogin($_SESSION["login"]);

            include("./view/debut.php");
            include("./view/menu.php");
            include("./view/Compte/detailCompte.php");
            include("./view/fin.php");
        }



        public static function disconnect() {
            session_unset();
            session_destroy();
            setcookie(session_name(), '', time()-1);
            self::displayConnectionForm();
        }


    }

?>