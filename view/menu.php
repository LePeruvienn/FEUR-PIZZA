
<header><?php
    require_once("./model/Pizza.php");
    require_once("./model/Boisson.php");
    require_once("./model/Dessert.php");

        $prixTotalPanier = 0;
        $prixTotalPanierPizza = 0;
        $prixTotalPanierBoisson = 0;
        $prixTotalPanierDessert = 0;
        /*echo "<pre>";print_r($_SESSION["panier"]["Pizza"]);echo "<pre>";*/
        foreach($_SESSION["panier"]["Pizza"] as $PizzaId){
            $Pizza = Pizza::getOne($PizzaId);
            /*echo "<pre>";print_r($Pizza);echo "<pre>";*/
            $prixPizza = $Pizza->get("prixPizza");
            $prixTotalPanierPizza =  $prixTotalPanierPizza + $prixPizza;
            /*echo "<pre>";print_r($Pizza);echo "<pre>";*/
        }
        foreach($_SESSION["panier"]["Boisson"] as $BoissonId){
            $Boisson = Boisson::getOne($BoissonId);
            $prixBoisson = $Boisson->get("prixBoisson");
            $prixTotalPanierBoisson =  $prixTotalPanierBoisson + $prixBoisson;
        }
        foreach($_SESSION["panier"]["Dessert"] as $DessertId){
            $Dessert = Dessert::getOne($DessertId);
            $prixDessert = $Dessert->get("prixDessert");
            $prixTotalPanierDessert =  $prixTotalPanierDessert + $prixDessert;
        }
        $prixTotalPanier = $prixTotalPanierPizza + $prixTotalPanierBoisson + $prixTotalPanierDessert;

       ?>

    <div class="bar">
        <div class="logobar">
            <img src="img/pizza.png">
            <h1>FEUR PIZZA</h1>
        </div>
        

        <nav>
            <div><a href="./index.php?objet=Pizza">Pizzas</a></div>
            <div><a href="./index.php?objet=Boisson">Boissons</a></div>
            <div><a href="./index.php?objet=Dessert">Desserts</a></div>
        </nav>

        <div class="btnbar">
            <div class="compte">
                <a href="#"><img src="img/compte.png"><?php echo $_SESSION["login"]; ?></a>
                <div class="CompteHiddenBox">
                    <ul>
                        <li><a href="index.php?objet=Compte&action=displayCompte">Mon Compte </a></li>
                        <li><a href="index.php?objet=Compte&action=disconnect"> Déconnexion </a></li>
                    </ul>
                </div>
            </div>

            <div class="paniermenu">
                <a href="./index.php?objet=Panier&action=DisplayPanier"><img src="img/panier.png">Panier <?php echo $prixTotalPanier ?>€</a>
            </div>
        </div>
    </div>
</header>