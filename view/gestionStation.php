<?php $title= 'Gestion des Stations'; ?>
<?php ob_start(); ?>
<?php

echo '<table>';
foreach($stations as $station){
    echo '<tr>';
    if($station["userID"]==get_userID($login)){
        foreach($station as $donnee){
            echo '<td>'.$donnee.'</td>';
        }
        echo '<td><form method="post"action="gestionStation">
            <input type="text" name="delStation" value ='.$station["stationID"].' hidden>
            <input type="submit" value="Supprimer"></form></td>';
        echo '<td><form method="post"action="station">
            <input type="text" name="station" value ='.$station["stationID"].' hidden>
            <input type="submit" value="Editer"></form></td>';
    }
    echo '</tr>';
}

?>

<div id="idGestionStation">
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
