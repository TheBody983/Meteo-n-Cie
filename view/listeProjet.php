<?php $title= 'Gestion des Projets'; ?>
<?php ob_start(); ?>
<body style="background-image: url('../graphs/fondcarte.png');">
<div id="containerListat">
<?php

echo '<p>Liste des Projets :</p>';

echo '<table>';
echo '<tr><th>Projet</th><th>Chef de Projet</th><th>Visibilité</th><th>Description</th>';

foreach($projets as $projet){
    echo '<tr>';
        echo '<td>'.$projet["projetID"].'</td>';
        echo '<td>'.get_login($projet["userID"]).'</td>';
        echo '<td>'.$projet["description"].'</td>';
    echo '</tr>';
}
echo '</table>';
if(isset($_SESSION['login']))
    echo '<button id="connexionLog" onclick="window.location.href = \'gestionProjet\'">Gérer mes projets</button>';
?>
</div>
</body>


<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
