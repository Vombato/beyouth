<?php

    include_once('classes/ManageOrders.php'); 
    include_once('classes/ManageProducts.php'); 
	$order = new ManageOrders();
	$product = new ManageProducts();

    $costumerName = $_POST['costumerName'];
    $costumerTable = $_POST['costumerTable'];
    if(isset($_POST['piadina'])) {
        $piadinaQ = $_POST['piadina'];
    }
    if(isset($_POST['cocacola'])) {
        $cocacolaQ = $_POST['cocacola'];
    }
    if(isset($_POST['patatine'])) {
        $patatineQ = $_POST['patatine'];
    }
    if(isset($_POST['insalata'])) {
        $insalataQ = $_POST['insalata'];
    }
    
	$totalCheck = $_POST['totalCheck'];

    // Creo l'ordine e lo salvo nel db
    $productsList = ""; // Sarà formata id:quantita;id:quantita;id:quantita;...

    if($piadinaQ > 0) {
        $piadina = $product->getProductInfo("Piadina al Salame");
        $productsList = $productsList.$piadina[0]["id"].":".$piadinaQ.";";
    }
    if($cocacolaQ > 0) {
        $cocacola = $product->getProductInfo("Coca Cola");
        $productsList = $productsList.$cocacola[0]["id"].":".$cocacolaQ.";";
    }
    if($patatineQ > 0) {
        $patatine = $product->getProductInfo("Patate Fritte");
        $productsList = $productsList.$patatine[0]["id"].":".$patatineQ.";";
    }
    if($insalataQ > 0) {
        $insalata = $product->getProductInfo("Insalata");
        $productsList = $productsList.$insalata[0]["id"].":".$insalataQ.";";
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















