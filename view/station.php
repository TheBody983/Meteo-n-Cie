<?php $title= 'Connexion'; ?>
<?php ob_start(); ?>

<?php
foreach($station as $donnee){
    echo $donnee;
}
?>

<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>