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
    /** Verifie si un utilisateur est enregistré
     *
     * Récupère un login et un password, les sécurise pour éviter les injections, prépare puis envoie la requête
     *
     * @param string $login un nom d'utilisateur
     * @param string $password un mot de passe
     *
     * @return True si l'utilisateur des enregistré, False sinon
     */
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

function new_user($login,$pwd)
{
    /** Créé un nnouvel utilisateur dans la BDD
     *
     * Récupère un login et un password, les sécurise pour éviter les injections, prépare puis envoie la requête
     *
     * @param string $login un nom d'utilisateur
     * @param string $password un mot de passe
     */
    $link = open_database_connection();

    //Securise la chaîne login
    $login = htmlspecialchars($login);
    $login =  str_replace(array('\n','\r',PHP_EOL),' ',$login);

    //Securise la chaîne pwd
    $pwd = htmlspecialchars($pwd);
    $pwd =  str_replace(array('\n','\r',PHP_EOL),' ',$pwd);

    //hash le pwd
    $pwd= password_hash($pwd, PASSWORD_DEFAULT);

    //Prepare la requête
    $query = mysqli_prepare($link,'INSERT INTO users(login, password) VALUES (?, ?)');
    mysqli_stmt_bind_param($query, 'ss', $login, $pwd);

    //execute la requête
    mysqli_stmt_execute($query);

    close_database_connection($link);
}

//STATIONS
function new_station($userID, $model = NULL, $vis = 'Private', $descr = ' ', $loc = ' ')
{
    /** Créé une nouvelle station dans la BDD
     *
     * Récupère les informations d'une station, les sécurise pour éviter les injections, prépare puis envoie la requête
     *
     * @param integer $userID un identifiant d'utilisateur
     * @param string $model un modèle de station
     * @param string $vis la visibilité de la station
     * @param string $descr une description de la station
     * @param string $loc la localisation de la station
    */
         
    $userID = intval($userID);

    $model = htmlspecialchars($model);
    $model =  str_replace(array('\n','\r',PHP_EOL),' ',$model);

    $vis = htmlspecialchars($vis);
    $vis =  str_replace(array('\n','\r',PHP_EOL),' ',$vis);

    $descr = htmlspecialchars($descr);
    $descr =  str_replace(array('\n','\r',PHP_EOL),' ',$descr);

    $loc = htmlspecialchars($loc);
    $loc =  str_replace(array('\n','\r',PHP_EOL),' ',$loc);

    //Prepare la requête
    $query = mysqli_prepare($link,'INSERT INTO stations(userID, model, visibility, description, localisation) VALUES (?, ?, ?, ?, ?)');
    mysqli_stmt_bind_param($query, 'issss', $userID, $model, $vis, $descr, $loc);
    
    //execute la requête
    mysqli_stmt_execute($query);

    close_database_connection($link);
}

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