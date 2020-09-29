<?php
function login_action($login , $error)
{
    require 'view/login.php';
}

function register_action($login, $error)
{
    require 'view/register.php';
}

function main_action($login, $error)
{
    require 'view/accueil.php';
}

function homepage($login, $error){
    header("refresh:0;url=http://localhost/Meteo-n-Cie/index.php/main");
}

function logout(){
    session_destroy();
    header("refresh:0;url=http://localhost/Meteo-n-Cie/index.php/login");

}

function mesures_action($login, $error){
    //get_mesures();
    require 'view/donnees.php';
}

function station_action($login, $error){
    $station = get_station($_POST['station']);
    require 'view/station.php';
}

function gestionStations_action($login, $error){
    $stations = get_all_stations(get_userID($login));
    if(isset($_POST['addStation'])){
        new_station(get_userID($login),$_POST['model'], 'Private', $_POST['descriptionStation'], $_POST['coordonneesStation']);
        header("refresh:0;url=http://localhost/Meteo-n-Cie/index.php/gestionStation");

    }
    if(isset($_POST['delStation'])){
        del_station($_POST['delStation']);
        header("refresh:0;url=http://localhost/Meteo-n-Cie/index.php/gestionStation");
    }
    require 'view/gestionStation.php';
}

function accueil_action(){
    require 'view/accueil.php';
}
?>
