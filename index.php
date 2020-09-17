<?php
//Code Source : https://github.com/TheBody983/Meteo-n-Cie
//oui
// charge et initialise les bibliothèques globales
require_once 'model.php';
require_once 'controllers.php';

//Démarrage de la session
session_start();

//RECUPERE L'URL ET LE COUPE EN MORCEAUX AU NIVEAU DE '/'
$action = explode('/',parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
//PREND LE DERNIER MORCEAU DE $URI SOIT LE PARAMETRE
$action = end($action);



//Enregistrement avant la vérification d'authentification
if('register' == $action){
    $login = ' ';
    $error = ' ';
    register_action($login, $error);
    exit;
}

// vérification utilisateur authentifié
/*
if(!isset($_SESSION['login']) ) {
    if( !isset($_POST['login']) || !isset($_POST['password']) ) {
        $error='not connected';
        $action = 'login';
    }
    elseif( !is_user($_POST['login'],$_POST['password']) ){
        $error='bad login/pwd';
        $action = 'login';
    }
    else {
        $_SESSION['userID'] = getUserID($_POST['login']);
        $_SESSION['login'] = getUserLogin($_SESSION['userID']);
        $login = $_SESSION['login'];
    }
}
else{
    $login = $_SESSION['login'] ;
}
*/



//Temporaire
echo "\$action = ".$action;
if(isset($_POST['login'])) {
    $login = $_POST['login'];
    $_SESSION['login'] = $_POST['login'];
}
elseif($action != 'login') {
    $login = ' ';
    $action = '';
}


if(!isset($error)){
    $error = ' ';
}
if(!isset($login)){
    $login = ' ';
}
//if(!isset($login)){
//Corriger l'adresse pour éviter les bugs de type "/Annonce/annonces"
if($action == '')
{
    header("refresh:0;url=http://localhost/Meteo'n'Cie/index.php/login");
}
//}


switch ( $action ) {

    case 'login' :                      //Connecter si pas de session
        login_action($login, $error);
        break;

    case 'main' :                       //Accèder à la page Principale
        main_action($login, $error);
        break;

    case 'index.php':                   //Rediriger vers annonces si index.php
        homepage();
        break;

    case 'logout' :                     //Se déconnecter
        logout();
        break;

    default :
        header('Status: 404 Not Found');
        echo '<html><body><h1>My Page Not Found</h1></body></html>';

        echo $action;

}
?>