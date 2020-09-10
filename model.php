<?php
//DATABASE CONNECTION
function open_database_connection()
{
    $link = mysqli_connect('localhost', 'root', '', 'annonces');
    return $link;
}

function close_database_connection($link)
{
    mysqli_close($link);
}

//USERS

function get_all_users()
{
    $link = open_database_connection();
    $resultall = mysqli_query($link,'SELECT login, userID FROM users WHERE userID != "Server"');
    $users = array();
    while ($row = mysqli_fetch_assoc($resultall)) {
        $users[] = $row;
    }
    mysqli_free_result( $resultall);
    close_database_connection($link);
    return $users;

}

function getUserID($login)
{
    $link = open_database_connection();
    $query = 'SELECT userID FROM users WHERE login="'.$login.'"';
    $result = mysqli_query($link, $query);
    if($result){
        $id = mysqli_fetch_assoc($result);
        mysqli_free_result( $result);
    }
    else $id = false;
    close_database_connection($link);
    return $id['userID'];
}

function getUserLogin($id)
{
    $link = open_database_connection();
    $query = 'SELECT login FROM users WHERE userID="'.$id.'"';
    $result = mysqli_query($link, $query);
    if($result){
        $login = mysqli_fetch_assoc($result);
        mysqli_free_result( $result);
    }
    else $login = false;
    close_database_connection($link);
    return $login['login'];
}

function is_user( $login, $password )
{
$isuser = False ;
$link = open_database_connection();
$query= 'SELECT login, userID FROM Users WHERE login="'.$login.'" and password="'.$password.'"';
$result = mysqli_query($link, $query );
if( mysqli_num_rows( $result) )
    $isuser = True;
mysqli_free_result( $result );
close_database_connection($link);
return $isuser;
}

function new_user($login,$pwd,$surname,$name,$mail,$country,$city){
    $link = open_database_connection();
    $query= 'SELECT MAX(userID) AS ID FROM users' ;
    $res = mysqli_query($link, $query );
    $id = mysqli_fetch_assoc($res)['ID']+1;
    $query= 'INSERT INTO users VALUES ("'.$id.'", "'.$login.'", "'.$pwd.'", "'.$surname.'", "'.$name.'", "'.$mail.'", "'.$country.'", "'.$city.'")' ;
    mysqli_query($link, $query );
    close_database_connection($link);
}

function delete_user($userID){
    $link = open_database_connection();
    $query= 'DELETE FROM users WHERE userID = "'.$userID.'"';
    mysqli_query($link, $query );
    close_database_connection($link);
}