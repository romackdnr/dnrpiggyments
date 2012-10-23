<?
  
class Cart{
     
    function addCart($cart){
        global $adb;
		global $table_prefix;
		
		$name = addslashes($cart->fldCartProductName);
		$date = date('Y-m-d');
		$time = date('g:i:s a');
        $query="INSERT INTO ".$table_prefix."_tblCart SET ".           			
			"fldCartProductID='$cart->fldCartProductID',". 			
			"fldCartClientID='$cart->fldCartClientID',".
			"fldCartProductName='$name',". 	
			"fldCartProductPrice='$cart->fldCartProductPrice',". 				
			"fldCartQuantity='$cart->fldCartQuantity',".
			"fldCartOrderNo='$cart->fldCartOrderNo',".			
			"fldCartCoupon='$cart->fldCartCoupon',".
			"fldCartStatus='$cart->fldCartStatus',".
			"fldCartOptions='$cart->fldCartOptions',".
			"fldCartTime='$time',".
            "fldCartDate='$date'";
        $adb->query($query);
        return true;
    }
	
	
    function updateCartStatus($order_id,$trans_id){
        global $adb;
		global $table_prefix;
		
		$status = 'Paid';
		
      	$query="UPDATE ".$table_prefix."_tblCart SET ".
				"fldCartStatus='$status',".				
				"fldCartTransactionNo='$trans_id'".				
				
            " WHERE fldCartOrderNo='$order_id'";
        $adb->query($query);
        return true;
    }
	
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblCart GROUP BY fldCartOrderNo ORDER BY fldCartID DESC";
		$result = $adb->query($query.$pg);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function findAllClient($pg,$client_id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblCart WHERE fldCartClientID='$client_id' GROUP BY fldCartOrderNo ORDER BY fldCartID DESC";
		$result = $adb->query($query.$pg);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function displayAll() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblCart";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function displayAllByOrders($order_id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblCart WHERE fldCartOrderNo='$order_id'";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
		
	function counCart() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblCart GROUP BY fldCartOrderNo";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function counCartByClient($client_id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblCart WHERE fldCartClientID='$client_id' GROUP BY fldCartOrderNo";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function counCartByOrderNo($order_no) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblCart WHERE fldCartOrderNo='$order_no'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	 function getTotalCartByOrderNo($order_no){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT sum(fldCartProductPrice * fldCartQuantity)  as totalPrice FROM ".$table_prefix."_tblCart WHERE fldCartOrderNo='$order_no'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
    function findCart($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblCart WHERE fldCartID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	function findCartByOrderID($order_id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblCart WHERE fldCartOrderNo='$order_id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deleteCart($id){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblCart WHERE fldCartID='$id'";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
