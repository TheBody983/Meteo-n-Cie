<?php $title= 'Gestion des Projets'; ?>
<?php ob_start(); ?>
<?php

echo '<p>Liste des Projets :</p>';

echo '<table>';
echo '<tr><th>Projet</th><th>Nom</th><th>Description</th><th>Actions</th></tr>';

foreach($projets as $projet){
    echo '<tr>';
    echo '<td><div>'.$projet["projetID"].'</div></td>';
    echo '<td><div id="nom">'.$projet["nom"].'</div></td>';
    echo '<td><div id="description">'.$projet["description"].'</div></td>';

    echo '<td class="container"><form method="post"action="gestionProjet">
        <input type="text" name="delprojet" value ='.$projet["projetID"].' hidden>
        <input type="submit" value="Supprimer"></form>';

    echo '<form method="post"action="projet">
        <input type="text" name="projet" value ='.$projet["projetID"].' hidden>
        <input type="submit" value="Editer"></form></td>';

    echo '</tr>';
}
echo '</table>';
?>

<div id="idGestionProjet">
    <p>Ajouter un Projet</p>

    <form method="post"action="gestionProjet">
        <input type="text" name="addProjet" value = "yes" hidden>
        <label for="nameProjet">Nom de Projet</label> :<input type="text" name="nameProjet" id="nameProjet" value = "" >
        <label for="descriptionProjet">Description du projet</label> : <input type="text" name="descriptionProjet" id="descriptionProjet">
        <input type="submit" value="Ajouter">
    </form>
</div>


<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>