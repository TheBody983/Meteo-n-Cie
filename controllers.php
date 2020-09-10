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
    require 'view/main.php';
}

function homepage(){
    header("refresh:0;url=http://localhost/Meteo'n'Cie/index.php/main");
}

function logout(){
    session_destroy();
    header("refresh:0;url=http://localhost/Meteo'n'Cie/index.php/login");

}

?>
