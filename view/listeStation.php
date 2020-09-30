<?php $title= 'Gestion des Stations'; ?>
<?php ob_start(); ?>
<?php

echo '<p>Liste des Stations :</p>';

echo '<table>';
echo '<tr><th>Station</th><th>Propriétaire</th><th>Modèle</th><th>Description</th><th>Localisation</th></tr>';

foreach($stations as $station){
    echo '<tr>';
        echo '<td>'.$station["stationID"].'</td>';
        echo '<td>'.get_login($station["userID"]).'</td>';
        echo '<td>'.$station["model"].'</td>';
        echo '<td>'.$station["description"].'</td>';
        echo '<td>'.$station["localisation"].'</td>';
    echo '</tr>';
}
echo '</table>';
?>

<div id="idGestionStation">
    <p>Ajouter une Station</p>

    <form method="post"action="gestionStation">
        <input type="text" name="addStation" id="addStation" value = "yes" hidden>
        <label for="model">Modèle</label> : <input type="text" name="model" id="model">
        <label for="coordonneesStations">Coordonées</label> : <input type="text" name="coordonneesStation" id="coordonneesStation">
        <label for="descriptionStations">Description</label> : <input type="textarea" name="descriptionStation" id="descriptionStation" placeholder="(facultatif)">
        <input type="submit" value="Ajouter">
    </form>
</div>


<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
