<?php
function login_action($login , $error)
{
    require 'view/login.php';
}

function acces_controller_admin($login)
{
    require 'view/admin.php';
}
function register_action($login, $error)
{
    require 'view/register.php';
}

function main_action($login, $error)
{
    if(isset($login) && ($userid = get_userID($login) ) != NULL)
            get_all_stations($userid);
    else get_all_stations();
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
    if(isset($_POST['station']))
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

function listeStations_action($login, $error)
{
    $stations = get_all_stations(get_userID($login));
    require 'view/listeStation.php';
}





function gestion_projets_action($login, $error){
    $projets = get_all_projet();
    if(isset($_POST['addProjet'])){
        new_project($_POST['nameProjet'], $_POST['descriptionProjet']);
        header("refresh:0;url=http://localhost/Meteo-n-Cie/index.php/gestionProjet");
    }
    if(isset($_POST['delProjet'])){
        del_projet($_POST['delProjet']);
        header("refresh:0;url=http://localhost/Meteo-n-Cie/index.php/gestionProjet");
    }
    require 'view/gestionProjet.php';
}

function projet_action($login, $error){
    $projet = get_projet($_POST["projet"]);
    if(isset($_POST['addStationProjet'])){
        add_station_to_project($_POST["addStationProjet"], $projetID);
        header("refresh:0;url=http://localhost/Meteo-n-Cie/index.php/projet");
    }
    if(isset($_POST['removeStationProjet'])){
        remove_station($_POST['removeStationProjet']);
        header("refresh:0;url=http://localhost/Meteo-n-Cie/index.php/projet");
    }
    require 'view/projet.php';
}
/*
function gestionUserProjets_action($login, $error){
    $projet = get_projet(1);
    if(isset($_POST['addUserProjet'])){
        add_user_to_project($userID, $projetID, $priv = NULL);
		header("refresh:0;url=http://localhost/Meteo-n-Cie/index.php/projet");
    }
    if(isset($_POST['removeUserProjet'])){
        remove_user($_POST['removeUserProjet']);
        header("refresh:0;url=http://localhost/Meteo-n-Cie/index.php/projet");
    }
    require 'view/projet.php';
}
*/
?>
