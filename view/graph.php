<?php $title= 'Graphes'; ?>

<?php ob_start();?>

<body>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <canvas id="myChart" class="box" width="1000" height="400"></canvas>
	<!--
    <div class="containerCol">
		<label for="searchbar">Mesures recherchées</label>
		<input type="text" id="searchbar" name="searchbar" placeholder="Veuillez entrer un terme" onkeyup="showHint(this.value)">
	</div>
	
    <p>Mesures existantes : <span id="hint"></span></p>
    <div id="table" class="containerCol"></div>
        <div>
            <label for="line">Graphique en ligne:</label>
            <input type="radio" name="choix" value="line" ></input>
            <br>
            <label for="bar">Graphique en bâton:</label>
            <input type="radio" name="choix" value="bar" checked></input>
            <br>
            <button id="typegraph" >Mettre à jour le graphique</button>
        </div>
        <div id="le_div">
            <label for="backcolor">Couleur de fond</label>
            <input type="color" id="backcolor">
        </div>-->
</body>
<script>
    /*function showHint(str) {
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
    let val=document.getElementById("hint").value
    //mesures=get_mesures(val)
	let boutonRadio = document.querySelector('input[name="choix"]:checked').value;
	if (boutonRadio=="bar") 
		{var type = "bar"} 
	if (boutonRadio=="line") 
		{var type = "line"}*/
	var type = "line";
	
    var ctx = document.getElementById("myChart");
    var data={
        labels: [<?php
					$j=count($mesures);
					echo '"';
					for($i=1;$i<$j;$i++){
						echo $mesures[$i-1]['stationID'].'","';
						}
					echo end($mesures)['stationID'].'"';
					?>],
        datasets: [{ 
            data: [<?php 
						foreach($mesures as $mesure){
							echo $mesure["value"].",";
							}
						echo '0'; 
					?>],
				backgroundColor: "cyan"
        }]
    }
    var options={
        responsive : false
    }
    var config={
        type: type,
        data:data,
        options:options
    }
    let myChart = new Chart(ctx, config);
	
	/*let bouton1 = document.getElementById('typegraph');
	bouton1.addEventListener('click',function(evt){
		body.removeChild(canvas);
		boutonRadio = document.querySelector('input[name="choix"]:checked').value;
		if (boutonRadio=="bar")
			{type = "bar"} 
		if (boutonRadio=="line") 
			{type = "line"}
		config={
			type: type,
			data:data,
			options:options
			}
		canvas = document.createElement("canvas");
		canvas.setAttribute("id","myChart");
		canvas.setAttribute("width","800");
		canvas.setAttribute("height","400");
		body.insertBefore(canvas,canvas.previousSibling);
		ctx = document.getElementById("myChart");
		let boutonRadio = document.querySelector('input[name="choix"]:checked').value;
		if (boutonRadio=="bar") 
			{type = "bar"} 
		if (boutonRadio=="line") 
			{type = "line"}
		
		ctx = document.getElementById("myChart");
		data={
			labels: ['mesures1','mesures2'],
			datasets: [{ 
				data: [<?php 
							foreach($mesures as $mesure){
								echo $mesure["value"].",";
								}
							echo '0'; 
						?>]
			}]
		}
		options={
			responsive : false
		}
		config={
			type: type,
			data:data,
			options:options
		}
		myChart = new Chart(ctx, config);
			});*/
	
</script>
<?php $content = ob_get_clean(); ?>
<?php include 'layout.php'; ?>
