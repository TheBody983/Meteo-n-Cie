
<!DOCTYPE html>
<html lang="fr">
<head>
<title><?php echo $title;?></title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" type="image/x-icon" href="../graphs/meteoncie.ico" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<?php if(isset($login)){if($login == "Aphaz"||$login == "aphaz")
{
    echo '<link rel="stylesheet" href="../index2.css"/>';
}
else
{
    echo '<link rel="stylesheet" href="../index.css"/>';
}} ?>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
</head>

<body>
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

<?php echo $content; ?>

<footer>
</footer>
</body>
</html>