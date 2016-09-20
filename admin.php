<?php

    include_once("classes/ManageOrders.php");
    include_once("classes/ManageProducts.php");
    $orderManager = new ManageOrders();
    $product = new ManageProducts();

    $products = $product->getProducts(); // Tutte le info di tutti i prodotti

    $allOrders = $orderManager->getOrders(); // Tutte le info di tutti gli ordini
    
    for($k=0; $k<count($products); $k++) {
        $prodIDs[$k] = $products[$k]["id"]; // Array con tutti gli id dei prodotti in ordine di immissione nel db
    }

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
                <?php
                    
                    for($q=0; $q<count($products); $q++) {
                        echo "<td>
                                <center><b>".$products[$q]["name"]."</b></center>
                            </td>";
                    }
                
                ?>
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
                        
                        echo "<tr>";

                        echo "<td><center> ".$allOrders[$i]['customer_name']." </center></td>";
                        echo "<td><center> ".$allOrders[$i]['table_num']." </center></td>";

                        $orderString = $allOrders[$i]['products_list'];
                        $orderString = substr($orderString, 0, -1); // Tolgo l'utlimo ; se no mi dà un elemento vuoto nell'array quando esplodo
                        
                        $order = explode(";", $orderString); // Array con tutti gli ordini (coppia id:quantita)

                        // Completo gli ordini in caso ne siano stati aggiunti altri dopo un po' settandoli a 0 (per far combaciare la tabella)
                        for($h=count($order); $h<count($products); $h++) {
                            $order[$h] = $products[$h]["id"].":0";
                        }
                    
                        $total = 0;
                        
                        for($j=0; $j<count($order); $j++) {
                            $subOrder = explode(":", $order[$j]);
        
                            for($t=0; $t<count($prodIDs); $t++) {
                                if($subOrder[0] == $prodIDs[$t]) { // Controllo che (in teoria) sarà sempre vero dato che i prodotti negli ordini sono registrati in ordine di id e $prodIDs al suo interno ha gli ID dei prodotti nello stesso ordine
                                    
                                    if($subOrder[1] > 0) { // Se la quantità per quel prodotto è > 0
                                        $info = $product->getProductInfo($subOrder[0]); // Prendo info tramite l'id
                                        $amount = $info[0]["price"] * $subOrder[1]; // Costo singolo prodotto
                                        $total = $total + $amount; // Aggiorno il costo totale

                                        echo "<td><center> ".$subOrder[1]." - ".$amount."&euro; </center></td>"; // Quantità per prodotto - prezzo totale
                                        continue;
                                    }
                                    else {
                                        echo "<td><center> </center></td>";
                                        continue;
                                    }
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
                <?php
                    
                    for($q=0; $q<count($products); $q++) {
                        echo "<td>
                                <center><b>".$products[$q]["name"]."</b></center>
                            </td>";
                    }
                
                ?>
                <td>
                    <center><b>Prezzo Totale</b></center>
                </td>
                <td>
                    <center><b>Modifiche</b></center>
                </td>
            </tr>
            
            <?php // Qui avviene la magia
            
                for($i=0; $i<count($allOrders); $i++) {
                    if($allOrders[$i]['paid'] == 1) { // Quelli pagati
                        
                        echo "<tr>";

                        echo "<td><center> ".$allOrders[$i]['customer_name']." </center></td>";
                        echo "<td><center> ".$allOrders[$i]['table_num']." </center></td>";

                        $orderString = $allOrders[$i]['products_list'];
                        $orderString = substr($orderString, 0, -1); // Tolgo l'utlimo ; se no mi dà un elemento vuoto nell'array quando esplodo
                        
                        $order = explode(";", $orderString); // Array con tutti gli ordini (coppia id:quantita)

                        // Completo gli ordini in caso ne siano stati aggiunti altri dopo un po' settandoli a 0 (per far combaciare la tabella)
                        for($h=count($order); $h<count($products); $h++) {
                            $order[$h] = $products[$h]["id"].":0";
                        }
                    
                        $total = 0;
                        
                        for($j=0; $j<count($order); $j++) {
                            $subOrder = explode(":", $order[$j]);
        
                            for($t=0; $t<count($prodIDs); $t++) {
                                if($subOrder[0] == $prodIDs[$t]) { // Controllo che (in teoria) sarà sempre vero dato che i prodotti negli ordini sono registrati in ordine di id e $prodIDs al suo interno ha gli ID dei prodotti nello stesso ordine
                                    
                                    if($subOrder[1] > 0) { // Se la quantità per quel prodotto è > 0
                                        $info = $product->getProductInfo($subOrder[0]); // Prendo info tramite l'id
                                        $amount = $info[0]["price"] * $subOrder[1]; // Costo singolo prodotto
                                        $total = $total + $amount; // Aggiorno il costo totale

                                        echo "<td><center> ".$subOrder[1]." - ".$amount."&euro; </center></td>"; // Quantità per prodotto - prezzo totale
                                        continue;
                                    }
                                    else {
                                        echo "<td><center> </center></td>";
                                        continue;
                                    }
                                }
                            }

                        }

                        echo "<td><center> <b>".$total."</b> </center></td>"; // Costo totale
                        
                        echo "<td><center> 
                        <form action='edit_order.php' method='POST'>
                        DA FINIRE
                        <input type='submit' value='Modifica' onclick=''> 
                        </form>
                        </center></td>"; // Modifiche
                        
                        echo "</tr>";

                    }
                }
            
            ?>
            
        </table>
        </center>
        
    </body>
    
</html>