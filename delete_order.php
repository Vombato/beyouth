<?php
    include_once("classes/ManageOrders.php");
    $orderManager = new ManageOrders();

    if($_GET['id']) {
        $orderID = $_GET['id'];
    }

    $orderManager->deleteOrder($orderID);

?>