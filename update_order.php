<?php

    include_once('classes/ManageOrders.php');
    include_once('classes/ManageProducts.php');
	$order = new ManageOrders();
	$product = new ManageProducts();

    $products = $product->getProducts();
    $orders = $order->getOrders();

    $orderID = $_GET["id"]; // ID dell'ordine da modificare, questo serve a comporre il nome delle variabili: nome_cliente, tavolo_cliente e totale, che altrimenti non avrebbero un nome univoco per ogni ordine

    if(isset($_POST['costumerName'])) {
        $costumerName = $_POST['costumerName'];
    }
    if(isset($_POST['costumerTable'])) {
        $costumerTable = $_POST['costumerTable'];
    }

    for($i=0; $i<count($products); $i++) {
        $name = $products[$i]["short_name"]; // Dato che il nome degli elementi è lo short_name
        $quantity[$i] = $_POST[$name]; // Array con le quantità per ogni prodotto scelte dall'utente, in ordine come sono inserite nel DB
    }

    if(isset($_POST['totalCheck'.$orderID])) {
        $totalCheck = $_POST['totalCheck'.$orderID];
    }

    // Creo l'ordine e lo salvo nel db
    $productsList = ""; // Sarà formata id:quantita;id:quantita;id:quantita;...

    for($j=0; $j<count($products); $j++) {
        $productsList = $productsList.$products[$j]["id"].":".$quantity[$j].";";
    }

    $updated = $order->updateOrder($costumerName, $costumerTable, $productsList, $orderID); // Aggiorno il db

    if($updated != 0) {
        header('Location: admin.php');
    }
?>

<html>

    <head>
        <title>Salvataggio</title>
    </head>

    <body>
        <?php

            // Mostro all'utente l'esito dell' ordinazione
            if($updated == 0) {
                echo "<p style='color: red;'><b>Ordine non andato a buon fine</b></p>";
            }

        ?>

        <a href="admin.php">ADMIN</a>

    </body>

</html>
