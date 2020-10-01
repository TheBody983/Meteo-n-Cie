<?php
//DATABASE CONNECTION
function open_database_connection(){
    return mysqli_connect('localhost', 'model', '1234', 'meteo_n_cie');
}

function close_database_connection($link){
    mysqli_close($link);
}

//USERS
function user_exists($userID){
    /** Vérifie si un utilisateur existe dans la BDD
     *
     * @param mixed $userID l'identifiant de l'utilisateur à vérifier
     *
     * @return boolean si l'utilisateur existe
     *
     */
    $exists = False;

    if(gettype($userID)=="integer"){
        //Sécurise la valeur $userID
        $userID = intval($userID);

        //Connexion à la BDD
        $link = open_database_connection();

        //Prepare la requête
        $query = mysqli_prepare($link,'SELECT password FROM users WHERE userID=?');
        mysqli_stmt_bind_param($query, 'i', $userID);

        //Si la requête se passe bien
        if(mysqli_stmt_execute($query)){
            //Récupère le résultat
            $result = mysqli_stmt_get_result($query);

            //Si il y a un résultat
            if (mysqli_num_rows($result)){
                $exists = True;
            }
        }
        //Fermeture de la connexion à la BDD
        close_database_connection($link);
    }

    elseif(gettype($userID)=="string"){
        //Securise la chaîne login
        $userID = htmlspecialchars($userID);
        $userID = str_replace(array('\n', '\r', PHP_EOL), ' ', $userID);

        //Connexion à la BDD
        $link = open_database_connection();

        //Prepare la requête
        $query = mysqli_prepare($link,'SELECT password FROM users WHERE login=?');
        mysqli_stmt_bind_param($query, 's', $login);

        //Si la requête se passe bien
        if(mysqli_stmt_execute($query)){
            //Récupère le résultat
            $result = mysqli_stmt_get_result($query);

            //Si il y a un résultat
            if (mysqli_num_rows($result)){
                $exists = True;
            }
        }
        //Fermeture de la connexion à la BDD
        close_database_connection($link);
    }
    return $exists;
}

function is_user( $login, $password ){
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

    //Vérifie que les paramètres soient bien du bon type
    if(gettype($login)=="string" && gettype($password)=="string"){
        //Connexion à la BDD
        $link = open_database_connection();

        //Securise la chaîne login
        $login = htmlspecialchars($login);
        $login = str_replace(array('\n', '\r', PHP_EOL), ' ', $login);

        //Prepare la requête
        $query = mysqli_prepare($link, 'SELECT password FROM users WHERE login=?');
        mysqli_stmt_bind_param($query, 's', $login);

        //si l'exécution de la requête se passe bien
        if (mysqli_stmt_execute($query)){
            //Récupère le résultat
            $result = mysqli_stmt_get_result($query);

            //Si il y a un résultat
            if(mysqli_num_rows($result)){
                //Récupère le hash du mot de passe
                $hash = mysqli_fetch_row($result)[0];
                //Vérifie si le mot de passe entré correspond au mot de passe stocké
                if (password_verify($password, $hash)){
                    $isuser = True;
                }
            }
        }
        //Ferme la connexion à la BDD
        close_database_connection($link);
    }
    return $isuser;
}

function get_userID($login){
    /** récupère l'userID d'un utilistateur
     *
     * Récupère un login et renvoie l'userID associé
     *
     * @param string $login un nom d'utilisateur
     *
     * @return integer un identifiant d'utilisateur
     */

    $userID = NULL;

    if(gettype($login)=="string") {
        if (user_exists($login)){
            //Connexion à la BDD
            $link = open_database_connection();

            //Securise la chaîne login
            $login = htmlspecialchars($login);
            $login = str_replace(array('\n', '\r', PHP_EOL), ' ', $login);

            //Prepare la requête
            $query = mysqli_prepare($link, 'SELECT userID FROM users WHERE login=?');
            mysqli_stmt_bind_param($query, 's', $login);

            //Si la requête se passe bien
            if(mysqli_stmt_execute($query)){
                //Récupère les résultats de la requête
                $result = mysqli_stmt_get_result($query);

                //Si il y a un résultat
                if (mysqli_num_rows($result)){
                    $userID = mysqli_fetch_row($result)[0];
                }
            }
            close_database_connection($link);
        }
    }
    return $userID;

}

function get_login($userID){
    /** récupère le login d'un utilisateur
     *
     * @param integer $userID un identifiant d'utilisateur
     *
     * @return string un login
     */

    $login = NULL;

    if(gettype($userID)=="integer") {
        if (user_exists($userID)){
            //Connexion à la BDD
            $link = open_database_connection();

            //Securise la chaîne login
            $userID = intval($userID);

            //Prepare la requête
            $query = mysqli_prepare($link, 'SELECT login FROM users WHERE userID=?');
            mysqli_stmt_bind_param($query, 'i', $userID);

            //Si la requête se passe bien
            if(mysqli_stmt_execute($query)){
                //Récupère les résultats de la requête
                $result = mysqli_stmt_get_result($query);

                //Si il y a un résultat
                if (mysqli_num_rows($result)){
                    $login = mysqli_fetch_row($result)[0];
                }
            }
            close_database_connection($link);
        }
    }
    return $login;
}

function new_user($login,$pwd,$nom = NULL,$prenom = NULL,$mail = NULL)
{
    /** Créé un nnouvel utilisateur dans la BDD
     *
     * @param string $login un nom d'utilisateur
     * @param string $password un mot de passe
     * @param string $nom le nom de l'utilisateur
     * @param string $prenom le prenom de l'utilisateur
     * @param string $mail le mail de l'utilisateur
     */
    $link = open_database_connection();
    if(gettype($login)=="integer"
    && gettype($pwd)=="integer"
    && gettype($nom)=="integer"
    && gettype($prenom)=="integer"
    && gettype($mail)=="integer") {

        //Securise la chaîne login
        $login = htmlspecialchars($login);
        $login = str_replace(array('\n', '\r', PHP_EOL), ' ', $login);

        //Securise la chaîne pwd
        $pwd = htmlspecialchars($pwd);
        $pwd = str_replace(array('\n', '\r', PHP_EOL), ' ', $pwd);

        //Securise la chaîne pwd
        $nom = htmlspecialchars($nom);
        $nom = str_replace(array('\n', '\r', PHP_EOL), ' ', $nom);

        //Securise la chaîne login
        $prenom = htmlspecialchars($prenom);
        $prenom = str_replace(array('\n', '\r', PHP_EOL), ' ', $prenom);

        //Securise la chaîne pwd
        $mail = htmlspecialchars($mail);
        $mail = str_replace(array('\n', '\r', PHP_EOL), ' ', $mail);

        //hash le pwd
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);

        //Prepare la requête
        $query = mysqli_prepare($link, 'INSERT INTO users(login, password, nom, prenom, mail) VALUES (?, ?, ?, ?, ?)');
        mysqli_stmt_bind_param($query, 'sssss', $login, $pwd, $nom, $prenom, $mail);

        //execute la requête
        mysqli_stmt_execute($query);

        //Ferme la connexion à la BDD
        close_database_connection($link);
    }
}

function del_user($userID)
{
    /** Supprime un utilisateur dans la BDD
     *
     * @param integer $userID Un indentifiant de station
     */

    if(gettype($userID)=='integer') {
        //Sécurise $userID
        $userID = intval($userID);

        //Connexion à la BDD
        $link = open_database_connection();

        //Prepare la requête
        $query = mysqli_prepare($link, 'DELETE FROM users WHERE userID = ?');
        mysqli_stmt_bind_param($query, 'i', $userID);

        //execute la requête
        mysqli_stmt_execute($query);

        //ferme la connexion à la BDD
        close_database_connection($link);
    }
}

function get_user($userID){
    /** Récupère les informations d'un utilisateur
     *
     * @param int $userID un identifiant d'utilisateur
     *
     * @return array les information de l'utilisateur
     */
    $user = NULL;

    if(gettype($userID)=='integer') {
        if(user_exists($userID)) {
            //Sécurise $userID
            $userID = intval($userID);

            //Connexion à la BDD
            $link = open_database_connection();

            //Prepare la requête
            $query = mysqli_prepare($link, 'SELECT * FROM users WHERE userID = ?');
            mysqli_stmt_bind_param($query, 'i', $userID);

            //Execute la requête
            if (mysqli_stmt_execute($query)) {
                //Récupère le résultat
                $result = mysqli_stmt_get_result($query);

                //Stocke les données récupérées
                $usertmp = mysqli_fetch_array($result, MYSQLI_NUM);

                //Créé l'array à retourner
                $user = array(
                    "userID" => $usertmp[0],
                    "login" => $usertmp[1],
                    "nom" => $usertmp[3],
                    "prenom" => $usertmp[4],
                    "mail" => $usertmp[5],
                    "permissions" => $usertmp[6],
                    "date_inscription" => $usertmp[7],
                    "description" => $usertmp[8]
                );
            }
            //Ferme la connexion à la BDD
            close_database_connection($link);
        }
    }
    return $user;
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

    if(user_exists($userID)) {
        $link = open_database_connection();

        $userID = intval($userID);

        $model = htmlspecialchars($model);
        $model = str_replace(array('\n', '\r', PHP_EOL), ' ', $model);

        $vis = htmlspecialchars($vis);
        $vis = str_replace(array('\n', '\r', PHP_EOL), ' ', $vis);

        $descr = htmlspecialchars($descr);
        $descr = str_replace(array('\n', '\r', PHP_EOL), ' ', $descr);

        $loc = htmlspecialchars($loc);
        $loc = str_replace(array('\n', '\r', PHP_EOL), ' ', $loc);

        //Prepare la requête
        $query = mysqli_prepare($link, 'INSERT INTO stations(userID, model, visibility, description, localisation) VALUES (?, ?, ?, ?, ?)');
        mysqli_stmt_bind_param($query, 'issss', $userID, $model, $vis, $descr, $loc);

        //execute la requête
        mysqli_stmt_execute($query);

        close_database_connection($link);
    }
}

function update_station($stationID, $field, $value)
{
    /** Met à jour les données d'une station dans la BDD
     *
     * @param integer $stationID Un indentifiant de station
     * @param string $field un champ à modifier
     * @param string $value la valeur par laquelle remplacer ce champ
    */

    $link = open_database_connection();

    $stationID = intval($stationID);

    $field = htmlspecialchars($field);
    $field =  str_replace(array('\n','\r',PHP_EOL),' ',$field);

    $value = htmlspecialchars($value);
    $value =  str_replace(array('\n','\r',PHP_EOL),' ',$value);

    //Prepare la requête
    $query = mysqli_prepare($link,'UPDATE stations SET ? = ? WHERE stationID = ?');
    mysqli_stmt_bind_param($query, 'ssi', $field, $value, $stationID);

    //execute la requête
    mysqli_stmt_execute($query);

    close_database_connection($link);
}

function del_station($stationID)
{
    /** Supprime une station dans la BDD
     *
     * @param integer $stationID Un indentifiant de station
    */

    $link = open_database_connection();

    $stationID = intval($stationID);

    //Prepare la requête
    $query = mysqli_prepare($link,'DELETE FROM stations WHERE stationID = ?');
    mysqli_stmt_bind_param($query, 'i', $stationID);

    //execute la requête
    mysqli_stmt_execute($query);

    close_database_connection($link);
}

function get_all_stations($userID=0){
    /** Récupère les informations de toutes les stations
     *
     * @param integer $userID un identifiant d'utilisateur. 0 pour avoir toutes les stations
     *
     * @return array la liste des stations avec leurs informations
     */

    $userID = intval($userID);

    $link = open_database_connection();

    //Les stations publiques
    if($userID == 0) {
        $query = mysqli_prepare($link, 'SELECT * FROM stations WHERE visibility = "public"');
    }
    //Toutes les stations (admin)
    else if($userID == -1){
        $query = mysqli_prepare($link, 'SELECT * FROM stations');
        mysqli_stmt_bind_param($query, 'i', $userID);
    }
    //Les stations publiques et celles d'un utilisateur
    else {
        $query = mysqli_prepare($link, 'SELECT * FROM stations WHERE visibility = "public" OR userID = ?');
        mysqli_stmt_bind_param($query, 'i', $userID);
    }

    //Execute la requête
    if(mysqli_stmt_execute($query)) {
        //Récupère le résultat
        $query = mysqli_stmt_get_result($query);

        $stations = array();
        while($station = mysqli_fetch_array($query, MYSQLI_NUM)){
            $loc = explode(' ', $station[5]);
            $lat = floatval($loc[0]);
            $long = floatval($loc[1]);

            $stationtmp = array(
                "stationID" => $station[0],
                "userID" => $station[1],
                "model" => $station[2],
                "visibility" => $station[3],
                "description" => $station[4],
                "localisation" => $station[5],
                "coord" => array($lat,$long));
            $stations[] = $stationtmp;
        }
    }

    close_database_connection($link);

    return $stations;
}

function get_station($stationID){
    /** Récupère les informations d'une station
     *
     * @param int $stationID un identifiant de station
     *
     * @return array les information de la station
     */

    $stationID = intval($stationID);

    $link = open_database_connection();

    //Prepare la requête
    $query = mysqli_prepare($link,'SELECT * FROM stations WHERE stationID = ?');
    mysqli_stmt_bind_param($query, 'i', $stationID);

    //Execute la requête
    if(mysqli_stmt_execute($query)) {
        //Récupère le résultat
        $query = mysqli_stmt_get_result($query);

        $stationtmp = mysqli_fetch_array($query, MYSQLI_NUM);
        $station = array(
                "stationID" => $stationtmp[0],
                "userID" => $stationtmp[1],
                "model" => $stationtmp[2],
                "visibility" => $stationtmp[3],
                "description" => $stationtmp[4],
                "localisation" => $stationtmp[5]);
    }

    close_database_connection($link);

    return $station;
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

function del_mesure($date, $stationID)
{
    /** Supprime une station dans la BDD
     *
     * @param string $date un horodatage de mesure
     * @param int $stationID un identifiant de station
     */

    $link = open_database_connection();

    $stationID = intval($userID);

    $date = htmlspecialchars($date);
    $date =  str_replace(array('\n','\r',PHP_EOL),' ',$date);

    //Prepare la requête
    $query = mysqli_prepare($link,'DELETE FROM mesures WHERE stationID = ? and date = ?');
    mysqli_stmt_bind_param($query, 'is', $stationID, $date);

    //execute la requête
    mysqli_stmt_execute($query);

    close_database_connection($link);
}

//PROJETS
function new_project($name, $descr){
    /** Créé un nouveau projet
     *
     * @param string $name un nom de projet
     * @param string $descr la description du projet
     */

    $link = open_database_connection();

    $name = htmlspecialchars($name);
    $name =  str_replace(array('\n','\r',PHP_EOL),' ',$name);

    $descr = htmlspecialchars($descr);
    $descr =  str_replace(array('\n','\r',PHP_EOL),' ',$descr);

    //Prepare la requête
    $query = mysqli_prepare($link,'INSERT INTO projets(nom, description) VALUES (?, ?)');
    mysqli_stmt_bind_param($query, 'ss', $name, $descr);

    //execute la requête
    mysqli_stmt_execute($query);

    close_database_connection($link);
}

function add_user_to_project($userID, $projetID, $priv = NULL){
    /** Ajoute un utilisateur au projet
     *
     * @param integer $userID un identifiant d'utilisateur
     * @param integer $projetID un identifiiant de projet
     * @param string $priv un niveau de privilège
     */

    $link = open_database_connection();

    $userID = intval($userID);

    $projetID =  intval($projetID);

    //Prepare la requête
    $query = mysqli_prepare($link,'INSERT INTO user_projet(userID, projetID, privileges) VALUES (?, ?, ?)');
    mysqli_stmt_bind_param($query, 'iis', $userID, $projetID, $priv);

    //execute la requête
    mysqli_stmt_execute($query);

    close_database_connection($link);

}

function add_station_to_project($stationID, $projetID){
    /** Ajoute un utilisateur au projet
     *
     * @param integer $userID un identifiant d'utilisateur
     * @param integer $projetID un identifiiant de projet
     */

    $link = open_database_connection();

    $stationID = intval($stationID);

    $projetID =  intval($projetID);

    //Prepare la requête
    $query = mysqli_prepare($link,'INSERT INTO station_projet(stationID, projetID) VALUES (?, ?)');
    mysqli_stmt_bind_param($query, 'ii', $stationID, $projetID);

    //execute la requête
    mysqli_stmt_execute($query);

    close_database_connection($link);

}

function get_projet($projetID){
    /** Retourne toutes les informations d'un projet
     *
     * @param integer $projetID un identifiiant de projet
     *
     * @return array composé des infos du projet, des stations et utilisateurs le composant
     */

    //Connexion à la BDD
    $link = open_database_connection();

    $projetID =  intval($projetID);

    //Prepare la requête
    $query = mysqli_prepare($link, 'SELECT * FROM projets WHERE projetID=?');
    mysqli_stmt_bind_param($query, 'i', $projetID);


    //Execute la requête
    if(mysqli_stmt_execute($query)) {
        //Récupère le résultat
        $query = mysqli_stmt_get_result($query);
        $info = mysqli_fetch_array($query, MYSQLI_NUM);
        $projetInfo = array(
            "projetID" => $info[0],
            "nom" => $info[1],
            "description" => $info[2]
        );
    }

    //Prepare la requête
    $query = mysqli_prepare($link, 'SELECT stationID FROM station_projet WHERE projetID=?');
    mysqli_stmt_bind_param($query, 'i', $projetID);


    //Execute la requête
    if(mysqli_stmt_execute($query)) {
        //Récupère le résultat
        $query = mysqli_stmt_get_result($query);
        $stations = array();
        while($stationID = mysqli_fetch_array($query, MYSQLI_NUM)[0]){
            $stations[] = get_station($stationID);
        }
    }

    //Prepare la requête
    $query = mysqli_prepare($link, 'SELECT login FROM user_projet NATURAL JOIN users WHERE projetID=?');
    mysqli_stmt_bind_param($query, 'i', $projetID);

    //Execute la requête
    if(mysqli_stmt_execute($query)) {
        //Récupère le résultat
        $query = mysqli_stmt_get_result($query);
        $users = array();
        while($login = mysqli_fetch_array($query, MYSQLI_NUM)[0]){
            $users[] = get_user(get_userID($login));
        }
    }


    close_database_connection($link);
    return array(
        "infos" => $projetInfo,
        "stations" => $stations,
        "users" => $users
    );
}

function get_all_projet(){
    /** Retourne toutes les informations d'un projet
     *
     * @return array une liste de projets
     */

    //Connexion à la BDD
    $link = open_database_connection();

    //Prepare la requête
    $query = mysqli_prepare($link, 'SELECT * FROM projets');

    //Execute la requête
    if(mysqli_stmt_execute($query)) {
        //Récupère le résultat
        $query = mysqli_stmt_get_result($query);
        $projets = array();
        while($info = mysqli_fetch_row($query)) {
            $projet = array(
                "projetID" => $info[0],
                "nom" => $info[1],
                "description" => $info[2]
            );
            $projets[]=$projet;
        }
    }

    close_database_connection($link);
    return $projets;
}
?>