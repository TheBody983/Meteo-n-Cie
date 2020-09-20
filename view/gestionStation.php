<?php $title= 'Gestion des Stations'; ?>
<?php ob_start(); ?>

<div id="idGestionStation">
    <div id="divAddStation"><input type="button" id="boutonAddStation" value="Ajouter une station"></div>
    <div id="divDelStation"><input type="button" id="boutonDelStation" value="Retirer une station"></div>
    <div id="divEditStation"><input type="button" id="boutonEditStation" value="Editer une station"></div>
</div>

<script>
    let body = document.querySelector("body");
    let divGestion=document.querySelector("#idGestionStation");

    boutonAddStation = document.querySelector("#boutonAddStation");
    boutonAddStation.addEventListener('click',function(evt){
        let divAddStation=document.createElement("div");
        divAddStation.setAttribute("id","idAddStation");
        divAddStation.innerHTML='<form action="/Meteo-n-Cie/index.php/addStation"><label>Nom : <input type="text" name="nomStation" id="nomStation"></label><label>Coordonées : <input type="text" name="coordonneesStation" id="coordonneesStation"></label><label>Description : <input type="textarea" name="descriptionStation" id="descriptionStation" placeholder="(facultatif)"></label></form>';
        divGestion.appendChild(divAddStation);
    })

    boutonDelStation = document.querySelector("#boutonDelStation");
    boutonDelStation.addEventListener('click',function(evt) {
        let divDelStation=document.createElement("div");
        divDelStation.setAttribute("id","idDelStation");
        //divDelStation.innerHTML='<ul><?php //foreach( $stations as $station ) : ?><li><p><?php //echo $station["nom"];?><button id="boutonX">x</button></p></li><?php //endforeach ?></ul>';

        boutonX = document.querySelector("#boutonX");
        boutonX.addEventListener('click',function(evt){
            divDelStation.removeChild(boutonX);
        })
    })

    boutonEditStation = document.querySelector("#boutonEditStation");
    boutonEditStation.addEventListener('click',function(evt){
        let divEditStation=document.createElement("div");
        divEditStation.setAttribute("id","idEditStation");
        //divEditStation.innerHtml='<ul><?php //foreach( $stations as $station ) : ?><li><p><?php //echo $station["nom"];?></p></li><?php //endforeach ?></ul>';
    })
</script>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
