<?php $title= 'Gestion des Projets'; ?>
<?php ob_start(); ?>
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
?>

<div id="idGestionProjet">
    <p>Ajouter un Projet</p>

    <form method="post"action="gestionProjet">
        <label for="addProjet">Nom de Projet</label> :<input type="text" name="addProjet" id="addProjet" value = "yes" hidden>
        <label for="descriptionProjet">Description du Projet</label> : <input type="text" name="descriptionProjet" id="descriptionProjet">
        <input type="submit" value="Ajouter">
    </form>
</div>


<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
