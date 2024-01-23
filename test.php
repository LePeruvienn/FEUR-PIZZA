<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>TEST PHP PIZZA</title>
  </head>
  <body>

    <?php

        require_once("config/connexion.php");

        require_once("model/Commande.php");
        require_once("model/CarteDeCredit.php");
        require_once("model/Pizza_exemplaire.php");
        require_once("model/Pizza.php");
        require_once("model/Compte.php");
        require_once("model/Boisson_Exemplaire.php");
        require_once("model/Dessert.php");
        require_once("model/Dessert_Exemplaire.php");
        require_once("model/Boisson.php");
        require_once("model/Adresse.php");
        require_once("model/Alerte.php");
        require_once("model/Ingredient.php");
        require_once("model/Allergene.php");
        require_once("model/Espece.php");
        require_once("model/Ingredient_en_moins.php");
        require_once("model/Ingredient_en_plus.php");
        require_once("model/Allergene_Dessert.php");
        require_once("model/Commande_Boissons.php");
        require_once("model/Commande_Desserts.php");
        require_once("model/Commande_Pizzas.php");
        require_once("model/Ingredient_Pizza.php");


        connexion::connect();

        // Pizza

        $tableau = Pizza::getAll();

        echo "<h2> Les Pizzas </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        // Pizza_exemplaire

        $tableau = Pizza_exemplaire::getAll();

        echo "<h2> Les Pizza_exemplaire </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        // COMMANDE

        $tableau = Commande::getAll();

        echo "<h2> Les Commandes </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        // CLIENT

        $tableau = Compte::getAll();

        echo "<h2> Les Clients </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        //Dessert

        $tableau = Dessert::getAll();

        echo "<h2> Les Desserts </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        // DESSERT EXEMPLAIRE

        $tableau = Dessert_Exemplaire::getAll();

        echo "<h2> Les Exemplaire Dessert </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        //Boisson

        $tableau = Boisson::getAll();

        echo "<h2> Les Boissons </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        // BOISSON EXEMPLAIRE

        $tableau = Boisson_Exemplaire::getAll();

        echo "<h2> Les Exemplaire Boissons </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        // Espece

        $tableau = Espece::getAll();

        echo "<h2> Espece </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        // Carte de credit

        $tableau = CarteDeCredit::getAll();

        echo "<h2> Les Carte de crédit </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        // Ingredient

        $tableau = Ingredient::getAll();

        echo "<h2> Les Ingredients </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        //Pizza_Ingredient

        $tableau = Ingredient_Pizza::getAll();

        echo "<h2> Les Ingredients </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        // Adresse

        $tableau = Adresse::getAll();

        echo "<h2> Les adresses </h2>";

        echo "<ul>";

        foreach ($tableau as $uneAdresse) {
            echo "<li>$uneAdresse</li>";
        }

        echo "</ul>";

        // ALLERGENE

        $tableau = Allergene::getAll();

        echo "<h2> Les Allergenes </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        // ALERTE

        $tableau = Alerte::getAll();

        echo "<h2> Les Alertes </h2>";

        echo "<ul>";

        foreach ($tableau as $uneAdresse) {
            echo "<li>$uneAdresse</li>";
        }

        echo "</ul>";

        // Ingredient_en_plus

        $tableau = Ingredient_en_plus::getAll();

        echo "<h2> Ingredient_en_plus </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        // Paiement_Commande

        // Ingredient_en_moins

        $tableau = Ingredient_en_moins::getAll();

        echo "<h2> Ingredient_en_moins </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        // Alergene_Dessert

        $tableau = Allergene_Dessert::getAll();

        echo "<h2> Alergene_Dessert </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        // COMMANDE BOISSON

        $tableau = Commande_Boissons::getAll();

        echo "<h2> Commande_Boissons </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        // COMMANDE BOISSON

        $tableau = Commande_Desserts::getAll();

        echo "<h2> Commande_Desserts </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

        // COMMANDE PIZZA

        $tableau = Commande_Pizzas::getAll();

        echo "<h2> Commande_Pizzas </h2>";

        echo "<ul>";

        foreach ($tableau as $unelement) {
            echo "<li>$unelement</li>";
        }

        echo "</ul>";

    ?>


</body>
</html>