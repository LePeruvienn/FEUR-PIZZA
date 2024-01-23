
<main>

    <?php

        if($erreur){
            ?>

            <div class="fin">
                <h1>ERREUR</h1>
                <h4>Votre commande comporte une erreur veuillez réessayer</h4>
                <?php
                    if(count($ruptureDeStockIngredient) > 0 ){
                        foreach($ruptureDeStockIngredient as $un){
                            $nomIng = $un->get("nomIngredient");
                            echo "<p> Il y a trop de $nomIng dans la commande ! </p>";
                        }
                    }

                    if(count($ruptureDeStockDessert) > 0 ){
                        foreach($ruptureDeStockDessert as $un){
                            $dessert = Dessert::getOne($un);
                            $nomdessert = $dessert->get("nomDessert");
                            $nbEnTrop = (Dessert_Exemplaire::nbDispo($un) - $nbDispoArray["Dessert"][$un] ) * -1;
                            echo "<p> Il y a trop de $nomdessert dans la commande ! ($nbEnTrop en trop)</p>";
                        }
                    }

                    if(count($ruptureDeStockBoisson) > 0 ){
                        foreach($ruptureDeStockBoisson as $un){
                            $boisson = Boisson::getOne($un);
                            $nomboisson = $boisson->get("nomBoisson");
                            $nbEnTrop = (Boisson_Exemplaire::nbDispo($un) - $nbDispoArray["Boisson"][$un]) * -1;
                            echo "<p> Il y a trop de $nomboisson dans la commande ! ($nbEnTrop en trop)</p>";
                        }
                    }
                ?>
                <a href="index.php?">RETOUR A L'ACCEUIL</button>
            </div>

            <?php
        }

        else {
            ?>

            <div class="fin">
                <h1>MERCI POUR VOTRE COMMANDE !</h1>
                <h4>Votre commande est en cours de preparation</h4>
                <a href="index.php?">RETOUR A L'ACCEUIL</button>
            </div>

            <?php
        }
    ?>
</main>
