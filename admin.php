<?php

    include_once("classes/ManageOrders.php");
    include_once("classes/ManageProducts.php");
    $orderManager = new ManageOrders();
    $product = new ManageProducts();

    $allOrders = $orderManager->getOrders();

    $piadina = $product->getProductInfo("Piadina al Salame");
    $piadinaID = $piadina[0]["id"];
    $cocacola = $product->getProductInfo("Coca Cola");
    $cocacolaID = $cocacola[0]["id"];
    $patatine = $product->getProductInfo("Patate Fritte");
    $patatineID = $patatine[0]["id"];
    $insalata = $product->getProductInfo("Insalata");
    $insalataID = $insalata[0]["id"];

    if(isset($_GET['msg'])) {
        echo $_GET['msg'];
    }

?>
<html>

    <head>
        <title>Admin</title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/Script.js"></script>
    </head>

    <body>
        
        <style>
            td, th {
                border: 1px solid black;
            }
            table {
                border-collapse: collapse;
                width: 80%;
            }
        </style>
        
        <center>
            
        <h1>Ordini Non Pagati</h1>
            
        <table>
            
            <tr>
                <td>
                    <center><b>Nome Cliente</b></center>
                </td>
                <td>
                    <center><b>Numero Tavolo</b></center>
                </td>
                <td>
                    <center><b>Piadina al Salame</b></center>
                </td>
                <td>
                    <center><b>Coca Cola</b></center>
                </td>
                <td>
                    <center><b>Patate Fritte</b></center>
                </td>
                <td>
                    <center><b>Insalata</b></center>
                </td>
                <td>
                    <center><b>Prezzo Totale</b></center>
                </td>
                <td>
                    <center><b>Pagamento</b></center>
                </td>
                <td>
                    <center><b>Modifiche</b></center>
                </td>
            </tr>
            
            <?php // Qui avviene la magia
            
                for($i=0; $i<count($allOrders); $i++) {
                    if($allOrders[$i]['paid'] == 0) {
                        
                        $piadinaQ = 0;
                        $cocacolaQ = 0;
                        $patatineQ = 0;
                        $insalataQ = 0;
                        
                        echo "<tr>";

                        echo "<td><center> ".$allOrders[$i]['customer_name']." </center></td>";
                        echo "<td><center> ".$allOrders[$i]['table_num']." </center></td>";

                        $orderString = $allOrders[$i]['products_list'];
                        $order = explode(";", $orderString); // Array con tutti gli ordini (coppia id:quantita)

                        $total = 0;

                        for($j=0; $j<count($order); $j++) {
                            $subOrder = explode(":", $order[$j]);


                            if($subOrder[0] == $piadinaID) {
                                if($subOrder[1] > 0) {
                                    $info = $product->getProductInfo($subOrder[0]); // Prendo info tramite l'id
                                    $amount = $info[0]["price"] * $subOrder[1]; // Costo singolo prodotto
                                    $total = $total + $amount; // Aggiorno il costo totale

                                    $piadinaQ = $subOrder[1]; // Quantità di piadina per questo ordine
                                    echo "<td><center> ".$piadinaQ." - ".$amount."&euro; </center></td>";
                                    continue;
                                }
                                else {
                                    echo "<td><center> </center></td>";
                                    continue;
                                }
                            }
                            else if($subOrder[0] == $cocacolaID) {
                                if($subOrder[1] > 0) {
                                    $info = $product->getProductInfo($subOrder[0]); // Prendo info tramite l'id
                                    $amount = $info[0]["price"] * $subOrder[1]; // Costo singolo prodotto
                                    $total = $total + $amount; // Aggiorno il costo totale

                                    $cocacolaQ = $subOrder[1];
                                    echo "<td><center> ".$cocacolaQ." - ".$amount."&euro; </center></td>";
                                    continue;
                                }
                                else {
                                    echo "<td><center> </center></td>";
                                    continue;
                                }
                            }
                            else if($subOrder[0] == $patatineID) {
                                if($subOrder[1] > 0) {
                                    $info = $product->getProductInfo($subOrder[0]); // Prendo info tramite l'id
                                    $amount = $info[0]["price"] * $subOrder[1]; // Costo singolo prodotto
                                    $total = $total + $amount; // Aggiorno il costo totale

                                    $patatineQ = $subOrder[1];
                                    echo "<td><center> ".$patatineQ." - ".$amount."&euro; </center></td>";
                                    continue;
                                }
                                else {
                                    echo "<td><center> </center></td>";
                                    continue;
                                }
                            }
                            else if($subOrder[0] == $insalataID) {
                                if($subOrder[1] > 0) {
                                    $info = $product->getProductInfo($subOrder[0]); // Prendo info tramite l'id
                                    $amount = $info[0]["price"] * $subOrder[1]; // Costo singolo prodotto
                                    $total = $total + $amount; // Aggiorno il costo totale

                                    $insalataQ = $subOrder[1];
                                    echo "<td><center> ".$insalataQ." - ".$amount."&euro; </center></td>";
                                    continue;
                                }
                                else {
                                    echo "<td><center> </center></td>";
                                    continue;
                                }
                            }


                        }

                        echo "<td><center> <b>".$total."</b> </center></td>"; // Costo totale
                        
                        echo "<td><center> 
                        <input type='button' name='paidBtn' onclick='payment(".$allOrders[$i]["id"].");' value='Pagato'>
                        </center></td>"; // Pagamento con relativa visualizzazione in cucina
                        
                        echo "<td><center> 
                        <form action='edit_order.php' method='POST'>
                        DA FINIRE
                        <input type='hidden' name='piadinaQ' value=".$piadinaQ.">
                        <input type='submit' value='Modifica' onclick=''> 
                        </form>
                        </center></td>"; // Modifiche
                        
                        echo "</tr>";

                    }
                }
            
            ?>
            
        </table>
        </center>
        <br /> <br /> <br />
        
        <center>
            
        <center><h1>Ordini Pagati</h1></center>
            
        <table>
            
            <tr>
                <td>
                    <center><b>Nome Cliente</b></center>
                </td>
                <td>
                    <center><b>Numero Tavolo</b></center>
                </td>
                <td>
                    <center><b>Piadina al Salame</b></center>
                </td>
                <td>
                    <center><b>Coca Cola</b></center>
                </td>
                <td>
                    <center><b>Patate Fritte</b></center>
                </td>
                <td>
                    <center><b>Insalata</b></center>
                </td>
                <td>
                    <center><b>Prezzo Totale</b></center>
                </td>
                <td>
                    <center><b>Modifiche</b></center>
                </td>
            </tr>
            
            <?php // Qui avviene la magia
            
                for($i=0; $i<count($allOrders); $i++) {
                    if($allOrders[$i]['paid'] == 1) {
                        echo "<tr>";

                        echo "<td><center> ".$allOrders[$i]['customer_name']." </center></td>";
                        echo "<td><center> ".$allOrders[$i]['table_num']." </center></td>";

                        $orderString = $allOrders[$i]['products_list'];
                        $order = explode(";", $orderString); // Array con tutti gli ordini (coppia id:quantita)

                        $total = 0;

                        for($j=0; $j<count($order); $j++) {
                            $subOrder = explode(":", $order[$j]);


                            if($subOrder[0] == $piadinaID) {
                                if($subOrder[1] > 0) {
                                    $info = $product->getProductInfo($subOrder[0]); // Prendo info tramite l'id
                                    $amount = $info[0]["price"] * $subOrder[1]; // Costo singolo prodotto
                                    $total = $total + $amount; // Aggiorno il costo totale

                                    echo "<td><center> ".$subOrder[1]." - ".$amount."&euro; </center></td>";
                                    continue;
                                }
                                else {
                                    echo "<td><center> </center></td>";
                                    continue;
                                }
                            }
                            else if($subOrder[0] == $cocacolaID) {
                                if($subOrder[1] > 0) {
                                    $info = $product->getProductInfo($subOrder[0]); // Prendo info tramite l'id
                                    $amount = $info[0]["price"] * $subOrder[1]; // Costo singolo prodotto
                                    $total = $total + $amount; // Aggiorno il costo totale

                                    echo "<td><center> ".$subOrder[1]." - ".$amount."&euro; </center></td>";
                                    continue;
                                }
                                else {
                                    echo "<td><center> </center></td>";
                                    continue;
                                }
                            }
                            else if($subOrder[0] == $patatineID) {
                                if($subOrder[1] > 0) {
                                    $info = $product->getProductInfo($subOrder[0]); // Prendo info tramite l'id
                                    $amount = $info[0]["price"] * $subOrder[1]; // Costo singolo prodotto
                                    $total = $total + $amount; // Aggiorno il costo totale

                                    echo "<td><center> ".$subOrder[1]." - ".$amount."&euro; </center></td>";
                                    continue;
                                }
                                else {
                                    echo "<td><center> </center></td>";
                                    continue;
                                }
                            }
                            else if($subOrder[0] == $insalataID) {
                                if($subOrder[1] > 0) {
                                    $info = $product->getProductInfo($subOrder[0]); // Prendo info tramite l'id
                                    $amount = $info[0]["price"] * $subOrder[1]; // Costo singolo prodotto
                                    $total = $total + $amount; // Aggiorno il costo totale

                                    echo "<td><center> ".$subOrder[1]." - ".$amount."&euro; </center></td>";
                                    continue;
                                }
                                else {
                                    echo "<td><center> </center></td>";
                                    continue;
                                }
                            }


                        }

                        echo "<td><center> <b>".$total."</b> </center></td>"; // Costo totale
                        
                        echo "<td><center> <button type='button'>Modifica</button> </center></td>"; // Modifiche
                        
                        echo "</tr>";

                    }
                }
            ?>
            
        </table>
        </center>
        
    </body>
    
</html>