<?
    
class ShippingRate{
     
    function addShippingRate($shipping){
        global $adb;
		global $table_prefix;
		
        $query="INSERT INTO ".$table_prefix."_tblShippingRate SET ".           						 			
			"fldShippingRateOrderNo='$shipping->order_no',".
			"fldShippingRateName='$shipping->shipping_name',". 	
			"fldShippingRateAmount='$shipping->shipping_amount'"; 							
        $adb->query($query);
        return true;
    }
	
	
    
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblShippingRate";
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
		
		$query = "SELECT * FROM ".$table_prefix."_tblShippingRate";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
		
	function counShippingRate() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblShippingRate";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function findShippingRateByOrderCode($code){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblShippingRate WHERE fldShippingRateOrderNo='$code'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
   
    function findShippingRate($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblShippingRate WHERE fldShippingRateID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deleteShippingRate($id){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblShippingRate WHERE fldShippingRateID='$id'";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
