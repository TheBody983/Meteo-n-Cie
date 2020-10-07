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

function admin_action($login,$error)
{
	$users = get_all_users();
	require 'view/admin.php';
}

function main_action($login, $error)
{
    if(isset($login) && ($userid = get_userID($login) ) != NULL)
        if(get_userID($login) == 1) $stations=get_all_stations(-1);
        else $stations=get_all_stations($userid);
    else $stations=get_all_stations();
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
    if(isset($_GET['stationID'])){
        $station = get_station($_GET['stationID']);
    }
    else
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
    if(isset($_GET["projet"]))$projet = get_projet($_GET["projet"]);
    if(isset($_POST['addStationProjet'])){
        add_station_to_project($_POST["addStationProjet"], $projet["infos"]["projetID"]);
        header("refresh:0;url=http://localhost/Meteo-n-Cie/index.php/projet?projet=".$projet["infos"]["projetID"]);
    }
    if(isset($_POST['delStationProjet'])) {
        del_station_from_project($_POST["delStationProjet"], $projet["infos"]["projetID"]);
        header("refresh:0;url=http://localhost/Meteo-n-Cie/index.php/projet?projet=" . $projet["infos"]["projetID"]);
    }

    if(isset($_POST['addUserProjet'])){
        add_user_to_project($_POST["addUserProjet"], $projet["infos"]["projetID"]);
        header("refresh:0;url=http://localhost/Meteo-n-Cie/index.php/projet?projet=".$projet["infos"]["projetID"]);
    }
    if(isset($_POST['delUserProjet'])){
        del_user_from_project($_POST["delUserProjet"], $projet["infos"]["projetID"]);
        header("refresh:0;url=http://localhost/Meteo-n-Cie/index.php/projet?projet=".$projet["infos"]["projetID"]);
    }
    require 'view/projet.php';
}

?>
