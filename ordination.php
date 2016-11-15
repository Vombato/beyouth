<?php

    include_once('classes/ManageOrders.php');
    include_once('classes/ManageProducts.php');
	$order = new ManageOrders();
	$product = new ManageProducts();

    $products = $product->getProducts();

    $costumerName = $_POST['costumerName'];
    $costumerTable = $_POST['costumerTable'];

    for($i=0; $i<count($products); $i++) {
        $name = $products[$i]["short_name"]; // Dato che il nome degli elementi è lo short_name
        $quantity[$i] = $_POST[$name]; // Array con le quantità per ogni prodotto scelte dall'utente, in ordine come sono inserite nel DB
    }

	$totalCheck = $_POST['totalCheck'];

    // Creo l'ordine e lo salvo nel db
    $productsList = ""; // Sarà formata id:quantita;id:quantita;id:quantita;...

    for($j=0; $j<count($products); $j++) {
        $productsList = $productsList.$products[$j]["id"].":".$quantity[$j].";";
    }

    $registration = $order->registerOrder($costumerName, $costumerTable, $productsList); // Salvo nel db

?>

<html>

    <head>
        <title>Ordinazione</title>
    </head>

    <body>
        <?php

            // Mostro all'utente l'esito dell' ordinazione
            if($registration != 0) {
                echo "<p style='color: green;'><b>Ordine effettuato con successo</b></p>";
            }
            else {
                echo "<p style='color: red;'><b>Ordine non andato a buon fine</b></p>";
            }

        ?>

        <a href="index.php">HOME</a>

    </body>

</html>















