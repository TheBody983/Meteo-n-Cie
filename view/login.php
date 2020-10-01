<?php $title= 'Connexion'; ?>
<?php ob_start(); ?>
<div id="container">
    <form method="post" action="main">
        <p><label for="login"> Identifiant </label> :</p>
        <input type="text" name="login" id="login" maxlength="12" required/>
        <br />
        <p><label for="password"> Mot de Passe </label> :</p>
        <input type="password" name="password" id="password" maxlength="12" required />
        <br/>
        <input id="connexion" type="submit" value="Envoyer">
        <p>Pas de compte ? </p>
        <button id="connexion" onclick="window.location.href = 'register'">S'inscrire</button>
    </form>
    <button id="connexion" onclick="window.location.href = 'main'">Annuler</button>
</div>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>