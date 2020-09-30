<?php
require_once '../model.php';

$id = $_GET['id'];
$textcontent = $_GET['textcontent'];
$stationID = $_GET['stationID'];

$link = open_database_connection();

//Prepare la requête
$query = mysqli_prepare($link,'UPDATE stations SET '.$id.' = ? WHERE stationID = ?');
echo mysqli_error($link);
mysqli_stmt_bind_param($query, 'ss',  $textcontent,$stationID);

mysqli_stmt_execute($query);

echo $textcontent;

mysqli_close($link);
?>