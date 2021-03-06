<?php $title= 'Register'; ?>
<?php ob_start(); ?>

<!-- Demande à l'utilisateur ces informations pour la création de son compte -->
<div class="containerCol">
<form method="post" action="main" class="containerCol box">
    <label for="name"> Nom </label> :
    <input type="text" name="name" id="name" required/>
    <br />
    <label for="surname"> Prenom </label> :
    <input type="text" name="surname" id="surname" required/>
    <br />
    <label for="idmail"> E-mail </label> :
    <input type="text" name="mail" id="idmail" required/>
    <br />
    <br />
    <label for="idlogin"> Votre identifiant </label> :
    <input type="text" name="login" id="idlogin" required/>
    <br />
    <label for="idpassword"> Votre mot de passe </label> :
    <input type="password" name="password" id="idpassword" required/>
    <br />

    <input id="connexion" type="submit" value="Envoyer"/>
</form>
    <div class="containerCol box">
<button id="connexion" onclick = "history.back()">Annuler</button>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
