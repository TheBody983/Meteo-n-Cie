<?php $title= 'Station'; ?>
<?php ob_start(); ?>
<?php
echo '<div class="containerCol">';
echo '<input type="text" name="station" value ='.$station["stationID"].' hidden>';
echo '<div class="box"><p>Edition de Station (Double-cliquer pour éditer la donnée)</p>';
echo '<table>';
echo '<tr><th>Station</th><th>Propriétaire</th><th>Modèle</th><th>Visibilité</th><th>Description</th><th>Localisation</th></tr>';
    echo '<tr>';
        echo '<td><div>'.$station["stationID"].'</div></td>';
        echo '<td><div>'.get_login($station["userID"]).'</div></td>';
        echo '<td><div id="model">'.$station["model"].'</div></td>';
        echo '<td><div id="visibility">'.$station["visibility"].'</div></td>';
        echo '<td><div id="description">'.$station["description"].'</div></td>';
        echo '<td><div id="localisation">'.$station["localisation"].'</div></td>';
    echo '</tr>';
echo '</table></div>';?>

<div class="containerCol box">
    <p>Mesures de la Station</p>
<table>
<tr>
  <th>Date</th>
  <th>Mesure</th>
  <th>Valeur</th>
</tr>
<?php
foreach($station["mesures"] as $mesure) {
    echo "<tr>";
    echo "<td>" . $mesure['date'] . "</td>";
    echo "<td>" . $mesure['name'] . "</td>";
    echo "<td>" . $mesure['value'] . "</td>";
    echo "</tr>";
}
?>
</table>

</div>

<div class="containerCol box">
    <p>Ajouter une Mesure</p>

    <form method="post"action="station?stationID=<?php echo $station["stationID"]; ?>">
        <input type="text" name="addMesure" id="addMesure" value = "yes" hidden>
        <label for="mesure">Mesure</label> : <input type="text" name="mesure" id="mesure" value="temperature">
        <label for="valeur">Valeur</label> : <input type="text" name="valeur" id="valeur" placeholder="(facultatif)">
        <input type="submit" value="Ajouter">
    </form>
</div>


    </div>

<?php if($station["userID"] == get_userID($login)){ ?>
<script>
    let model = document.getElementById("model");
    let visibility = document.getElementById("visibility");
    let description = document.getElementById("description");
    let localisation = document.getElementById("localisation");

    model.addEventListener('dblclick', function(evt){edit(model)});
    visibility.addEventListener('dblclick', function(evt){edit(visibility)});
    description.addEventListener('dblclick', function(evt){edit(description)});
    localisation.addEventListener('dblclick', function(evt){edit(localisation)});

    function edit (node){
        tmp = document.createElement("input");
        tmp.setAttribute('name',node.id);
        tmp.setAttribute('id',node.id);
        tmp.setAttribute('value',node.textContent);
        id = node.id;
        tmp.setAttribute('onChange','update("'+id+'","'+node.innerHTML+'",<?php echo $station["stationID"];?>)');
        node.parentNode.replaceChild(tmp, node);
    }

    function update(id,textcontent,stationID){
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
        xmlhttp.open("GET","../ajax/updateStation.php?id="+id+'&textcontent='+value+'&stationID='+stationID,true);
        xmlhttp.send();
    }
</script>
<?php }
$content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>