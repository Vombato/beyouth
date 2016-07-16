<?php

	$nomeCliente = $_POST['nome'];
	$numTavolo = $_POST['numTavolo'];

	$prodotto1 = $_POST['prod1'];
	$prodotto2 = $_POST['prod2'];
	$prodotto3 = $_POST['prod3'];
	$prodotto4 = $_POST['prod4'];
	
	echo "<h3>Prodotti ordinati dal cliente ".$nomeCliente." al tavolo ".$numTavolo.":</h3>";
	
	// Stampo solo i prodotti le cui unità sono diverse da 0
	if($prodotto1>0){
		echo "Prodotto A - ".$prodotto1." unit&agrave; </br>";
	}
	if($prodotto2>0){
		echo "Prodotto B - ".$prodotto2." unit&agrave; </br>";
	}
	if($prodotto3>0){
		echo "Prodotto C - ".$prodotto3." unit&agrave; </br>";
	}
	if($prodotto4>0){
		echo "Prodotto D - ".$prodotto4." unit&agrave; </br>";
	}

?>
