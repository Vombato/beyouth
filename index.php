<?php
    include_once('classes/ManageProducts.php');
	$product = new ManageProducts();

    $products = $product->getProducts();
    //$product->registerProduct("Piadina al Prosciutto", "piadinaB", 1.3, "Piadine", "1");
?>
<html>

	<head>
		<title>Main Page</title>
        <script src="js/Script.js"></script>
	</head>

	<body onload="checkAmount();">
		<center>
		<form action="report.php" method="POST" onsubmit="return checkValuesType(document.getElementById('name').value, document.getElementById('tableNum').value);">

            Nome cliente: <input type="text" name="name" id="name">
            <p id="errorName" style="color:red; font-size: 15px;"></p>
            Numero tavolo: <input type="text" name="tableNum" id="tableNum">
            <p id="errorTable" style="color:red; font-size: 15px;"></p>

            <?php
            // Stampo tutti i prodotti disponibili

                for($i=0; $i<count($products); $i++) {
                    echo "<h1>".$products[$i]['name']." prezzo: ".$products[$i]['price']."&euro;";

                    echo "<input type=button value='-' onclick=\"process(-1, '".$products[$i]['short_name']."', ".$products[$i]['price'].")\">";
                    echo "<input type=test size=5 id='".$products[$i]['short_name']."' name='".$products[$i]['short_name']."' value='0'>";
                    echo "<input type=button value='+' onclick=\"process(1, '".$products[$i]['short_name']."', ".$products[$i]['price'].")\">";

                    echo "</h1>";
                }

            ?>

            <h3>Totale: <input type="text" name="totCheck" id="totCheck" value="0" readonly></h3>

			<input type="submit" id="checkAll" name="checkAll" value="RESOCONTO">
		</form>
		</center>
	</body>

</html>
