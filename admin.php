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
                <td>
                    <center><b>Cancella</b></center>
                </td>
            </tr>

            <?php // Qui avviene la magia

                for($i=0; $i<count($allOrders); $i++) {
                    if($allOrders[$i]['paid'] == 0) { // Solo gli ordini non pagati

                        $hiddenVariables = ""; // Costruisco una stringa che passo successivamente

                        echo "<tr>";
                        echo "<td><center> ".$allOrders[$i]['customer_name']." </center></td>";
                        echo "<td><center> ".$allOrders[$i]['table_num']." </center></td>";

                        // Aggiungo nome e tavolo alle variabili nascoste da inviare. Il nome è customerNameID (dove id varia per ogni id ordine)
                        $hiddenVariables = $hiddenVariables."<input type='hidden' name='costumerName".$allOrders[$i]['id']."' value='".$allOrders[$i]['customer_name']."'>";
                        $hiddenVariables = $hiddenVariables."<input type='hidden' name='costumerTable".$allOrders[$i]['id']."' value='".$allOrders[$i]['table_num']."'>";

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

                                    $prodQuantity = $subOrder[1];
                                    $shortName = $products[$t]["short_name"];
                                    $hiddenVariables = $hiddenVariables."<input type='hidden' name='$shortName' value='$prodQuantity'>"; // Aggiungo le quantità rispettive ai prodotti alle variabili nascoste da inviare

                                    if($prodQuantity > 0) { // Se la quantità per quel prodotto è > 0
                                        $info = $product->getProductInfo($subOrder[0]); // Prendo info tramite l'id
                                        $amount = $info[0]["price"] * $prodQuantity; // Costo singolo prodotto
                                        $total = $total + $amount; // Aggiorno il costo totale

                                        echo "<td><center> ".$prodQuantity." - ".$amount."&euro; </center></td>"; // Quantità per prodotto - prezzo totale
                                        continue;
                                    }
                                    else {
                                        echo "<td><center> </center></td>";
                                        continue;
                                    }
                                }
                            }

                        }

                        $hiddenVariables = $hiddenVariables."<input type='hidden' name='totalCheck".$allOrders[$i]['id']."' value='".$total."'>";
                        echo "<td><center> <b>".$total."</b> </center></td>"; // Costo totale

                        // Bottone Pagamento
                        echo "<td><center>
                        <input type='button' name='paidBtn' onclick='payment(".$allOrders[$i]["id"].");' value='Pagato'>
                        </center></td>"; // Pagamento con relativa visualizzazione in cucina

                        // Bottone Modifica
                        echo "<td><center>
                        <form action='edit_order.php?id=".$allOrders[$i]["id"]."' method='POST'>"; // Inoltro una variabile GET con l'id dell'ordine

                        echo $hiddenVariables; // Tutte le variabili relative alle quantità di ogni prodotto, che passo per la modifica.

                        echo "<input type='submit' value='Modifica' onclick=''>
                        </form>
                        </center></td>";

                        // Bottone Cancella
                        echo "<td><center>
                        <input type='button' name='deleteBtn' onclick='deleteOrder(".$allOrders[$i]["id"].");' value='Cancella'>
                        </center></td>";
                        
                        
                        
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
                <td>
                    <center><b>Cancella</b></center>
                </td>
            </tr>

            <?php // Qui avviene la magia

                for($i=0; $i<count($allOrders); $i++) {
                    if($allOrders[$i]['paid'] == 1) { // Solo gli ordini pagati

                        $hiddenVariables = ""; // Costruisco una stringa che passo successivamente

                        echo "<tr>";
                        echo "<td><center> ".$allOrders[$i]['customer_name']." </center></td>";
                        echo "<td><center> ".$allOrders[$i]['table_num']." </center></td>";

                        // Aggiungo nome e tavolo alle variabili nascoste da inviare. Il nome è customerNameID (dove id varia per ogni id ordine)
                        $hiddenVariables = $hiddenVariables."<input type='hidden' name='costumerName".$allOrders[$i]['id']."' value='".$allOrders[$i]['customer_name']."'>";
                        $hiddenVariables = $hiddenVariables."<input type='hidden' name='costumerTable".$allOrders[$i]['id']."' value='".$allOrders[$i]['table_num']."'>";

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

                                    $prodQuantity = $subOrder[1];
                                    $shortName = $products[$t]["short_name"];
                                    $hiddenVariables = $hiddenVariables."<input type='hidden' name='$shortName' value='$prodQuantity'>"; // Aggiungo le quantità rispettive ai prodotti alle variabili nascoste da inviare

                                    if($prodQuantity > 0) { // Se la quantità per quel prodotto è > 0
                                        $info = $product->getProductInfo($subOrder[0]); // Prendo info tramite l'id
                                        $amount = $info[0]["price"] * $prodQuantity; // Costo singolo prodotto
                                        $total = $total + $amount; // Aggiorno il costo totale

                                        echo "<td><center> ".$prodQuantity." - ".$amount."&euro; </center></td>"; // Quantità per prodotto - prezzo totale
                                        continue;
                                    }
                                    else {
                                        echo "<td><center> </center></td>";
                                        continue;
                                    }
                                }
                            }

                        }

                        $hiddenVariables = $hiddenVariables."<input type='hidden' name='totalCheck".$allOrders[$i]['id']."' value='".$total."'>";
                        echo "<td><center> <b>".$total."</b> </center></td>"; // Costo totale

                        // Bottone Modifica
                        echo "<td><center>
                        <form action='edit_order.php?id=".$allOrders[$i]["id"]."' method='POST'>"; // Inoltro una variabile GET con l'id dell'ordine

                        echo $hiddenVariables; // Tutte le variabili relative alle quantità di ogni prodotto, che passo per la modifica

                        echo "<input type='submit' value='Modifica' onclick=''>
                        </form>
                        </center></td>";

                        // Bottone Cancella
                        echo "<td><center>
                        <input type='button' name='deleteBtn' onclick='deleteOrder(".$allOrders[$i]["id"].");' value='Cancella'>
                        </center></td>";
                        
                        
                        
                        
                        echo "</tr>";

                    }
                }

            ?>

        </table>
        </center>

    </body>

</html>
