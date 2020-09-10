
<!DOCTYPE html>
<html lang="fr">
<head>
<title><?php echo $title;?></title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>

<body>
<header>
    <h1><a href="http://localhost/Meteo'n'Cie/index.php">Site d'Annonces</a></h1>
    <?php
    if($login != ' ') {
        echo '<div><p>Connecté en tant que '.$login.'</p> ' ;
        echo '<button><a href="../index.php/logout">Déconnexion</a></button></div>';
    }

    switch( $error ) {
            case 'not connected':
                echo "<p>Vous n'êtes pas connecté. Veuillez vous connecter ou vous créer un compte.</p>";
                break;
            case 'bad login/pwd':
                echo "<p>Erreur d'authentification. Veuillez vous connecter ou vous créer un compte.</p>";
                break;
        }?>
    <p>Layout Header</p>
</header>

<?php echo $content; ?>

<footer>
    <p>Layout Footer</p>
</footer>
</body>
</html>