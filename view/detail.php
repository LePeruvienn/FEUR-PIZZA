
<main>
    <div class="MaPizza">

            <h1>Info <?php echo $classeRecupere;?></h1>

            <div class="panierright">
                <div class="infoElement">
                    <div class="imgEle">
                        <img src="img/<?php echo $classeRecupere;?>/<?php echo str_replace(' ','',$element->getNom()); ?>.png">
                    </div>
                    <div class="info">
                        <?php if( $classeRecupere == "Pizza"){?>
                            <div class="desc">
                                <h2>Description</h2>
                                <p><?php echo $element->get("descCourt"); ?></p>
                            </div>
                        <?php }else echo "<h2>Description</h2> <p>".$element."<p>"; ?>
                        
                    </div>  <?php if( $classeRecupere == "Pizza"){?>
                    <div class="allergene">
                            <h3>Allergene</h3>

                            <?php
                                $tabIngredient = Ingredient_Pizza::getOnePizza($element->get("numPizza"));
                            ?>

                            <div class="allergenelist">
                                <ul>
                                    <?php   
                                        $class = "Allgeclass";
                                        require_once("./model/Allergene.php");
                                        $saveAllergene = array();
                                        foreach($tabIngredient as $ingredient){
                                            $numIngredient = Ingredient::getOne($ingredient->get("numIngredient"));
                                            $Allergene = Allergene::getOne($numIngredient->get("numAllergene"));
                                            if (!in_array($Allergene, $saveAllergene)){
                                                array_push($saveAllergene, $Allergene);
                                                echo "<p class=".$class.">".$Allergene ."</p>";
                                            }
                                        }
                                    ?>
                            </div>
                        </div><?php } ?>
                </div>
                <?php if( $classeRecupere == "Pizza"){?>
                <div class="IngSupp">
                    <div class="IngredientElement">
                        <h2>Ingredients</h2>
                        <div>
                            <div class="listIng">
                                <?php
                                    foreach($tabIngredient as $unIngredient){
                                        ?>
                                            <div class="ing">
                                                <p><?php echo Ingredient::getOne($unIngredient->get("numIngredient"))->get("nomIngredient"); ?></p>
                                                <p>Quantité : <?php echo $unIngredient->get("quantite")." ".Ingredient::getOne($unIngredient->get("numIngredient"))->get("mesure");;?></p>
                                                <button>Supprimer</button>
                                            </div>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div><?php } ?>
            </div>
        </div>

</main>