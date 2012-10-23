<?

class TempCart{
     
    function addTempcart($cart){
        global $adb;
		global $table_prefix;
		
		$name = addslashes($cart->product_name);
		$date = date('Y-m-d');
        $query="INSERT INTO ".$table_prefix."_tblTempCart SET ".           			
			"fldTempCartProductID='{$cart->product_id}',". 			
			"fldTempCartClientID='{$cart->client_id}',".
			"fldTempCartProductName='{$name}',". 	
			"fldTempCartProductPrice='{$cart->price}',". 				
			"fldTempCartQuantity='{$cart->quantity}',".
			"fldTempCartOptions='{$cart->options}',".
            "fldTempCartDate='{$date}'";
        error_log("Adding Item to Cart");
        error_log("QUERY: " . $query);
        $adb->query($query);
        return true;
    }
	
	function updateTempcart($qty,$id){
        global $adb;
		global $table_prefix;
		
		
      	$query="UPDATE ".$table_prefix."_tblTempCart SET ".
				"fldTempCartQuantity='$qty'".				
				
            " WHERE fldTempCartID=$id";
        $adb->query($query);
        return true;
    }
	
	function updateTempcartClient($client_id,$xclient_id){
        global $adb;
		global $table_prefix;
		
		
      	$query="UPDATE ".$table_prefix."_tblTempCart SET ".
				"fldTempCartClientID='$client_id'".				
				
            " WHERE fldTempCartClientID='$xclient_id'";
        $adb->query($query);
        return true;
    }
	
    
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblTempCart";
		$result = $adb->query($query.$pg);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function findTempcartByCondition($condition) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblTempCart WHERE $condition";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function computeTempCartPrice($condition){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT sum(fldTempCartProductPrice) as totalPrice FROM ".$table_prefix."_tblTempCart WHERE $condition";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	function displayAll() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblTempCart";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
		
	function counTempCart() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblTempCart";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	
	function countTempcartbyClient($client_id) {
		global $adb;
		global $table_prefix;
		$date = date('Y-m-d');
		$query = "SELECT * FROM ".$table_prefix."_tblTempCart WHERE fldTempCartClientID='$client_id' AND fldTempCartDate='$date'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function countTempcartbyCondition($condition) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblTempCart WHERE $condition";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findTempCart($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblTempCart WHERE fldTempCartID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	function displayTempcart($condition){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblTempCart WHERE $condition";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deleteTempCartByCondition($condition){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblTempCart WHERE $condition";
        $adb->query($query);
        return true;
    }
	
    function deleteTempCart($id){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblTempCart WHERE fldTempCartID='$id'";
        $adb->query($query);
        return true;
    }
    
	function checkProductOption($pid) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblProductsOption WHERE fldProductsOptionProductsId='".$pid."' ";
		$result = $adb->query($query);
		return $result->db_num_rows();
	}
   
	function computeTempCartTotalPrice($condition){
        global $adb;
		global $table_prefix;

		$query = "SELECT sum( fldTempCartQuantity * fldTempCartProductPrice ) AS totalPrice FROM ".$table_prefix."_tblTempCart WHERE $condition ";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	function getTempCartProductOption($condition){
        global $adb;
		global $table_prefix;

		$query = "SELECT * FROM ".$table_prefix."_tblTempCart WHERE $condition ";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
    }

	function computeTempCartProductOptionTotalPrice($product_option, $product_id){
        global $adb;
		global $table_prefix;
		
		$query = "SELECT SUM( fldProductsOptionAmount ) AS totalProdOptionPrice ".
				"FROM ".$table_prefix."_tblProductsOption ".
				"WHERE fldProductsOptionProductsId =".$product_id." ";
		if(!empty($product_option)) $query .= "AND fldProductsOptionID IN (".$product_option.")";

		$result = $adb->query($query);
		return $result->fetch_object();
    }
   
}
?>
