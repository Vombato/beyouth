<html>


	<head>
		<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> <!--font-->
		
		<link type="text/css" rel="stylesheet" href="./css.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		
		<script type="text/javascript"> 
			function scroll_to(div){
				$('html, body').animate({scrollTop: $(div).offset().top},2000);
			}
		</script>
		
		<title>Main Page</title>
		
	</head>

	<body>
	<div style="height:100vh;">
	<img style="width:100%;" src="./beyouth.png"/>
	
	<br/><br/><br/><br/><br/><br/>
	
	<button style="text-align:center; font-size:50; margin-left:35vw;"> <a onClick="scroll_to('#menu');return false;" href="#menu" style="text-decoration:none; color:black;"> Vai al Menu'</a> </button>
	
	</div>
	
	
	
	<div style="width:91vw; margin-left:2vw; height:100vh;" id="menu">		
		<form action="Ordinazione.php" method="POST">
		
		<div id="ordina" class="ordinare" >
		
		<fieldset>
		<legend><font> M E N U'</font></legend>
		
		<div style="float:left; margin-right:0vw; margin-top:3vh; font-size:30; font-weight:bold;">
			Nome cliente:&nbsp <input style="font-size:20; width:13vw;" type="text" name="nome"> 
		</div>
		
		<div style="float:left; font-size:35; margin-top:3vh; font-weight:bold;">
			 &nbsp &nbsp Numero tavolo:&nbsp <input style="font-size:20; width:13vw;" type="text" name="numTavolo">
		</div>
		
		<br/>
		<br/>
		<br/>
		<br/>
		
		
		
		<h3>Prodotto 1 (0.99E)
		<div id="opera">
			<input class="bott" type=button value='-' onclick='processA(-1);check(-5);'>
			<input class="prod" type=test size=5 id='value1' name='prod1' value='0'>
			<input class="bott" type=button value='+' onclick='processA(1);check(5)'>
		
			<script language=javascript>
			function processA(plusMinusOne){
				var value = parseInt(document.getElementById('value1').value); // Il .value prende il valore contenuto nella textfield con id specificato
				value = value + plusMinusOne; // Incremento o decremento
				
				if(value >= 0) {
					var newPrice = parseFloat(document.getElementById('totPrezzo').value) + plusMinusOne*0.99; // Arrotondo a due decimali
					document.getElementById('totPrezzo').value = Math.round(newPrice * 100) / 100; // Aumento il costo totale
					document.getElementById('value1').value = value; // Setto la textfield al valore specificato
				}
			}
			</script>
		</div>	
		</h3>
		
		
		<h3>Prodotto 2 (1.50E)
		<div id="opera">
			<input class="bott" type=button value='-' onclick='javascript:processB(-1)'>
			<input class="prod" type=test size=5 id='value2' name='prod2' value='0'>
			<input class="bott" type=button value='+' onclick='javascript:processB(1)'>
		
			<script language=javascript>
			function processB(plusMinusOne){
				var value = parseInt(document.getElementById('value2').value); // Il .value prende il valore contenuto nella textfield con id specificato
				value = value + plusMinusOne; // Incremento o decremento
				
				if(value >= 0) {
					var newPrice = parseFloat(document.getElementById('totPrezzo').value) + plusMinusOne*1.5; // Arrotondo a due decimali
					document.getElementById('totPrezzo').value = Math.round(newPrice * 100) / 100; // Aumento il costo totale
					document.getElementById('value2').value = value; // Setto la textfield al valore specificato
				}
			}
			</script>
		
		</h3>
		
		
		<h3>Prodotto 3 (3.05E)
		<div id="opera">
			<input class="bott" type=button value='-' onclick='javascript:processC(-1)'>
			<input class="prod" type=test size=5 id='value3' name='prod3' value='0'>
			<input class="bott" type=button value='+' onclick='javascript:processC(1)'>
		
			<script language=javascript>
			function processC(plusMinusOne){
				var value = parseInt(document.getElementById('value3').value); // Il .value prende il valore contenuto nella textfield con id specificato
				value = value + plusMinusOne; // Incremento o decremento
				
				if(value >= 0) {
					var newPrice = parseFloat(document.getElementById('totPrezzo').value) + plusMinusOne*3.05; // Arrotondo a due decimali
					document.getElementById('totPrezzo').value = Math.round(newPrice * 100) / 100; // Aumento il costo totale
					document.getElementById('value3').value = value; // Setto la textfield al valore specificato
				}
			}
			</script>
		</div>
		</h3>
		
		
		<h3>Prodotto 4 (2.00E)
		<div id="opera">
			<input class="bott" type=button value='-' onclick='javascript:processD(-1)'>
			<input class="prod" type=test size=5 id='value4' name='prod4' value='0'>
			<input class="bott" type=button value='+' onclick='javascript:processD(1)'>
		
			<script language=javascript>
			function processD(plusMinusOne){
				var value = parseInt(document.getElementById('value4').value); // Il .value prende il valore contenuto nella textfield con id specificato
				value = value + plusMinusOne; // Incremento o decremento
				
				if(value >= 0) {
					var newPrice = parseFloat(document.getElementById('totPrezzo').value) + plusMinusOne*2; // Arrotondo a due decimali
					document.getElementById('totPrezzo').value = Math.round(newPrice * 100) / 100; // Aumento il costo totale
					document.getElementById('value4').value = value; // Setto la textfield al valore specificato
				}
			}
			</script>
		</div>
		</h3>
		
		<div style="font-size:45; font-weight:bold; margin-top:5vh; float:right;">Totale spesa: 
			<input class="botto" type=text size=5 id='totPrezzo' name='check' value='0'>
		</div>
			<input style=" margin-top:10vh; font-size:40;" type="submit" value="ORDINA">
		</fieldset>
		</form>
		</div>
		</div>
		
		
	</body>

</html>