<?php $title= 'projet'; ?>
<?php ob_start(); ?>
<?php
echo '<div class="containerCol"><div class="containerCol box">';
echo '<p>Edition de projet</p>';

echo '<table>';
echo '<tr><th>Projet</th><th>Nom</th><th>Description</th>';

    echo '<tr>';
    echo '<td><div>'.$projet["infos"]["projetID"].'</div></td>';
    echo '<td><div id="nom">'.$projet["infos"]["nom"].'</div></td>';
    echo '<td><div id="description">'.$projet["infos"]["description"].'</div></td>';
    echo '</tr>';

echo '</table></div>';



echo '<div class="containerCol box"><table>';
foreach($projet["stations"] as $station){
    echo '<tr>';
    
        echo '<td>'.$station["stationID"].'</td>';
        echo '<td>'.$station["userID"].'</td>';
        echo '<td>'.$station["model"].'</td>';
        echo '<td>'.$station["visibility"].'</td>';
        echo '<td>'.$station["description"].'</td>';
        echo '<td>'.$station["localisation"].'</td>';
		
        echo '<td class="container">
            <form method="post" action="projet?projet='.$projet["infos"]["projetID"].'">
            <input type="text" name="delStationProjet" value ='.$station["stationID"].' hidden>
            <input type="submit" value="Supprimer"></form>';
    
    echo '</tr>';
}
echo '</table></div>';



echo '<div class="containerCol box"><table>';
foreach($projet["users"] as $user){
    echo '<tr>';
        foreach ($user as $info) {
            echo '<td>' . $info . '</td>';
        }
        echo '<td class="container">
            <form method="post"action="projet?projet='.$projet["infos"]["projetID"].'">
            <input type="text" name="delUserProjet" value ='.$user["userID"].' hidden>
            <input type="submit" value="Supprimer"></form>';
    
    echo '</tr>';
}
echo '</table></div>';


?>

<div id="addStationProjet" class="box">
    <p>Ajouter une station au Projet</p>

    <form method="post" action="projet?projet=<?php echo $projet["infos"]["projetID"];?>">
        <label for="addStationProjet">stationID</label> :
        <input type="text" name="addStationProjet" id="addStationProjet">
        <input type="submit" value="Ajouter">
    </form>
</div>



<div id="addUserProjet" class="box">
    <p>Ajouter un utilisateur au Projet</p>

    <form method="post" action="projet?projet=<?php echo $projet["infos"]["projetID"];?>">
        <label for="addUserProjet">userID</label> :
        <input type="text" name="addUserProjet" id="addUserProjet">
        <input type="submit" value="Ajouter">
    </form>
</div>

    <!--
    <div id="idGestionUserProjet">
        <p>Ajouter un utilisateur au Projet</p>

        <form method="post"action="gestionUserProjet">
            <label for="addUserProjet">Nom de l'utilisateur</label> :<input type="text" name="addUserProjet" id="addUserProjet" value = "yes" hidden>
            <label for="prenomUserProjet">Prenom</label> : <input type="text" name="prenomUserProjet" id="prenomUserProjet">
            <input type="submit" value="Ajouter">
        </form>
    </div>
    -->

<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>