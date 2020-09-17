<?php $title= 'Register'; ?>
<?php ob_start(); ?>
<form method="post" action="main">
    <label for="name"> Nom </label> :
    <input type="text" name="name" id="idname"/>
    <br />
    <label for="surname"> Prenom </label> :
    <input type="text" name="surname" id="idsurname"/>
    <br />
    <label for="mail"> E-Mail </label> :
    <input type="text" name="mail" id="idmail"/>
    <br />
    <br />
    <br />
    <label for="idlogin"> Votre identifiant </label> :
    <input type="text" name="login" id="idlogin" maxlength="12" required/>
    <br />
    <label for="idpassword"> Votre mot de passe </label> :
    <input type="password" name="password" id="idpassword" maxlength="12" required/>
    <br />
    <input type="submit" value="Envoyer"/>
</form>
<a href="/Meteo-n-Cie/index.php/main"> Annuler </a>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
