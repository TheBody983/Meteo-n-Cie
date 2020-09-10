<?php
function login_action($login , $error)
{
    require 'view/login.php';
}

function register_action($login, $error)
{
    require 'view/register.php';
}

function template_action($login, $error)
{
    require 'view/template.php';
}

function homepage(){
    header("refresh:0;url=../index.php/");
}

function logout(){
    session_destroy();
    header("refresh:0;url=../index.php/login");

}

?>
