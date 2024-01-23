
<main>

    <div class="MaPizza">

            <header><h1>Ma Pizza :</h1></header>

            <form class="newPizzaForm">                        


                
                <div class="nomPizza" id="nomPizza">
                    <h2>Nom :</h2> 
                    <input name="nomPizza" type="text" value="<?php echo $pizza->get("nomPizza");?>" required/>
                </div>
            
                <div class="prixPizza" id="prixPizza">
                    <h2>prix de la Pizza :</h2> 
                    <input name="prixPizza" type="number" value="<?php echo $pizza->get("prixPizza");?>" required/>
                </div>
            
                <div class="enAvant" id="enAvant">
                    <h2>enAvant :</h2> 
                    <input name="enAvant" type="checkbox"  <?php if($pizza->get("enAvant") == 1)
                    {echo "checked";} ?>/>
                </div>

                

                <div class="descriptionPizza" id="descCourt">
                    <h2>description Court :</h2> 
                    <textarea name="descCourt" type="text" required><?php echo $pizza->get("descCourt");?></textarea>
                </div>
    


                <div class="ingredients">
                    <div class="IngredientsAdd">
                        <h3>Ingredients</h3>
                        <div id="IngredientsAdd">

                        
                        <?php /*echo"<pre>";
                        print_r($pizza_ingredient);
                         echo"</pre>";
                        echo"<pre>";
                       print_r($ingredient);
                        echo"</pre>";*/?>


                            <?php 
                            $ingredientsave = $ingredient;
                            for($i = 0 ; $i < 10 ; $i++){
                            
                                ?>
                                <p>nom de l'ingredients</p>
                                <select name="numIngredient<?php echo $i;?>" id="Add"><?php
                                $nomingredientToShow = "";
                                $numingredientToShow = 0;
                                $quantiteToShow = 0;
                                foreach ($ingredient as $inger){
                                    
                                    if(isset($pizza_ingredient[$i])){
                                        if($inger->get("numIngredient") == $pizza_ingredient[$i]->get("numIngredient")){
                                            $nomingredientToShow = $inger->get("nomIngredient");
                                        } 
                                    }
                                }
                                if($nomingredientToShow == ""){
                                    $nomingredientToShow = "--Please choose an option--";
                                    $numingredientToShow = 0;
                                    $quantiteToShow = 0;
                                }else{
                                    $numingredientToShow = $pizza_ingredient[$i]->get("numIngredient");
                                    $quantiteToShow = $pizza_ingredient[$i]->get("quantite");
                                }
                                $ingredient = $ingredientsave; ?>
                                <option value="<?php echo $numingredientToShow;?>"><?php echo $nomingredientToShow;?></option>
                                <?php 
                                foreach ($ingredient as $inger){
                                    ?><option name="numIngredient" value="<?php echo $inger->get("numIngredient"); ?>"><?php echo $inger->get("nomIngredient"); ?></option><?php 
                                }
                                $ingredient = $ingredientsave;
                                ?>
                                </select>

                                <p>quantité nécessaire</p>
                                <input id="Add" type="text" name="quantite<?php echo $i;?>" value="<?php echo $quantiteToShow ;?>">
                            <?php }?>
                        
                        </div>
                        
                    </div>
                </div>
                
                <div class="buttonPizza">
                    <button type="submit">Sauvegarder</button>
                </div>
                
                
                <div class="imagePizza">
                </div>


                <input type="hidden" name="objet" value="Pizza">
                <input type="hidden" name="action" value="Update">
                <input type="hidden" name="numPizza" value="<?php echo $pizza->get("numPizza");?>"/>

            </form>

        </div>

</main>