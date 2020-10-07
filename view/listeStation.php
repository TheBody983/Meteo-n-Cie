<?php $title= 'Gestion des Stations'; ?>
<?php ob_start(); ?>
<body style="background-image: url('../graphs/fondcarte.png');">
<div id="containerListat">
<?php

echo '<p><h1>Liste des Stations :</h1></p>';

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
if(isset($_SESSION['login']))
    echo '<button id="connexionLog" onclick="window.location.href = \'gestionStation\'">Gérer mes stations</button>';

?>
    <button id="connexionLog" onclick="window.location.href = 'main'">Annuler</button>
</div>
</body>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
