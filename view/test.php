<?php $title= 'Connexion'; ?>
<?php ob_start(); ?>
<?php
echo '<div class="containerCol">';



?>
<p>Template</p>
test
    <button onclick="window.location.href = 'main';">Revenir à l'accueil</button>
<?php echo '</div>'; ?>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>