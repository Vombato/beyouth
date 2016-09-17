<html>
<head>
</head>
<body>
<?php
	$nomeCliente = $_POST['nome'];
	$numTavolo = $_POST['numTavolo'];
	$totalePrezzo = $_POST['check'];
	$prodotto1 = $_POST['prod1'];
	$prodotto2 = $_POST['prod2'];
	$prodotto3 = $_POST['prod3'];
	$prodotto4 = $_POST['prod4'];
	
	echo "<h3>Prodotti ordinati dal cliente ".$nomeCliente." al tavolo ".$numTavolo.":</h3>";
	

	// Stampo solo i prodotti le cui unità sono diverse da 0
	if($prodotto1>0){
		$price = $prodotto1 * 0.99;
		echo "Prodotto A - ".$prodotto1." unit&agrave; * 0.99&euro; = ".round($price, 2)."</br>";
	}
	if($prodotto2>0){
		$price = $prodotto2 * 1.5;
		echo "Prodotto B - ".$prodotto2." unit&agrave; * 1.50&euro; = ".round($price, 2)."</br>";
	}
	if($prodotto3>0){
		$price = $prodotto3 * 3.05;
		echo "Prodotto C - ".$prodotto3." unit&agrave; * 3.05&euro; = ".round($price, 2)."</br>";
	}
	if($prodotto4>0){
		$price = $prodotto4 * 2;
		echo "Prodotto D - ".$prodotto4." unit&agrave; * 2.00&euro; = ".round($price, 2)."</br>";
	}
	// Spesa totale
	echo "Spesa totale: ".$totalePrezzo."&euro;";
?>
</body>
</html>