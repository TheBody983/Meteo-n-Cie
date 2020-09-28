<?php $title= 'Connexion'; ?>
<?php ob_start(); ?>

<p>Template</p>
test
    <button onclick="window.location.href = 'accueil';">Revenir à l'accueil</button>

<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>