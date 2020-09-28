<?php $title= 'Accueil'; ?>
<?php ob_start(); ?>
<!--<head>
	<title>Meteo'N'Cie</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../graphs/meteoncie.ico" />
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
	<link rel="stylesheet" href="../index.css"/>
	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
</head>-->
<div class="container">
	<div id="menu" class="containerCol">
        <img id='titremenu' src="../graphs/menu.png"/>
        <?php
        if(!isset($_SESSION['login']))
        echo '<button id="connexion" onclick="window.location.href = "login";">Se connecter/ S\'inscrire</button>';
        ?>
		<p><a id="rubrique" href="">Liste des stations</a></p>
		<!-- Envoie à la page souhaitée si connecté, sinon renvoit à la page de login -->
			<p><a id="rubrique" href="gestionStation">Gestion des stations</a></p>
			<p><a id="rubrique" href="">Messagerie</a></p>
			<p><a id="rubrique" href="">Projet</a></p>
			<p><a id="rubrique" href="donnees">Données</a></p>
			<p><a id="rubrique" href="test">Tests</a></p>
	</div>


	<div id="mapid" ></div>
</div>
	<footer>
    </footer>
    <script>

        var mymap = L.map('mapid').setView([-21, -194.55], 8);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(mymap);

        var marker = L.marker([-20.916709, -192.734699]).addTo(mymap);
        marker.bindPopup("<b>Wé, Lifou</b><br><a href=''>Cliquez pour plus d'infos</a>");

        var marker = L.marker([-22.297812, -193.561785]).addTo(mymap);
        marker.bindPopup("<b>Baie des Citrons, Nouméa</b><br><a href=''>Cliquez pour plus d'infos</a>");

        var marker = L.marker([-21.607084, -194.545169]).addTo(mymap);
        marker.bindPopup("<b>Baie des Tortues, Bourail</b><br><a href=''>Cliquez pour plus d'infos</a>");

        var popup = L.popup()
        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("Vous avez cliqué à " + e.latlng.toString())
                .openOn(mymap);
        }

        mymap.on('click', onMapClick );

    </script>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
