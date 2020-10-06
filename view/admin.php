<?php $title= 'Administration'; ?>
<?php ob_start(); ?>
<?php
echo '<div class="containerCol box">';

echo '<table>';
    echo '<tr><th>userID</th><th>login</th><th>prenom</th><th>nom</th><th>mail</th><th>authorisations</th><th>date inscription</th><th>description</th><th>actions</th></tr>';
    foreach($users as $user) {
        echo '<tr>';
            foreach ($user as $donnee) {
                echo '<td>' . $donnee . '</td>';
            }
            echo '<td class="container"><form method="post"action="admin">
                  <input type="text" name="delUser" value =' . $user["userID"] . ' hidden>
                  <input type="submit" value="Supprimer"></form>';
            echo '<form method="post"action="admin">
                  <input type="text" name="user" value =' . $user["userID"] . ' hidden>
                  <input type="submit" value="Editer"></form></td>';
        echo '</tr>';
    }
echo '</table>';
    echo '</div>';
?>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
