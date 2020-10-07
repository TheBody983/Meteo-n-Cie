<?php $title= 'Connexion'; ?>
<?php ob_start(); ?>
<body style="background-image: url('../graphs/fondcarte.png');">
<div id="container" >
    <form method="post" action="main">
        <p><label for="login"> Identifiant </label> :</p>
        <input type="text" name="login" id="login" maxlength="12" required/>
        <br />
        <label for="password"> Mot de Passe </label> :
        <input type="password" name="password" id="password" maxlength="12" required />
        <br/>
        <input id="connexionLog" type="submit" value="Envoyer">
        <p>Pas de compte ? </p>
        <button id="connexionLog" onclick="window.location.href = 'register'">S'inscrire</button>
    </form>
    <button id="connexionLog" onclick="window.location.href = 'main'">Annuler</button>
</div>
</body>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
