<?php $title= 'Donnees'; ?>
<?php ob_start();
//temporaire, le temps d'avoir l'accès depuis index
require_once '../model.php';
if(!isset($mesures)) {
    $mesures = get_mesures('temperature');
}
?>
<table>
<tr>
  <td>Date de la Mesure</td>
  <td>Station</td>
  <td>Valeur</td>
</tr>
<?php
foreach( $mesures as $mesure){
    echo '<tr><td>'.$mesure["date"].'</td>';
    echo '<td>'.$mesure["stationID"].'</td>';
    echo '<td>'.$mesure["value"].'</td></tr>';
}?>
</table>
<?php
$content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>