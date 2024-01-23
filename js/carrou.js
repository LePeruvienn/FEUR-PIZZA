function previous(){
    document.querySelector('.carrou').scrollLeft -= 1200;
}

function next(){
    document.querySelector('.carrou').scrollLeft += 1200;
}

function addIngredients() {
    var container = document.getElementById("IngredientsAdd");


    var select = document.createElement("select");
    select.name = "numIngredient";
    select.id = "Add";
    select.appendChild('<option value="">--Please choose an option--</option><?php foreach ($ingredient as $i){?><option value="<?php echo $i->get("numIngredient"); ?>"><?php echo $i->get("nomIngredient"); ?></option><?php }?>"');



    var newp1 = document.createElement("p");
    const node1 = document.createTextNode("numero de l'ingredients");
    newp1.appendChild(node1);

    var newInput2 = document.createElement("input");
    newInput2.type = "text";
    newInput2.id = "Add";
    newInput2.name = "quantite"; // Assign a unique name

    var newp2 = document.createElement("p");
    const node2 = document.createTextNode("quantité nécessaire");
    newp2.appendChild(node2);

    container.appendChild(newp1);
    container.appendChild(select);
    container.appendChild(newp2);
    container.appendChild(newInput2);
}
