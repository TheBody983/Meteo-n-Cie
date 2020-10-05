<?php $title= 'Gestion des Stations'; ?>
<?php ob_start(); ?>
<?php
echo '<div class="containerCol"><div class="containerCol">';
echo '<p>Liste des Stations :</p>';

echo '<table>';
echo '<tr><th>Station</th><th>Propriétaire</th><th>Modèle</th><th>Description</th><th>Localisation</th><th>Mesures</th></tr>';

foreach($stations as $station){
    echo '<tr>';
        echo '<td>'.$station["stationID"].'</td>';
        echo '<td>'.get_login($station["userID"]).'</td>';
        echo '<td>'.$station["model"].'</td>';
        echo '<td>'.$station["description"].'</td>';
        echo '<td>'.$station["localisation"].'</td>';
        echo '<td><form method="post"action="station">
            <input type="text" name="station" value ='.$station["stationID"].' hidden>
            <input type="submit" value="Accéder aux mesures"></form></td>';
    echo '</tr>';
}
echo '</table>';
?>

<?php echo '</div></div>'; ?>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
