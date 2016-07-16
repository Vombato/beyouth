<html>

	<head>
		<title>Main Page</title>
	</head>

	<body>
		
		<form action="Ordinazione.php" method="POST">
		
		Nome cliente: <input type="text" name="nome"> </br></br>
		Numero tavolo: <input type="text" name="numTavolo">
		
		<h1>Prodotto 1
		
			<input type=button value='-' onclick='javascript:processA(-1)'>
			<input type=test size=5 id='value1' name='prod1' value='0'>
			<input type=button value='+' onclick='javascript:processA(1)'>
		
			<script language=javascript>
			function processA(plusMinusOne){
				var value = parseInt(document.getElementById('value1').value); // Il .value prende il valore contenuto nella textfield con id specificato
				value = value + plusMinusOne; // Incremento o decremento
				
				if(value >= 0) {
					document.getElementById('value1').value = value; // Setto la textfield al valore specificato
				}
			}
			</script>
			
		</h1>
		
		
		<h1>Prodotto 2
		
			<input type=button value='-' onclick='javascript:processB(-1)'>
			<input type=test size=5 id='value2' name='prod2' value='0'>
			<input type=button value='+' onclick='javascript:processB(1)'>
		
			<script language=javascript>
			function processB(plusMinusOne){
				var value = parseInt(document.getElementById('value2').value); // Il .value prende il valore contenuto nella textfield con id specificato
				value = value + plusMinusOne; // Incremento o decremento
				
				if(value >= 0) {
					document.getElementById('value2').value = value; // Setto la textfield al valore specificato
				}
			}
			</script>
		
		</h1>
		
		
		<h1>Prodotto 3
		
			<input type=button value='-' onclick='javascript:processC(-1)'>
			<input type=test size=5 id='value3' name='prod3' value='0'>
			<input type=button value='+' onclick='javascript:processC(1)'>
		
			<script language=javascript>
			function processC(plusMinusOne){
				var value = parseInt(document.getElementById('value3').value); // Il .value prende il valore contenuto nella textfield con id specificato
				value = value + plusMinusOne; // Incremento o decremento
				
				if(value >= 0) {
					document.getElementById('value3').value = value; // Setto la textfield al valore specificato
				}
			}
			</script>
		
		</h1>
		
		
		<h1>Prodotto 4
		
			<input type=button value='-' onclick='javascript:processD(-1)'>
			<input type=test size=5 id='value4' name='prod4' value='0'>
			<input type=button value='+' onclick='javascript:processD(1)'>
		
			<script language=javascript>
			function processD(plusMinusOne){
				var value = parseInt(document.getElementById('value4').value); // Il .value prende il valore contenuto nella textfield con id specificato
				value = value + plusMinusOne; // Incremento o decremento
				
				if(value >= 0) {
					document.getElementById('value4').value = value; // Setto la textfield al valore specificato
				}
			}
			</script>
		
		</h1>
		
			<input type="submit" value="ORDINA">
		</form>
		
	</body>

</html>
