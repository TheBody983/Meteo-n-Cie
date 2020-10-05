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



<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
