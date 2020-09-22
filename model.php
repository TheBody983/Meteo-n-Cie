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

function new_user($login,$pwd,$nom,$prenom,$mail)
{
    /** Créé un nnouvel utilisateur dans la BDD
     *
     * Récupère un login et un password, les sécurise pour éviter les injections, prépare puis envoie la requête
     *
     * @param string $login un nom d'utilisateur
     * @param string $password un mot de passe
     * @param string $nom le nom de l'utilisateur
     * @param string $prenom le prenom de l'utilisateur
     * @param string $mail le mail de l'utilisateur
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
    $query = mysqli_prepare($link,'INSERT INTO users(login, password, nom, prenom, mail) VALUES (?, ?, ?, ?, ?)');
    mysqli_stmt_bind_param($query, 'sssss', $login, $pwd,$nom,$prenom,$mail);

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

    $link = open_database_connection();

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

function get_all_stations($userID){
    /** Récupère les informations de toutes les stations
     *
     * @return array la liste des stations avec leurs informations
     */

    $userID = intval($userID);

    $link = open_database_connection();

    //Prepare la requête
    $query = mysqli_prepare($link,'SELECT * FROM stations WHERE visibility = "public" OR userID = ?');
    mysqli_stmt_bind_param($query, 'i', $userID);

    //Execute la requête
    if(mysqli_stmt_execute($query)) {
        //Récupère le résultat
        $query = mysqli_stmt_get_result($query);

        $stations = array();
        while($station = mysqli_fetch_array($query, MYSQLI_NUM)){
            $stationtmp = array(
                "stationID" => $station[0],
                "userID" => $station[1],
                "model" => $station[2],
                "description" => $station[4],
                "localisation" => $station[5]);
            $stations[] = $stationtmp;
        }
    }

    close_database_connection($link);

    return $station;
}

function get_station($stationID){
    /** Récupère les informations de toutes les stations
     *
     * @param int $stationID un identifiant de station
     *
     * @return array la liste des stations avec leurs informations
     */

    $userID = intval($userID);

    $link = open_database_connection();

    //Prepare la requête
    $query = mysqli_prepare($link,'SELECT * FROM stations WHERE stationID = ?');
    mysqli_stmt_bind_param($query, 'i', $userID);

    //Execute la requête
    if(mysqli_stmt_execute($query)) {
        //Récupère le résultat
        $query = mysqli_stmt_get_result($query);
        $stationtmp = mysqli_fetch_array($query, MYSQLI_NUM);
            $station = array(
                "stationID" => $station[0],
                "userID" => $station[1],
                "model" => $station[2],
                "description" => $station[4],
                "localisation" => $station[5]);

    }

    close_database_connection($link);

    return $mesures;
}

//MESURES
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

function get_mesures($mesure_name, $filter = NULL){
    /** Récupère des mesures
     *
     * Récupère des mesures correspondant à un paramètre
     *
     * @param string $mesure_name type de mesure recherchée p. ex. "temperature"
     * @param string $filter pas encore implémenté
     *
     * @return array les mesures correspondantes aux données recherchées
     */

    //Connexion à la BDD
    $link = open_database_connection();

    //Securise la chaîne login
    $mesure_name = htmlspecialchars($mesure_name);
    $mesure_name =  str_replace(array('\n','\r',PHP_EOL),' ',$mesure_name);

    //Prepare la requête
    if(!isset($filter)) {
        $query = mysqli_prepare($link, 'SELECT * FROM mesures WHERE mesure_name = ?');
        mysqli_stmt_bind_param($query, 's', $mesure_name);
    }

    //Execute la requête
    if(mysqli_stmt_execute($query)) {

        //Récupère le résultat
        $query = mysqli_stmt_get_result($query);
        $mesures = array();
        while($mesure = mysqli_fetch_array($query, MYSQLI_NUM)){
            $mesuretmp = array(
                "date" => $mesure[0],
                "stationID" => $mesure[1],
                "name" => $mesure[2],
                "value" => $mesure[3]);
            $mesures[] = $mesuretmp;
        }
    }

    close_database_connection($link);
    return $mesures;
}

function get_mesure_name(){
    /** Récupère les différents noms de mesures
     *
     * @return array les noms de mesure
     */

    //Connexion à la BDD
    $link = open_database_connection();


    //Prepare la requête
    if(!isset($filter)) {
        $query = mysqli_prepare($link, 'SELECT DISTINCT mesure_name FROM mesures');
    }

    //Execute la requête
    if(mysqli_stmt_execute($query)) {

        //Récupère le résultat
        $query = mysqli_stmt_get_result($query);
        $mesure_name = array();
        while($mesure = mysqli_fetch_array($query, MYSQLI_NUM)){
            $mesure_name[] = $mesure[0];
        }
    }

    close_database_connection($link);
    return $mesure_name;
}

