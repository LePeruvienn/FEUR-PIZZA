<main>
    <div class="container">
        <div class="contleft">
             <img src="img/pizza.png" alt="logo">
             <h1>FEUR PIZZA</h1>
             <p>Ici ça mange quoi?</p>
        </div>
    
        <div class ="contright">
    
            <div class="txtacc">
                <h1>S'inscrire</h1>
                <h2>N'attendez pas !</h2>
            </div>
    
            <div class="btnacc">
                <form>
                    <input type="hidden" name="objet" value="<?php echo $classe; ?>">
                    <input type="hidden" name="action" value="create">

                    <?php
                        foreach ($champs as $champ => $details) {

                            echo "<div>";
                            echo "<label for=\"$champ\">$details[1]</label> <br>";
                            echo "<input type=\"$details[0]\" name=\"$champ\" placeholder=\"$details[1]\" required>"; echo "</div>";
                        }
                    ?>

                    <button type="submit" class="registerbtn">S'inscrire</button>

                </form>
    
                <p>Deja un compte? <a href='index.php?objet=Compte&action=displayConnectionForm'> Se Connecter </a>.</p>
    
            </div>
        </div>
    </div>
</main>