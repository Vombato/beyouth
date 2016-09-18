<?php

    include_once('Connection.php'); // Richiamo la pagina di connessione al DB

    class ManageProducts {
		public $link;
		
		function __construct() { // Quando viene invocato questo file, automaticamente effetua la connessione al db
			$db_connection = new dbConnection(); 
			$this->link = $db_connection->connect(); 
			
			return $this->link;
		}
		
        // Registra un nuovo prodotto, ritorna: 0 FAIL, 1 SUCCESS
        function registerProduct($name, $price, $category, $in_store) {
            $query = $this->link->prepare("INSERT INTO `product` (`name`,`price`,`category`,`in_store`) VALUES (?,?,?,?)"); // Predispondo la query
            
            // Per evitare falle di sicurezza 
            $query->bindParam(1, $name, PDO::PARAM_STR);
			$query->bindParam(2, $price, PDO::PARAM_STR);
		    $query->bindParam(3, $category, PDO::PARAM_STR);
		    $query->bindParam(4, $in_store, PDO::PARAM_STR);
            
            $query->execute(); // Eseguo la query
            $counts = $query->rowCount();
            
            return $counts;
        }
        
        function getProductInfo($value) { // Value può essere l'id (un intero) o il nome (una stringa)
            
            if(ctype_digit($value)) { // Numero, cerco in base all'ID
                $query = $this->link->query("SELECT * FROM product WHERE id = '$value'");
            }
            else { // Stringa, cerco in base al nome
                $query = $this->link->query("SELECT * FROM product WHERE name = '$value'");
            }
            
			$counts = $query->rowCount();
			
			if($counts == 1) {
				$result = $query->fetchAll(); // Restituisce un array annidato in cui in posizione 0, 1, 2 ecc ci sono diversi array uno per ogni nome = $name (quindi presumibilmente 1), all'interno dei quali sono divisi in [id] [name] [price] eccetera
				return $result;
			} 
			else {
				return $counts; // Che sarà 0
			}
        }

		
	}

?>