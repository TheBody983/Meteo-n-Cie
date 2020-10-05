<?php $title= 'Donnees'; ?>
<?php ob_start();
echo '<div class="containerCol">';

?>

    <div class="containerCol">
        <label for="searchbar">Mesures recherchées</label>
        <input type="text" id="searchbar" name="searchbar" placeholder="Veuillez entrer un terme" onkeyup="showHint(this.value)">
    </div>

    <p>Mesures existantes : <span id="hint"></span></p>
    <div id="table" class="containerCol">
    </div>

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
        xmlhttp.open("GET", "../ajax/getmesures.php?q=" + str, true);
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
    xmlhttp.open("GET","../ajax/getdonnees.php?q="+str,true);
    xmlhttp.send();
}
</script>

<?php echo '</div>'; ?>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>