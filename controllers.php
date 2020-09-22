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

function homepage(){
    header("refresh:0;url=http://localhost/Meteo-n-Cie/index.php/main");
}

function logout(){
    session_destroy();
    header("refresh:0;url=http://localhost/Meteo-n-Cie/index.php/login");

}

function mesures_action(){
    get_mesure();
    require 'view/donnee.php';
}

function station_action($login, $error){
    get_station();
    require 'view/model.php';
}

function allStations_action($login, $error){
    get_all_stations();
    require 'view/model.php';
}
?>
