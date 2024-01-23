
<main>

<header><h1>Nouvelle pizza</h1></header>
    
    <form class="newPizzaForm">
        
            <div class="nomPizza">
                <label for="nom">Nom pizza:</label>

                <input type="text" id="nom" name="nom" required>
            </div>


            <div class="prixPizza">
                <label for="prix">Prix:</label>

                <input type="number" id="prix" name="prix" min="0" step="0.50" required>
            </div>


            <div class="descriptionPizza">
                <label for="description" class="description">Description:</label>

                <textarea id="description" name="description" required></textarea>
            </div>

            <div class="enAvant">
                <label for="enAvant">Mettre en Avant?</label>

                <input type="checkbox" id="enAvant" name="enAvant" value="1"> 
            </div>

            <div class="ingredients">
                <div class="IngredientsAdd">
                <?php //print_r($ingredient);?>
                    <h3 class="Ingredientsh3">Ingredients</h3>
                    <div id="IngredientsAdd">

                    
                    <?php 
                    $ingredientsave = $ingredient;
                    for($i = 0 ; $i < 10 ; $i++){
                    
                        ?>
                        <p>numero de l'ingredients</p>
                        <select name="numIngredient<?php echo $i;?>" id="Add">
                        <option value="">--Please choose an option--</option>
                        <?php 
                        foreach ($ingredient as $inger){
                            ?><option name="numIngredient" value="<?php echo $inger->get("numIngredient"); ?>"><?php echo $inger->get("nomIngredient"); ?></option><?php 
                        }
                        $ingredient = $ingredientsave;
                        ?>
                        </select>

                        <p>quantité nécessaire</p>
                        <input id="Add" type="text" name="quantite<?php echo $i;?>">
                    <?php }?>
                    </div>
                </div>

            </div>

        <div class="buttonPizza">
            <button type="submit">Enregistrer</button>

            <button type="reset">ANNULER</button>
        </div>
        <input type="hidden" name="action" value="create">
        <input type="hidden" name="objet" value="Pizza">
    </form>


    <ul>
        <li><a class="deco" href="index.php?"> RETOUR A L'ACCEUIL </a></li>
    </ul>

</main>