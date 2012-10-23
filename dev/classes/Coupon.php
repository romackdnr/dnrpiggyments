<?    
class Coupon{
   
    
    function addCoupon($coupon){
        global $adb;
		global $table_prefix;
		
		$code = addslashes($coupon->code);
		$name = addslashes($coupon->name);
		
		
        $query="INSERT INTO ".$table_prefix."_tblCoupon SET ".
            "fldCouponCode='$code',". 
			"fldCouponName='$name',". 
			"fldCouponPrice='$coupon->amount',". 
			"fldCouponPercent='$coupon->percent',". 
			"fldCouponFreeShipping='$coupon->isFreeShipping'";			
			
        $adb->query($query);
        return mysql_insert_id();
    }
	
	function updateCoupon($coupon) {
		 global $adb;
		 global $table_prefix;
		
		$code = addslashes($coupon->code);
		$name = addslashes($coupon->name);

			$query="UPDATE ".$table_prefix."_tblCoupon SET ".			 
			 "fldCouponCode='$code',". 
			"fldCouponName='$name',". 
			"fldCouponPrice='$coupon->amount',". 
			"fldCouponPercent='$coupon->percent',". 
			"fldCouponFreeShipping='$coupon->isFreeShipping'".             
            " WHERE fldCouponID=$coupon->Id";
	    $adb->query($query);
        return true;
	}
	

	   
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblCoupon ORDER BY fldCouponID DESC";
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
		
		$query = "SELECT * FROM ".$table_prefix."_tblCoupon ORDER BY fldCouponID DESC";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countCoupon() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblCoupon";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function countCouponByCode($code) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblCoupon WHERE fldCouponCode='$code'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	

	function findCouponByCode($code){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblCoupon WHERE fldCouponCode='$code'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
    function findCoupon($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblCoupon WHERE fldCouponID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	
	
	   
    function deleteCoupon($id){        
        global $adb;
		global $table_prefix;
        
        $query = "DELETE FROM ".$table_prefix."_tblCoupon WHERE fldCouponID='$id'";
        $adb->query($query);
        return true;
    }
    
    
}
?>
