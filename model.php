<?php
//DATABASE CONNECTION
function open_database_connection()
{
    $link = mysqli_connect('localhost', 'model', '1234', 'meteo_n_cie');
    return $link;
}

function close_database_connection($link)
{
    mysqli_close($link);
}

//USERS

/*function get_all_users()
{
    $link = open_database_connection();
    $resultall = mysqli_query($link,'SELECT login, userID FROM users');
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
    //Connexion à la BDD
    $link = open_database_connection();

    //Securise la chaîne login
    $login = htmlspecialchars($login);
    $login =  str_replace(array('\n','\r',PHP_EOL),' ',$login);

    //Prepare la requête
    $query = mysqli_prepare($link,'SELECT userID FROM users WHERE login=?');
    mysqli_stmt_bind_param($query, 's', $login);

    //Execute la requête et récupère les résultats
    mysqli_stmt_execute($query);
    mysqli_stmt_bind_result($query, $userID);

    //Fermeture de la connexion à la BDD
    close_database_connection($link);

    //Retourne le résultat
    return $userID;
}

function getUserLogin($id)
{
    //Connexion à la BDD
    $link = open_database_connection();

    //Securise la valeur id
    $id = intval($id);

    //Prepare la requête
    $query = mysqli_prepare($link,'SELECT login FROM users WHERE userID=?');
    mysqli_stmt_bind_param($query, 'i', $id);

    //Execute la requête et récupère les résultats
    mysqli_stmt_execute($query);
    mysqli_stmt_bind_result($query, $login);

    //Fermeture de la connexion à la BDD
    close_database_connection($link);

    //Retourne le résultat
    return $login;
}
*/
function is_user( $login, $password )
{
    $isuser = False ;

    //Connexion à la BDD
    $link = open_database_connection();

    //Securise la chaîne login
    $login = htmlspecialchars($login);
    $login =  str_replace(array('\n','\r',PHP_EOL),' ',$login);

    //Prepare la requête
    $query = mysqli_prepare($link,'SELECT password FROM users WHERE login=?');
    mysqli_stmt_bind_param($query, 's', $login);

    //Execute la requête
    if(mysqli_stmt_execute($query)) {

        //Récupère le résultat
        $query = mysqli_stmt_get_result($query);
        $hash = mysqli_fetch_array($query, MYSQLI_NUM)[0];
        if(password_verify($password, $hash)) { //Vérifie si le mot de passe entré correspond au mot de passe stocké
            $isuser = True;
        }
    }

    close_database_connection($link);
    return $isuser;
}

function new_user($login,$pwd){
    $link = open_database_connection();

    //Securise la chaîne login
    $login = htmlspecialchars($login);
    $login =  str_replace(array('\n','\r',PHP_EOL),' ',$login);

    //Securise la chaîne pwd
    $pwd = htmlspecialchars($pwd);
    $pwd =  str_replace(array('\n','\r',PHP_EOL),' ',$pwd);

    //hash le pwd
    $pwd= password_hash($pwd, PASSWORD_DEFAULT);

    //echo $login;
    //echo $pwd;

    //Prepare la requête
    $query = mysqli_prepare($link,'INSERT INTO users(login, password) VALUES (?, ?)');
    mysqli_stmt_bind_param($query, 'ss', $login, $pwd);

    //execute la requête
    mysqli_stmt_execute($query);

    close_database_connection($link);
}

/*function delete_user($userID){
    $link = open_database_connection();
    $query= 'DELETE FROM users WHERE userID = "'.$userID.'"';
    mysqli_query($link, $query );
    close_database_connection($link);
}*/