<?php

    $pizzaEnAvant = array();

    foreach ($tableau as $un) {
        if($un->get("enAvant") == 1){
            array_push($pizzaEnAvant,$un);
        }
    }
?>
    
    <div class="pizza">

        <div class="arrowleft">
            <img onclick="previous()" src="img/arrow.png">
        </div>

        <div class="carrou" style ="grid-template-columns: repeat(<?php echo sizeof($pizzaEnAvant)?>, 1200px);">

        <?php

        foreach ($pizzaEnAvant as $unAvant){
            $id = $unAvant->get($identifiant);
            $lienDetails = "<a href='index.php?objet=$classeRecupere&action=displayOne&$identifiant=$id'><p>Plus d'info</p></a>";
            ?>
                <div class="unepizza">
                    <div class="pizzaleft">
                        <img src=<?php echo "img/".$classeRecupere."/".str_replace(' ','',$unAvant->getNom()).".png"?>>
                        <h2>Seulement <?php echo "{$unAvant->get("prix".ucfirst($classeRecupere))}";?> €</h2>
                    </div>
            
                    <div class="pizzaright">
                        <h1>Pizza <?php echo "{$unAvant->getNom()}";?> </h1>
                        <p><?php echo "{$unAvant->get("descCourt")}";?></p>
                        <ul>
                            <?php
                                $tabIngredient = Ingredient_Pizza::getOnePizza($id);
                                foreach($tabIngredient as $unIngredient){
                                    //print_r($unIngredient);
                                    if($unIngredient->get("quantite") !== 0){
                                        echo "<li>". Ingredient::getOne($unIngredient->get("numIngredient"))->get("nomIngredient")."</li>";
                                    }
                                }
                            ?>
                        </ul>

                        <a class="addPanierEnavant" href="<?php echo "index.php?objet=Panier&action=add&articleAdd=$id&type=$classeRecupere"?>"><h3 class="h3">Ajoutez au panier</h3></a>
                        
            
                        <?php echo $lienDetails;?>
                    </div>
                </div>
            <?php
        }?>
        </div>

        <div class="arrowright">
            <img onclick="next()" src="img/arrow.png">
        </div>

    </div>