<?php

    include_once('classes/ManageProducts.php'); 
	$product = new ManageProducts();

    $piadina = $product->getProductInfo('Piadina al salame');
    $cocacola = $product->getProductInfo('Coca Cola');
    $patatine = $product->getProductInfo('Patate Fritte');
    $insalata = $product->getProductInfo('Insalata');

    // COntrolli che i campi siano string e int
    $error = "";

    if(isset($_POST['name']) && !empty($_POST['name']) && !ctype_digit($_POST['name'])) {
        $costumer = $_POST['name'];
    } else {
       $error = $error."Errore nome cliente <br/>"; 
    }

	if(isset($_POST['tableNum']) && !empty($_POST['tableNum']) && ctype_digit($_POST['tableNum'])) {
        $tableNum = $_POST['tableNum'];
    } else {
        $error = $error."Errore campo tavolo"; 
    }

    if($error != "") { // Se è stato settato qualche errore ritorno all'index
        header('Location: index.php?error='.$error);
    }

    // Quantità per ogni prodotto
	$piadinaQ = $_POST['piadina'];
	$cocacolaQ = $_POST['cocacola'];
	$patatineQ = $_POST['patatine'];
	$insalataQ = $_POST['insalata'];
	
    $totalCheck = 0;
?>

<html>

    <head>
    
    </head>
    
    <body>
    
<?php
	echo "<h3>Prodotti ordinati dal cliente ".$costumer." al tavolo ".$tableNum.":</h3>";
	
	// Stampo i prodotti
	printProduct($piadina[0]["name"], $piadinaQ, $piadina[0]["price"]);
    printProduct($cocacola[0]["name"], $cocacolaQ, $cocacola[0]["price"]);
    printProduct($patatine[0]["name"], $patatineQ, $patatine[0]["price"]);
    printProduct($insalata[0]["name"], $insalataQ, $insalata[0]["price"]);
	
	// Spesa totale
	echo "<h3>Spesa totale: ".$totalCheck."&euro;</h3>";

    function printProduct($prodName, $prodQuantity, $prodPrice) {
        if($prodQuantity > 0) {
            $totProd = $prodQuantity * $prodPrice;
            echo $prodQuantity." ".$prodName." - ".round($totProd, 2)."&euro; totale</br>";
            
            // Faccio anche la somma totale
            global $totalCheck;
            $totalCheck = $totalCheck + $totProd;
        }
    }


?>
        
    <form action="Ordinazione.php" method="post">
        <input type='hidden' name='costumerName' value='<?php echo $costumer; ?>'>
        <input type='hidden' name='costumerTable' value='<?php echo $tableNum; ?>'>
        <input type='hidden' name='piadina' value='<?php echo $piadinaQ; ?>'>
        <input type='hidden' name='cocacola' value='<?php echo $cocacolaQ; ?>'>
        <input type='hidden' name='patatine' value='<?php echo $patatineQ; ?>'>
        <input type='hidden' name='insalata' value='<?php echo $insalataQ; ?>'>
        <input type='hidden' name='totalCheck' value='<?php echo $totalCheck; ?>'>
        <input type='submit' name='sendOrder' value='ORDINA'>
    </form>
        
</body>
    
</html>