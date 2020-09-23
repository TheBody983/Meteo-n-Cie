<?php
$q = $_GET['q'];

$con = mysqli_connect('localhost','model','1234','meteo_n_cie');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT * FROM mesures WHERE mesure_name = '".$q."'";
$result = mysqli_query($con,$sql);
?>
<table>
<tr>
  <th>Date de la Mesure</th>
  <th>Station</th>
  <th>Valeur</th>
</tr>
<?php
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td>" . $row['stationID'] . "</td>";
    echo "<td>" . $row['mesure_value'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>