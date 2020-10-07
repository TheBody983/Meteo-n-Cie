<?php $title= 'Administration'; ?>
<?php ob_start(); ?>
<body style="background-image: url('../graphs/fondcarte.png');">
<div id="containerListat">
<?php
echo '<table>';
    foreach($users as $user) {
        echo '<tr>';
            foreach ($user as $donnee) {

                echo '<td>' . $donnee . '</td>';
            }
            echo '<td><form method="post"action="admin">
                  <input type="text" id="hidden" name="delUser" value =' . $user["userID"] . ' hidden>
                  <input type="submit" value="Supprimer"></form></td>';
            echo '<td><form method="post"action="admin">
                  <input type="text" id="hidden" name="user" value =' . $user["userID"] . ' hidden>
                  <input type="submit" value="Editer"></form></td>';
        echo '</tr>';
    }
echo '</table>'
?>
</div>
</body>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
