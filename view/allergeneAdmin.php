
<main>
<link rel="stylesheet" href="css/panierAdmin.css">
    <div class="MaPizza">

    <header><h1>Ma Pizza :</h1></header>

            <div class="panierright">
                <div class="infoElement">
                    <div class="imgEle">
                        <img src="img/Pizza/<?php echo $article->get("nomPizza"); ?>.png">
                    </div>
                    <div class="info">
                        <div class="desc">
                            <h2>Description</h2>
                            <p><?php echo $article->get("descCourt"); ?></p>
                        </div>
                    </div>
                    <div class="allergene">
                            <h3>Allergene</h3>

                            <?php
                                $tabIngredient = Ingredient_Pizza::getOnePizza($article->get("numPizza"));
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
                        </div>
                </div>

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
                </div>
            </div>
        </div>

        <ul>
        <li><a class="deco" href="index.php?objet=Compte&action=modifyListPizzaAdmin"> RETOUR EN ARRIERE </a></li>
    </ul>
</main>