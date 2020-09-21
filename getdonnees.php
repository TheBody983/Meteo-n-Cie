<?php
$q = $_GET['q'];

$con = mysqli_connect('localhost','model','1234','meteo_n_cie');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT * FROM mesures WHERE mesure_name = '".$q."'";
$result = mysqli_query($con,$sql);
?>

<tr>
  <td>Date de la Mesure</td>
  <td>Station</td>
  <td>Valeur</td>
</tr>
<?php
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td>" . $row['stationID'] . "</td>";
    echo "<td>" . $row['mesure_name'] . "</td>";
    echo "<td>" . $row['mesure_value'] . "</td>";
    echo "</tr>";
}
mysqli_close($con);
?>