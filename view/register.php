<?php $title= 'Register'; ?>
<?php ob_start(); ?>
<form method="post" action="main">
    <label for="name"> Nom </label> :
    <input type="text" name="name" id="name"/>
    <br />
    <label for="surname"> Prenom </label> :
    <input type="text" name="surname" id="surname"/>
    <br />
    <label for="idlogin"> Votre identifiant </label> :
    <input type="text" name="login" id="idlogin"/>
    <br />
    <label for="idpassword"> Votre mot de passe </label> :
    <input type="password" name="password" id="idpassword" />
    <br />
    <input type="submit" value="Envoyer"/>
</form>
<a href="http://localhost/Meteo-n-Cie/index.php/main"> Annuler </a>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
