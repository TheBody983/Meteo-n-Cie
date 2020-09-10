<?php
//Code Source : https://github.com/TheBody983/Annonces

// charge et initialise les bibliothèques globales
require_once 'model.php';
require_once 'controllers.php';

//Démarrage de la session
session_start();

//RECUPERE L'URL ET LE COUPE EN MORCEAUX AU NIVEAU DE '/'
$action = explode('/',parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
//PREND LE DERNIER MORCEAU DE $URI SOIT LE PARAMETRE
$action = end($action);
//echo $uri;

//Enregistrement avant la vérification d'authentification
if('register' == $action){
    $login = ' ';
    $error = ' ';
    register_action($login, $error);
    exit;
}

//Création d'un nouvel utilisateur si vient de register
if(isset($_POST['mail'])){
    if(isset($_POST['city'])) {
        new_user($_POST['login'], $_POST['password'], $_POST['surname'], $_POST['name'], $_POST['mail'], $_POST['country'], $_POST['city']);
    }
    else{
        new_user($_POST['login'], $_POST['password'], $_POST['surname'], $_POST['name'], $_POST['mail'], ' ', ' ');
    }
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
if(isset($_POST['login'])) {
    $login = $_POST['login'];
    $_SESSION['login'] = $_POST['login'];
}
else {
    $login = ' ';
    $action = 'login';
}

if(!isset($login)){
    //Corriger l'adresse pour éviter les bugs de type "/Annonce/annonces"
    if($action == 'index.php')
    {
        header("refresh:0;url=../index.php/login");
    }
    $login = ' ';
}
if(!isset($error)){
    $error = ' ';
}

switch ( $action ) {

    case 'login' :                      //Connecter si pas de session
        login_action($login, $error);
        break;

    case 'template' :                  //Connecter si pas de session
        template_action($login, $error);
        break;

    case 'index.php':                   //Rediriger vers annonces si index.php et Session
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