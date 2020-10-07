<?php $title= 'Administration'; ?>
<?php ob_start(); ?>
<div class="content">
<div class="containerCol box">
<table>
    <tr>
        <th>userID</th>
        <th>login</th>
        <th>prenom</th>
        <th>nom</th>
        <th>mail</th>
        <th>authorisations</th>
        <th>date inscription</th>
        <th>description</th>
        <th>actions</th>
    </tr><?php
        //Affiche un tableau contenant tout les utilisateurs plus une option pour les supprimer (non-implémenté)
        foreach($users as $user) {
        echo "\n\t".'<tr>';
            foreach ($user as $donnee) {
                echo "\n\t\t".'<td>' . $donnee . '</td>';
            }
            echo "\n\t\t".'<td class="container"><form method="post"action="admin">
            <input type="text" name="delUser" value =' . $user["userID"] . ' hidden>
            <input type="submit" value="Supprimer"></form>';
            echo '<form method="post"action="admin">
            <input type="text" name="user" value =' . $user["userID"] . ' hidden>
            <input type="submit" value="Editer"></form></td>';
        echo "\n\t".'</tr>'."\n";
        }?>
</table>
</div>
</div>


<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
