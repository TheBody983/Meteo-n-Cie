<?php $title= 'Gestion des Stations'; ?>
<?php ob_start(); ?>
<div>
    <form method="post" action="main">
        <p><label for="login"> Identifiant </label> :</p>
        <input type="text" name="login" id="login" maxlength="12" required/>
        <br />
        <p><label for="password"> Mot de Passe </label> :</p>
        <input type="password" name="password" id="password" maxlength="12" required />
        <br/>
        <input type="submit" value="Envoyer">
        <p>Pas de compte ? </p>
        <a href="/Meteo'n'Cie/index.php/register">Creer un compte</a>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
