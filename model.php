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

//STATIONS
function new_mesure($stationID, $name, $value)
{
    /** Créé une nouvelle mesure dans la BDD
     *
     * Récupère une mesure, la sécurise pour éviter les injections, prépare puis envoie la requête
     *
     * @param integer $stationID un identifiant de station
     * @param string $name un nom de mesure
     * @param string $value une valeur de mesure
     */

    $link = open_database_connection();

    $stationID = intval($stationID);

    $value = floatval($value);

    $name = htmlspecialchars($name);
    $name =  str_replace(array('\n','\r',PHP_EOL),' ',$name);

    //Prepare la requête
    $query = mysqli_prepare($link,'INSERT INTO mesures(stationID, mesure_name, mesure_value) VALUES (?, ?, ?)');
    mysqli_stmt_bind_param($query, 'isd', $stationID, $name, $value);

    //execute la requête
    mysqli_stmt_execute($query);

    close_database_connection($link);
}

