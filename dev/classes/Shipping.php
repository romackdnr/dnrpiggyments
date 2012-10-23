<?

class Shipping{
       
    function addShipping($shipping){
        global $adb;
		global $table_prefix;
		
		$firstname = addslashes($shipping->firstname);
		$lastname = addslashes($shipping->lastname);
		$address = addslashes($shipping->address);
		$address1 = addslashes($shipping->address1);
		$city = addslashes($shipping->city);
		  
        $query="INSERT INTO ".$table_prefix."_tblShipping SET ".
            "fldShippingClientID='$shipping->client_id',". 			
			"fldShippingLastname='$lastname',". 
			"fldShippingFirstName='$firstname',". 
			"fldShippingEmail='$shipping->email',".			
			"fldShippingAddress='$address',".
			"fldShippingAddress1='$address1',".
			"fldShippingCity='$shipping->city',".
			"fldShippingState='$shipping->state',".
			"fldShippingCountry='$shipping->country',".
			"fldShippingZip='$shipping->zip',".
			"fldShippingPhoneNo='$shipping->phone'";			
			            
        $adb->query($query);
        return mysql_insert_id();
    }
	
	function updateShipping($shipping) {
		 global $adb;
 		 global $table_prefix;
		 
		$firstname = addslashes($shipping->firstname);
		$lastname = addslashes($shipping->lastname);
		$address = addslashes($shipping->address);
		$address1 = addslashes($shipping->address1);
		$city = addslashes($shipping->city);

			$query="UPDATE ".$table_prefix."_tblShipping SET ".			  	 		
				"fldShippingLastname='$lastname',". 
				"fldShippingFirstName='$firstname',". 
				"fldShippingEmail='$shipping->email',".			
				"fldShippingAddress='$address',".
				"fldShippingAddress1='$address1',".
				"fldShippingCity='$shipping->city',".
				"fldShippingState='$shipping->state',".
				"fldShippingCountry='$shipping->country',".
				"fldShippingZip='$shipping->zip',".
				"fldShippingPhoneNo='$shipping->phone'".	           
            " WHERE fldShippingID=$shipping->Id";
	    $adb->query($query);
        return true;
	}
	
	
	
    
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblShipping ORDER BY fldShippingFirstName";
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
		
		$query = "SELECT * FROM ".$table_prefix."_tblShipping ORDER BY fldShippingFirstName";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countShipping() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblShipping";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function countShippingClient($id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblShipping WHERE fldShippingClientID='$id'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function findShippingClient($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblShipping WHERE fldShippingClientID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
    function findShipping($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblShipping WHERE fldShippingID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	
	
	   
    function deleteShipping($id){        
        global $adb;
		global $table_prefix;
        
        $query = "DELETE FROM ".$table_prefix."_tblShipping WHERE fldShippingID='$id'";
        $adb->query($query);
        return true;
    }
    
    
}
?>
