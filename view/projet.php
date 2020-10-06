<?php $title= 'projet'; ?>
<?php ob_start(); ?>
<?php

//echo '<input type="text" name="projet" value ='.$projet["projetID"].' hidden>';
echo '<p>Edition de projet</p>';

echo '<table>';
echo '<tr><th>ID Projet</th><th>Nom</th><th>Description</th>';
    echo '<tr>';
    echo '<td><div id="idprojet">' . $projet["infos"]["projetID"] . '</div></td>';
    echo '<td><div id="nom">' . $projet["infos"]["nom"] . '</div></td>';
    echo '<td><div id="description">' . $projet["infos"]["description"] . '</div></td>';
    echo '</tr>';

echo '</table>';

echo '<table>';
echo '<tr><th>Station</th><th>Model</th><th>Localisation</th>';
foreach($projet["stations"] as $station){
    echo '<tr>';
    
        echo '<td>'.$station["stationID"].'</td>';
        echo '<td>'.$station["model"].'</td>';
        echo '<td>'.$station["localisation"].'</td>';
		
        echo '<td class="container"><form method="post"action="projet">
            <input type="text" name="removeStationProjet" value ='.$station["stationID"].' hidden>
            <input type="submit" value="Supprimer"></form>';
    
    echo '</tr>';
}
echo '</table>';

echo '<table>';
echo '<tr><th>ID Utilisateur</th><th>Nom</th><th>Prenom</th>';
foreach($projet["users"] as $user){
    echo '<tr>';
        echo '<td>'.$user["0"].'</td>';
        echo '<td>'.$user["0"].'</td>';
        echo '<td>'.$user["0"].'</td>';

        echo '<td class="container"><form method="post"action="projet">
            <input type="text" name="removeUserProjet" value ='.$station["stationID"].' hidden>
            <input type="submit" value="Supprimer"></form>';
    
    echo '</tr>';
}
echo '</table>';


?>

<div id="idGestionStationProjet">
    <p>Ajouter une station au Projet</p>

    <form method="post"action="projet">
        <input type="text" name="addStationProjet" value = "yes" hidden>
        <input type="text" name="projet" value = "<?php echo $projet["infos"]["projetID"]; ?>" hidden>
        <label for="station">Nom de la Station</label> :<input type="text" name="station" id="station">
        <input type="submit" value="Ajouter">
    </form>
</div>

<div id="idGestionUserProjet">
    <p>Ajouter un utilisateur au Projet</p>

    <form method="post"action="projet">
        <input type="text" name="addUserProjet" value = "yes" hidden>
        <input type="text" name="projet" value = "<?php echo $projet["infos"]["projetID"]; ?>" hidden>
        <label for="userID">ID Utilisateur</label> :<input type="text" name="userID" id="userID">
        <input type="submit" value="Ajouter">
    </form>
</div>

<script>
    let visibility = document.getElementById("visibility");
    let description = document.getElementById("description");

    visibility.addEventListener('dblclick', function(evt){edit(visibility)});
    description.addEventListener('dblclick', function(evt){edit(description)});

    function edit (node){
        tmp = document.createElement("input");
        tmp.setAttribute('name',node.id);
        tmp.setAttribute('id',node.id);
        tmp.setAttribute('value',node.textContent);
        id = node.id;
        tmp.setAttribute('onChange','update("'+id+'","'+node.innerHTML+'",<?php echo $projet["projetID"];?>)');
        node.parentNode.replaceChild(tmp, node);
    }

    function update(id,textcontent,projetID){
        let node = document.getElementById(id);
        value = node.value;
        tmp = document.createElement("div");
        tmp.setAttribute('id',id);
        tmp.setAttribute('value',textcontent);


        tmp.textContent = value;
        tmp.addEventListener('dblclick', function(evt){edit(tmp)});
        node.parentNode.replaceChild(tmp, node);

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(evt) {
            if (this.readyState == 4 && this.status == 200) {
                node.textContent = this.responseText;
            }
        };
        xmlhttp.open("GET","../ajax/updateProjet.php?id="+id+'&textcontent='+value+'&projetID='+projetID,true);
        xmlhttp.send();
    }
</script>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>