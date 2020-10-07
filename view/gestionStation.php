<?php $title= 'Gestion des Stations'; ?>
<?php ob_start(); ?>
<body style="background-image: url('../graphs/fondcarte.png');">
<div id="containerListGestat">
<?php
echo '<div class="containerCol">';

echo '<p><h1>Liste des Stations :</h1></p>';

echo '<table>';
echo '<tr><th>Station</th><th>Propriétaire</th><th>Modèle</th><th>Visibilité</th><th>Description</th><th>Localisation</th>    </tr>';

foreach($stations as $station){
    echo '<tr>';
    if($station["userID"]==get_userID($login)){
        echo '<td>'.$station["stationID"].'</td>';
        echo '<td>'.get_login($station["userID"]).'</td>';
        echo '<td>'.$station["model"].'</td>';
        echo '<td>'.$station["visibility"].'</td>';
        echo '<td>'.$station["description"].'</td>';
        echo '<td>'.$station["localisation"].'</td>';
        echo '<td><form method="post"action="gestionStation">
                  <input type="text" id="hidden" name="delStation" value =' . $station["stationID"] . ' />
                  <input type="submit" id="connexionGestat" value="Supprimer"></form></td>';
        echo '<td><form method="post"action="station">
                  <input type="text" id="hidden" name="station" value =' . $station["stationID"] . ' />
                  <input type="submit" id="connexionGestat" value="Editer"></form></td>';
    }
    echo '</tr>';
}
echo '</table></div>';
?>
    <div id="containerGestat">
        <p>Ajouter une Station</p>

        <form method="post" action="gestionStation">
            <input type="text" name="addStation" id="hidden" value = "yes"/>
            <label for="model">Modèle</label> : <input type="text" name="model" id="model"/>
            <label for="coordonneesStations">Coordonées</label> : <input type="text" name="coordonneesStation" id="coordonneesStation"/>
            <label for="descriptionStations">Description</label> : <input type="text" name="descriptionStation" id="descriptionStation" placeholder="(facultatif)"/>
            <input id="connexionLog" type="submit" value="Ajouter">
        </form>
    </div>
</div>
</body>

<?php echo '</div>'; ?>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
