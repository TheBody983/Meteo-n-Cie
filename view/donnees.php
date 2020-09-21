<?php $title= 'Donnees'; ?>
<?php ob_start();
//temporaire, le temps d'avoir l'accès depuis index
require_once '../model.php';
$stations = get_all_stations(1);
?>
<script>
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("hint").innerHTML = "";
        return;
    }
    else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("hint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../ajaxtest.php?q=" + str, true);
        xmlhttp.send();
    }
}

function search(str){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("table").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET","../getdonnees.php?q="+str,true);
    xmlhttp.send();
}
</script>

<form action="">
    <input type="text" id="searchbar" name="searchbar" onkeyup="showHint(this.value)">
</form>
<p>Suggestions: <span id="hint"></span></p>
<table id="table">
</table>

<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>