<?php $title= 'Connexion'; ?>
<?php ob_start(); ?>
<div class="containerCol">
    <div  class="containerCol">
    <form method="post" action="main" class="containerCol box">
        <p><label for="login"> Identifiant </label> :</p>
        <input type="text" name="login" id="login" class="inputbox" maxlength="12" required/>
        <br />
        <p><label for="password"> Mot de Passe </label> :</p>
        <input type="password" name="password" id="password" maxlength="12" required />
        <br/>
        <input id="connexion" type="submit" value="Envoyer">
    </form>
    </div>
    <div class="containerCol box">
        <p>Pas de compte ? </p>
        <button id="connexion" onclick="window.location.href = 'register'">S'inscrire</button>
        <button id="connexion" onclick="window.location.href = 'main'">Annuler</button>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>