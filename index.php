<?php
    include_once('classes/ManageProducts.php'); 
	$product = new ManageProducts();

    $piadina = $product->getProductInfo('Piadina al salame');
    $cocacola = $product->getProductInfo('Coca Cola');
    $patatine = $product->getProductInfo('Patate Fritte');
    $insalata = $product->getProductInfo('Insalata');

?>
<html>

	<head>
		<title>Main Page</title>
        <script src="Script.js"></script>
	</head>

	<body onload="checkAmount();">
		
		<form action="Resoconto.php" method="POST">

            Nome cliente: <input type="text" name="name">
            </br></br>
            Numero tavolo: <input type="text" name="tableNum">
            <p style="color: red;">
                <?php 
                    if(isset($_GET['error'])) {
                        echo $_GET['error'];
                    }  
                ?>
            </p>

            <h1><?php echo $piadina[0]['name']." prezzo: ".$piadina[0]['price']."&euro;"; ?>

                <input type=button value='-' onclick="process(-1, 'piadina', <?php echo $piadina[0]['price']; ?>)">
                <input type=test size=5 id='piadina' name='piadina' value='0'>
                <input type=button value='+' onclick="process(1, 'piadina', <?php echo $piadina[0]['price']; ?>)">

            </h1>

            <h1><?php echo $cocacola[0]['name']." prezzo: ".$cocacola[0]['price']."&euro;"; ?>

                <input type=button value='-' onclick="process(-1, 'cocacola', <?php echo $cocacola[0]['price']; ?>)">
                <input type=test size=5 id='cocacola' name='cocacola' value='0'>
                <input type=button value='+' onclick="process(1, 'cocacola', <?php echo $cocacola[0]['price']; ?>)">

            </h1>

            <h1><?php echo $patatine[0]['name']." prezzo: ".$patatine[0]['price']."&euro;"; ?>

                <input type=button value='-' onclick="process(-1, 'patatine', <?php echo $patatine[0]['price']; ?>)">
                <input type=test size=5 id='patatine' name='patatine' value='0'>
                <input type=button value='+' onclick="process(1, 'patatine', <?php echo $patatine[0]['price']; ?>)">

            </h1>

            <h1><?php echo $insalata[0]['name']." prezzo: ".$insalata[0]['price']."&euro;"; ?>

                <input type=button value='-' onclick="process(-1, 'insalata', <?php echo $insalata[0]['price']; ?>)">
                <input type=test size=5 id='insalata' name='insalata' value='0'>
                <input type=button value='+' onclick="process(1, 'insalata', <?php echo $insalata[0]['price']; ?>)">

            </h1>
		
            <h3>Totale: <input type="text" name="totCheck" id="totCheck" value="0"></h3>
            
			<input type="submit" id="checkAll" name="checkAll" value="RESOCONTO">
		</form>
		
	</body>

</html>
