<main>
<?php 
    if ($_SESSION["panier"]["Pizza"] == null && $_SESSION["panier"]["Boisson"] == null && $_SESSION["panier"]["Dessert"] == null) {
?>

    <div class="panierVideContaner">
            <h1 class="panierVideh1">Votre Panier est vide</h1>
    </div>


<?php
    } else { 
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
    
       <div class="headerpanier">
            <h1>PANIER</h1>
            <h1>TOTAL : <?php echo $prixTotalPanier;?> €</h1>
            <form>
                <input type="hidden" name ="objet" value="Compte">
                <input type="hidden" name="action" value="payer">
                <button type="submit">Payer</button>
            </form> 
       </div>

    
  
       <div class="panier">
            <div class="panierleft">

                <!-- PIZZA PANIER LEFT -->

                <?php

                    if(!empty($_SESSION["panier"]["Pizza"])){
                        echo "<h1>Pizzas</h1>";
                    }

                    foreach($_SESSION["panier"]["Pizza"] as $i => $numPizza) {

                        $unepizza = Pizza::getOne($numPizza);
                        $nomPizza = $unepizza->get("nomPizza");
                        $prixPizza = $unepizza->get("prixPizza");

                        ?>
                            <div class="element" onclick="location.href='index.php?objet=Panier&action=DisplayPanier&selectType=Pizza&selectPanier=<?php echo $i;?>';">
                                <div>
                                    <img src=<?php echo "img/Pizza/".str_replace(' ','',$nomPizza).".png"?>>
                                </div>

                                <div>
                                    <div class="ele">
                                        <h2><?php echo $nomPizza;?></h2>
                                        <p><?php echo $prixPizza;?> €</p>
                                    </div>
                                    <div class="ele">
                                        
                                        <form>
                                            <input type="hidden" name ="objet" value="Panier">
                                            <input type="hidden" name="action" value="supp">
                                            <input type="hidden" name="idSupp" value="<?php echo $i;?>">
                                            <input type="hidden" name ="type" value="Pizza">

                                            <button type="submit">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?>

                <!-- DESSERT PANIER LEFT -->
                <?php
                    
                    if(!empty($_SESSION["panier"]["Dessert"])){
                        echo "<h1>Desserts</h1>";
                    }

                    foreach($_SESSION["panier"]["Dessert"] as $i => $numDessert) {

                        $unDessert = Dessert::getOne($numDessert);
                        $nomDessert = $unDessert->get("nomDessert");
                        $prixDessert = $unDessert->get("prixDessert");

                        ?>
                            <div class="element" onclick="location.href='index.php?objet=Panier&action=DisplayPanier&selectType=Dessert&selectPanier=<?php echo $i;?>';">
                                <div>
                                    <img src=<?php echo "img/Dessert/".str_replace(' ','',$nomDessert).".png"?>>
                                </div>

                                <div>
                                    <div class="ele">
                                        <h2><?php echo $nomDessert;?></h2>
                                        <p><?php echo $prixDessert;?> €</p>
                                    </div>
                                    <div class="ele">
                                        <form>
                                            <input type="hidden" name ="objet" value="Panier">
                                            <input type="hidden" name="action" value="supp">
                                            <input type="hidden" name="idSupp" value="<?php echo $i;?>">
                                            <input type="hidden" name ="type" value="Dessert">

                                            <button type="submit">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?>

                <!-- BOISSONS PANIER LEFT -->
                <?php
                    
                    if(!empty($_SESSION["panier"]["Boisson"])){
                        echo "<h1>Boissons</h1>";
                    }

                    foreach($_SESSION["panier"]["Boisson"] as $i => $numBoisson) {

                        $uneBoisson = Boisson::getOne($numBoisson);
                        $nomBoisson = $uneBoisson->get("nomBoisson");
                        $prixBoisson = $uneBoisson->get("prixBoisson");

                        ?>
                            <div class="element" onclick="location.href='index.php?objet=Panier&action=DisplayPanier&selectType=Boisson&selectPanier=<?php echo $i;?>';">
                                <div>
                                     <img src=<?php echo "img/Boisson/".str_replace(' ','',$nomBoisson).".png"?>>
                                </div>

                                <div>
                                    <div class="ele">
                                        <h2><?php echo $nomBoisson;?></h2>
                                        <p><?php echo $prixBoisson;?> €</p>
                                    </div>
                                    <div class="ele">
                                        <form>
                                            <input type="hidden" name ="objet" value="Panier">
                                            <input type="hidden" name="action" value="supp">
                                            <input type="hidden" name="idSupp" value="<?php echo $i;?>">
                                            <input type="hidden" name ="type" value="Boisson">

                                            <button type="submit">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?>
                
            </div>


            <?php
                $article = $selectType::getOne($_SESSION["panier"][$selectType][$select]);
            ?>

            <div class="panierright">
                <div class="infoElement">
                    <div class="imgEle">
                        <img src="img/<?php echo $selectType;?>/<?php echo $article->get("nom".$selectType); ?>.png">
                    </div>
                    <div class="info">
                        <div class="desc">
                            <h2>Description</h2>
                            <p>
                                <?php
                                    if($selectType == "Pizza"){
                                        echo $article->get("descCourt");
                                    }
                                    else {
                                        echo $article;
                                    }
                                ?>
                            </p>
                        </div>

                        <?php

                        if($selectType == "Pizza") {
                            ?>
                                <div class="allergene">
                                    <h3>Allergene</h3>

                                    <?php
                                        $tabIngredient = Ingredient_Pizza::getOnePizza($article->get("numPizza"));
                                    ?>

                                    <div class="allergenelist">
                                        <ul>
                                            <?php

                                                require_once("./model/Allergene.php");

                                                $listeAllergene = array();

                                                foreach($tabIngredient as $ingPiz){
                                                    $ing = Ingredient::getOne($ingPiz->get("numIngredient"));
                                                    $allergene = Allergene::getOne($ing->get("numAllergene"));
                                                    if($allergene != NULL && !(in_array($allergene, $listeAllergene))) {
                                                        echo "<li>$allergene</li>";
                                                        array_push($listeAllergene,$allergene);
                                                    }
                                                }

                                                foreach($_SESSION["panier"]["Ingredient_en_plus"][$select] as $ingPiz){
                                                    $ing = Ingredient::getOne($ingPiz);
                                                    $allergene = Allergene::getOne($ing->get("numAllergene"));
                                                    if($allergene != NULL && !(in_array($allergene, $listeAllergene))) {
                                                        echo "<li>$allergene</li>";
                                                        array_push($listeAllergene,$allergene);
                                                    }
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php
                        }?>

                    </div>
                </div>

                <?php
                    if($selectType == "Pizza"){
                        ?>

                            <div class="IngSupp">
                                <div class="IngredientElement">
                                    <h2>Ingredients</h2>
                                    <div>
                                        <div class="listIng">
                                            <?php
                                                
                                                foreach($tabIngredient as $n =>$unIngredient){
                                                
                                                    $supprimer = in_array($unIngredient->get("numIngredient"),$_SESSION["panier"]["Ingredient_en_moins"][$select]);
                                                    $css = "style='color: red !important; text-decoration: line-through !important;'"
                                                    ?>
                                                        <div class="ing" <?php if($supprimer){ echo $css; }?>>
                                                            <p><?php echo Ingredient::getOne($unIngredient->get("numIngredient"))->get("nomIngredient"); ?></p>
                                                            <p>Quantité : <?php echo $unIngredient->get("quantite")." ".Ingredient::getOne($unIngredient->get("numIngredient"))->get("mesure");;?></p>
                                                            
                                                            <?php if($supprimer){
                                                                ?>
                                                                    <form>
                                                                        <input type="hidden" name ="objet" value="Panier">
                                                                        <input type="hidden" name="action" value="suppIngredientEnMoins">
                                                                        <input type="hidden" name="Ingredient" value="<?php echo $unIngredient->get("numIngredient");?>">
                                                                        <input type="hidden" name="idPizza" value="<?php echo $select;?>">
                                                                        <button>Annuler</button>
                                                                    </form>
                                                                <?php
                                                            }
                                                            else {
                                                                ?>
                                                                    <form>
                                                                        <input type="hidden" name ="objet" value="Panier">
                                                                        <input type="hidden" name="action" value="addIngredientEnMoins">
                                                                        <input type="hidden" name="Ingredient" value="<?php echo $unIngredient->get("numIngredient");?>">
                                                                        <input type="hidden" name="idPizza" value="<?php echo $select;?>">
                                                                        <button>Supprimer</button>
                                                                    </form>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="SupplementElement">
                                    <h2>SUPPLEMENT</h2>
                                    <div>
                                        <div class="listSupp">
                                            <?php
                                                foreach($_SESSION["panier"]["Ingredient_en_plus"][$select] as $unsupp){
                                                    $ing = Ingredient::getOne($unsupp);
                                                    echo "<div class='supp'>";
                                                    echo "<form>";

                                                    echo "<input type='hidden' name ='objet' value='Panier'>";
                                                    echo "<input type='hidden' name='action' value='deleteSupplement'>";
                                                    echo "<input type='hidden' name='Ingredient' value='$unsupp'>";
                                                    echo "<input type='hidden' name='idPizza' value='$select'>";

                                                    echo "<p>".$ing->get("nomIngredient")." +".$ing->get("prixSupplement")."€</p>";

                                                    echo "<button>Supprimer</button>";

                                                    echo "</form>";
                                                    echo "</div>";
                                                }
                                            ?>
                                        </div>
                                        <div class="ajoutSupp">
                                            <form>
                                                <label for="suppSelect">Supplément </label>

                                                <input type=hidden name="objet" value="Panier">
                                                <input type=hidden name="action" value="addSupplement">
                                                <input type="hidden" name="idPizza" value="<?php echo $select;?>">

                                                <select name="suppSelect">
                                                    <?php
                                                        $listeIng = Ingredient::GetAll();

                                                        foreach($listeIng as $ing){
                                                            echo "<option value='".$ing->get("numIngredient")."'>".$ing->get("nomIngredient")."</option>";
                                                        }
                                                    ?>
                                                </select>

                                                <button>Ajouter +</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }?>
            </div>
        </div>

        <?php
    
        }
    ?>
    </main>