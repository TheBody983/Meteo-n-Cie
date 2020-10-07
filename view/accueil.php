<?php $title= 'Accueil'; ?>
<?php ob_start(); ?>
<head>
	<title>Meteo'N'Cie</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../graphs/meteoncie.ico" />
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
	<link rel="stylesheet" href="../index.css"/>
	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
</head>
<body style="background-image: url('../graphs/fondcarte.png');">
<div class="container">
    <article id="menu" class="containerCol">
        <img id='titremenu' src="../graphs/menu.png"/>
        <?php
        if(!isset($_SESSION['login']))
            echo '<button id="connexion" onclick="window.location.href = \'login\'">Se connecter/ S\'inscrire</button>';
        ?>
        <div class="list">
            <ul>
                <li><span><a href="listeStation">Liste des stations</a></span></li>
                <li><span><a href="gestionStation">Gestion des stations</a></span></li>
                <li><span><a href="">Messagerie</a></span></li>
                <li><span><a href="gestionProjet">Projets</a></span></li>
                <li><span><a href="donnees">Données</a></span></li>
                <?php
                        if (isset($_SESSION['login'])){
                            echo '<li><span><a id="rubrique" href="admin">Administration</a></span></li></div>';
                        }
                        ?>
            </ul>
        </div>
    </article>
	<div id="mapid" ></div>
</div>
</body>
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

		<?php foreach($stations as $station){
			echo 'var coordinates = [];';
			echo 'coordinates[0] = parseFloat('.$station["coord"][0].');'; 
			echo 'coordinates[1] = parseFloat('.$station["coord"][1].'); ';
            echo 'var marker = L.marker(coordinates).addTo(mymap);marker.bindPopup("<b>'.$station["description"].'</b><br><a href=\'\'>Cliquez pour plus d\'infos</a>");';
        }?>

        var popup = L.popup()
        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("Coordonnées: " + e.latlng.toString())
                .openOn(mymap);
        }

        mymap.on('click', onMapClick );

    </script>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
