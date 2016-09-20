<?php

    include_once('classes/ManageProducts.php'); 
	$product = new ManageProducts();

    $products = $product->getProducts();

    if(isset($_POST['name'])) {
        $costumer = $_POST['name'];
    }

	if(isset($_POST['tableNum'])) {
        $tableNum = $_POST['tableNum'];
    }

    for($i=0; $i<count($products); $i++) {
        $name = $products[$i]["short_name"];
        $quantity[$i] = $_POST[$name]; // Array con le quantità per ogni prodotto scelte dall'utente, in ordine come sono inserite nel DB
    }
	
    $totalCheck = 0;
?>

<html>

    <head>
        <title>Resoconto</title>
    </head>
    
    <body>
    
<?php
	echo "<h3>Prodotti ordinati dal cliente ".$costumer." al tavolo ".$tableNum.":</h3>";
	
	// Stampo il resoconto prodotti
    for($j=0; $j<count($products); $j++) {
        printProduct($products[$j]["name"], $quantity[$j], $products[$j]["price"]);
    }
	
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
        
    <form action="ordination.php" method="post">
        
        <input type='hidden' name='costumerName' value='<?php echo $costumer; ?>'>
        <input type='hidden' name='costumerTable' value='<?php echo $tableNum; ?>'>
        
        <?php 
            for($k=0; $k<count($products); $k++) {
                echo "<input type='hidden' name='".$products[$k]["short_name"]."' value='".$quantity[$k]."'>"; // Passo tramite form le quantità dei prodotti associate al loro short_name
            }
        ?>
        
        <input type='hidden' name='totalCheck' value='<?php echo $totalCheck; ?>'>
        <input type='submit' name='sendOrder' value='ORDINA'>
    </form>
        
</body>
    
</html>