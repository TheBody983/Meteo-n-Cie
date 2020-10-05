<?php
require_once '../model.php';

$id = $_GET['id'];
$textcontent = $_GET['textcontent'];
$stationID = intval($_GET['stationID']);

update_station($stationID, $id, $textcontent);
?>