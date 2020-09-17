<?php $title= 'Gestion des Stations'; ?>
<?php ob_start(); ?>
<div id="idGestionStation">
    <input type="button" id="boutonAddStation">Ajouter une station</input>
    <input type="button" id="boutonDelStation">Retirer une station</input>
    <input type="button" id="boutonEditStation">Editer une station</input>
</div>
<div id="idAddStation">
    <form action="/Meteo-n-Cie/index.php/addStation">
        <label>Nom : <input type="text" name="nomStation" id="nomStation"></label>
        <label>Coordonées : <input type="text" name="coordonneesStation" id="coordonneesStation"></label>
        <label>Description : <input type="textarea" name="descriptionStation" id="descriptionStation" placeholder="(facultatif)"></label>
    </form>
</div>
<div id="idDelStation">
    <form action="/Meteo-n-Cie/index.php/DelStation">

    </form>
</div>
<div id="idEditStation">
    <form action="/Meteo-n-Cie/index.php/EditStation">

    </form>
</div>
<script>
    let body = document.querySelector("body");
    boutonAddStation = document.querySelector("#boutonAddStation");
    boutonAddStation.addEventListener('click',function(evt){

    }
    boutonDelStation = document.querySelector("#boutonDelStation");
    boutonDelStation.addEventListener('click',function(evt) {

    }
    boutonEditStation = document.querySelector("#boutonEditStation");
    boutonEditStation.addEventListener('click',function(evt){

    }
</script>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
