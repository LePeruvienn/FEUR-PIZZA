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
            // objet=Compte&action=Payment&cardholder_name=max&card_number=4224242424&expiry_date=24&cvv=42
            //crée un nouvelle carte de crédit si elle existe pas
            $dataCarte = array();
            foreach ($_GET as $cle => $valeur) {
                if($cle != "compte" || $cle != "action" ){
                    $dataCarte[$cle] = $valeur;
                }
            }

            CarteDeCredit::create($dataCarte);
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
            foreach($_SESSION["panier"]["Pizza"] as $numPizza){
                Pizza_exemplaire::create($numPizza);
                Commande_Pizzas::create($numPizza,$derniereCommande);
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

        public static function displayPayerForm() {
            include("./view/debutPayer.php");
/*
            $Compte_Adresses = Compte_Adresses::getAllOfLogin($_SESSION["login"]);
            echo"eee";
            print_r($Compte_Adresses);
            
            print_r($Compte_Adresses);
            echo"<pre>";
            $i = 0;
            foreach ($Compte_Adresses as $Add){
                echo $Add[$i]['numAdresse'];

                $adresse = adresse::getOne();
                $i = $i + 1;
            }*/

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

                echo $nomPizza;
            
                // Vérifier si le fichier existe
                $uploadDir = "/var/www/html/saes3-apinel2/interface_commande/img/Pizza/";
                $destination = $uploadDir . $nomPizza . ".png";
            
                if (file_exists($destination)) {
                    // Supprimer le fichier existant
                    unlink($destination);
                }
            
                // Déplacer le nouveau fichier vers le dossier de destination
                move_uploaded_file($image["tmp_name"], $destination);
            
                echo "L'image a été enregistrée avec succès.";

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
            $num = $_GET['carteNum'];
            
            $carte = CarteDeCredit::getOne($num);
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