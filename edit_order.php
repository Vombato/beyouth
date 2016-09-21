<?php

    include_once('classes/ManageOrders.php');
    include_once('classes/ManageProducts.php');
	$order = new ManageOrders();
	$product = new ManageProducts();

    $products = $product->getProducts();
    $orders = $order->getOrders();

    $orderID = $_GET["id"]; // ID dell'ordine da modificare, questo serve a comporre il nome delle variabili: nome_cliente, tavolo_cliente e totale, che altrimenti non avrebbero un nome univoco per ogni ordine

    if(isset($_POST['costumerName'.$orderID])) {
        $costumerName = $_POST['costumerName'.$orderID];
    }
    if(isset($_POST['costumerTable'.$orderID])) {
        $costumerTable = $_POST['costumerTable'.$orderID];
    }

    for($i=0; $i<count($products); $i++) {
        $name = $products[$i]["short_name"]; // Dato che il nome degli elementi è lo short_name
        $quantity[$i] = $_POST[$name]; // Array con le quantità per ogni prodotto scelte dall'utente, in ordine come sono inserite nel DB
    }

    if(isset($_POST['totalCheck'.$orderID])) {
        $totalCheck = $_POST['totalCheck'.$orderID];
    }


?>
<html>

	<head>
		<title>Main Page</title>
        <script src="js/Script.js"></script>
	</head>

	<body onload="checkAmount();">
		<center>
		<form action="update_order.php?id=<?php echo $orderID; ?>" method="POST" onsubmit="return checkValuesType(document.getElementById('name').value, document.getElementById('tableNum').value);">

            Nome cliente: <input type="text" name="costumerName" id="name" value="<?php echo $costumerName; ?>">
            <p id="errorName" style="color:red; font-size: 15px;"></p>

            Numero tavolo: <input type="text" name="costumerTable" id="tableNum" value="<?php echo $costumerTable; ?>">
            <p id="errorTable" style="color:red; font-size: 15px;"></p>

            <?php
            // Stampo tutti i prodotti disponibili

                for($i=0; $i<count($products); $i++) {
                    echo "<h1>".$products[$i]['name']." prezzo: ".$products[$i]['price']."&euro;";

                    echo "<input type=button value='-' onclick=\"process(-1, '".$products[$i]['short_name']."', ".$products[$i]['price'].")\">";
                    echo "<input type=test size=5 id='".$products[$i]['short_name']."' name='".$products[$i]['short_name']."' value='".$quantity[$i]."'>";
                    echo "<input type=button value='+' onclick=\"process(1, '".$products[$i]['short_name']."', ".$products[$i]['price'].")\">";

                    echo "</h1>";
                }

            ?>

            <h3>Totale: <input type="text" name="totalCheck" id="totCheck" value="<?php echo $totalCheck; ?>" readonly></h3>

			<input type="submit" id="checkAll" name="checkAll" value="SALVA">
		</form>
		</center>
	</body>

</html>

