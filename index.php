<html>

	<head>
		<title>Main Page</title>
	</head>

	<body>
		
		<form action="Ordinazione.php" method="POST">
		
		Nome cliente: <input type="text" name="nome"> </br></br>
		Numero tavolo: <input type="text" name="numTavolo">
		
		<h3>Totale spesa: 
			<input type=text size=5 id='totPrezzo' name='check' value='0'>
		</h3>
		
		<h1>Prodotto 1 (0.99E)
		
			<input type=button value='-' onclick='processA(-1);check(-5);'>
			<input type=test size=5 id='value1' name='prod1' value='0'>
			<input type=button value='+' onclick='processA(1);check(5)'>
		
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
			
		</h1>
		
		
		<h1>Prodotto 2 (1.50E)
		
			<input type=button value='-' onclick='javascript:processB(-1)'>
			<input type=test size=5 id='value2' name='prod2' value='0'>
			<input type=button value='+' onclick='javascript:processB(1)'>
		
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
		
		</h1>
		
		
		<h1>Prodotto 3 (3.05E)
		
			<input type=button value='-' onclick='javascript:processC(-1)'>
			<input type=test size=5 id='value3' name='prod3' value='0'>
			<input type=button value='+' onclick='javascript:processC(1)'>
		
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
		
		</h1>
		
		
		<h1>Prodotto 4 (2.00E)
		
			<input type=button value='-' onclick='javascript:processD(-1)'>
			<input type=test size=5 id='value4' name='prod4' value='0'>
			<input type=button value='+' onclick='javascript:processD(1)'>
		
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
		
		</h1>
		
			<input type="submit" value="ORDINA">
		</form>
		
	</body>

</html>
