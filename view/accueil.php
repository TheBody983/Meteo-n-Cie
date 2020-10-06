<?php $title= 'Accueil'; ?>
<?php ob_start(); ?>

    <div class="mapborder">
        <div id="mapid" ></div><footer class="container">
            <div id="avertissement">AVERTISSEMENT</div>
            <div id="textavertissement"><marquee behavior="scroll">Bonne journée</marquee></div>
        </footer>
    </div>

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
        if($station["coord"][0]!=NULL) {
            echo 'var coordinates = [];';
            echo 'coordinates[0] = parseFloat(' . $station["coord"][0] . ');';
            echo 'coordinates[1] = parseFloat(' . $station["coord"][1] . '); ';
            echo 'var marker = L.marker(coordinates).addTo(mymap);marker.bindPopup("<b>' . $station["description"] . '</b><br><a href=\'\'>Cliquez pour plus d\'infos</a>");';
        }
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
