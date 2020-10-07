<?php $title= 'Administration'; ?>
<?php ob_start(); ?>
<body style="background-image: url('../graphs/fondcarte.png');">
<div id="containerListat">
<?php
echo '<div class="containerCol box">';

echo '<table>';
    echo '<tr><th>userID</th><th>login</th><th>prenom</th><th>nom</th><th>mail</th><th>authorisations</th><th>date inscription</th><th>description</th><th>actions</th></tr>';
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
echo '</table>';
    echo '</div>';
?>
</div>
</body>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
