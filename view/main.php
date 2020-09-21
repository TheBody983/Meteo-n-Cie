<?php $title= 'Connexion'; ?>
<?php ob_start(); ?>

<p>Template</p>
test

<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>