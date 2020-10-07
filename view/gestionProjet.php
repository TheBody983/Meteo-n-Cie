<?php $title= 'Gestion des Projets'; ?>
<?php ob_start(); ?>
<body style="background-image: url('../graphs/fondcarte.png');">
<div id="containerListat">
<?php

echo '<p>Liste des Projets :</p>';

echo '<table>';
echo '<tr><th>Projet</th><th>Nom</th><th>Description</th></tr>';

foreach($projets as $projet){
    echo '<tr>';
    echo '<td><div>'.$projet["projetID"].'</div></td>';
    echo '<td><div id="nom">'.$projet["nom"].'</div></td>';
    echo '<td><div id="description">'.$projet["description"].'</div></td>';

    echo '<td><div class="container"><form method="post"action="gestionProjet">
        <input type="text" id="hidden" name="delprojet" value ='.$projet["projetID"].' hidden>
        <input type="submit" id="connexionGestat" value="Supprimer"></form></div></td>';

    echo '<td><form method="post"action="projet">
        <input type="text" id="hidden" name="projet" value ='.$projet["projetID"].' hidden>
        <input type="submit" id="connexionGestat" value="Editer"></form></td>';

    echo '</tr>';
}
echo '</table>';
if(isset($_SESSION['login']))
    echo '<div id="containerGestat">
    <p>Ajouter un Projet</p>

    <form method="post"action="gestionProjet">
        <input type="text" id="hidden" name="addProjet" value = "yes"/>
        <label for="nameProjet">Nom de Projet</label> :<input type="text" name="nameProjet" id="nameProjet" value = "" >
        <label for="descriptionProjet">Description du projet</label> : <input type="text" name="descriptionProjet" id="descriptionProjet">
        <input type="submit" id="connexionGestat" value="Ajouter">
    </form>
</div>';
?>
</div>
</body>

<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
