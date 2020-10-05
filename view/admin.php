<?php $title= 'Administration'; ?>
<?php ob_start(); ?>
<?php
echo '<table>';
    foreach($users as $user) {
        echo '<tr>';
            foreach ($user as $donnee) {

                echo '<td>' . $donnee . '</td>';
            }
            echo '<td><form method="post"action="admin">
                  <input type="text" name="delUser" value =' . $user["userID"] . ' hidden>
                  <input type="submit" value="Supprimer"></form></td>';
            echo '<td><form method="post"action="admin">
                  <input type="text" name="user" value =' . $user["userID"] . ' hidden>
                  <input type="submit" value="Editer"></form></td>';
        echo '</tr>';
    }
echo '</table>'
?>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
