<?php

    include_once('Connection.php'); // Richiamo la pagina di connessione al DB

    class ManageOrders {
		public $link;
		
		function __construct() { // Connetto al db
			$db_connection = new dbConnection(); 
			$this->link = $db_connection->connect(); 
			
			return $this->link;
		}
		
        // Registra un nuovo ordine, ritorna: 0 FAIL, 1 SUCCESS
        function registerOrder($customer_name, $table_num, $products_list) {
            $query = $this->link->prepare("INSERT INTO `order` (`customer_name`,`table_num`,`products_list`) VALUES (?,?,?)");
            
            $query->bindParam(1, $customer_name, PDO::PARAM_STR);
			$query->bindParam(2, $table_num, PDO::PARAM_STR);
		    $query->bindParam(3, $products_list, PDO::PARAM_STR);
            
            $query->execute();
            $counts = $query->rowCount();
            
            return $counts;
        }
        
        // Ritorna array con tutti gli ordini o 0 se non è andato a buon fine
        function getOrders() {
            $query = $this->link->query("SELECT `customer_name`,`table_num`,`products_list`,`paid` FROM `order` ");
			$counts = $query->rowCount();
			
			if($counts != 0) {
				$result = $query->fetchAll(); // Array annidato
				return $result;
			} 
			else {
				return $counts; // 0
			}
        }

        // Aggiorna il pagamento di un ordine, 0 FAIL, 1 SUCCESS
        function payOrder($orderID) {
            $query = $this->link->prepare("UPDATE `order` SET `paid`=1 WHERE `id`=?");
            
            $query->bindParam(1, $orderID, PDO::PARAM_STR);
            
            $query->execute();
            $counts = $query->rowCount();
            
            return $counts;
        }
        
		
	}

?>