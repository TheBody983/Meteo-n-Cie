<?php
require_once '../model.php';

$q = $_GET['q'];

$mesures = get_mesures($q);
?>
<table>
<tr>
  <th>Date de la Mesure</th>
  <th>Station</th>
  <th>Valeur</th>
</tr>
<?php
foreach($mesures as $mesure) {
    echo "<tr>";
    echo "<td>" . $mesure['date'] . "</td>";
    echo "<td>" . $mesure['stationID'] . "</td>";
    echo "<td>" . $mesure['value'] . "</td>";
    echo "</tr>";
}
echo "</table>";
?>