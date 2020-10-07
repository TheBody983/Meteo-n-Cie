<!DOCTYPE html>

<html lang="fr">
<head>
    <title><?php echo $title;?></title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../graphs/meteoncie.ico" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <link rel="stylesheet" href="../stylesheet.css"/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
</head>

<body class = "container">
<header class="container">
    <a href="../index.php/main"><img id='titre' src="../graphs/titre.png"></a>
<?php
    if(isset($login)) {
        if ($login != ' ') {
            echo '<div><p>Connecté en tant que ' . $login . '</p> ';
            echo '<button><a href="../index.php/logout">Déconnexion</a></button></div>';
        }

        switch ($error) {
            case 'not connected':
                echo "<p>Vous n'êtes pas connecté. Veuillez vous connecter ou vous créer un compte.</p>";
                break;
            case 'bad login/pwd':
                echo "<p>Erreur d'authentification. Veuillez vous connecter ou vous créer un compte.</p>";
                break;
        }
    } ?>
</header>

<div class="container">
<?php if($title != 'Connexion' && $title != 'Register'){?>

    <nav id="menu" class="containerCol" >
    <img id='titremenu' src="../graphs/menu.png"/>
<?php
    if(!isset($_SESSION['login']))
        echo '<button id="connexion" onclick="window.location.href = \'login\'">Se connecter/ S\'inscrire</button>';
    ?>
    <p>
        <a class="menu" href="main">Page d'Accueil</a>
    </p>
    <p>
        <a class="menu" href="listeStation">Liste des stations</a>
    </p>
<?php if (isset($_SESSION['login'])) {?>
    <p>
        <a class="menu" href="gestionStation">Gestion des stations</a>
    </p>
    <p>
        <a class="menu" href="gestionProjet">Projet</a>
    </p>
    <?php } ?>
    <p>
        <a class="menu" href="donnees">Données</a>
    </p>
    <?php
    if (isset($_SESSION['login'])) {
        if(get_userID($_SESSION['login'])==1){ ?>
    <p>
        <a class="menu" href="test">Tests</a>
    </p>
    <p>
        <a class="menu" href="admin">Administration</a>
    </p>
    <p>
        <a class="menu" href="">Messagerie</a>
    </p>
<?php }
    }
    ?>
    </section>
</nav>

<?php }
echo $content; ?>
</div>
<footer>
</footer>
</body>
</html>