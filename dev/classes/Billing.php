<?

class Billing{
       
    function addBilling($Billing){
        global $adb;
		global $table_prefix;
		
		$firstname = addslashes($Billing->firstname);
		$lastname = addslashes($Billing->lastname);
		$address = addslashes($Billing->address);
		$address1 = addslashes($Billing->address1);
		$city = addslashes($Billing->city);
		  
        $query="INSERT INTO ".$table_prefix."_tblBilling SET ".
            "fldBillingClientID='$Billing->client_id',". 			
			"fldBillingLastname='$lastname',". 
			"fldBillingFirstName='$firstname',". 
			"fldBillingEmail='$Billing->email',".			
			"fldBillingAddress='$address',".
			"fldBillingAddress1='$address1',".
			"fldBillingCity='$Billing->city',".
			"fldBillingState='$Billing->state',".
			"fldBillingCountry='$Billing->country',".
			"fldBillingZip='$Billing->zip',".
			"fldBillingPhoneNo='$Billing->phone'";			
			            
        $adb->query($query);
        return mysql_insert_id();
    }
	
	function updateBilling($Billing) {
		 global $adb;
 		 global $table_prefix;
		 
		$firstname = addslashes($Billing->firstname);
		$lastname = addslashes($Billing->lastname);
		$address = addslashes($Billing->address);
		$address1 = addslashes($Billing->address1);
		$city = addslashes($Billing->city);

			$query="UPDATE ".$table_prefix."_tblBilling SET ".			  	 		
				"fldBillingLastname='$lastname',". 
				"fldBillingFirstName='$firstname',". 
				"fldBillingEmail='$Billing->email',".			
				"fldBillingAddress='$address',".
				"fldBillingAddress1='$address1',".
				"fldBillingCity='$Billing->city',".
				"fldBillingState='$Billing->state',".
				"fldBillingCountry='$Billing->country',".
				"fldBillingZip='$Billing->zip',".
				"fldBillingPhoneNo='$Billing->phone'".	           
            " WHERE fldBillingID=$Billing->Id";
	    $adb->query($query);
        return true;
	}
	
	
	
    
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblBilling ORDER BY fldBillingFirstName";
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
		
		$query = "SELECT * FROM ".$table_prefix."_tblBilling ORDER BY fldBillingFirstName";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countBilling() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblBilling";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function countBillingClient($id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblBilling WHERE fldBillingClientID='$id'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function findBillingClient($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblBilling WHERE fldBillingClientID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
    function findBilling($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblBilling WHERE fldBillingID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	
	
	   
    function deleteBilling($id){        
        global $adb;
		global $table_prefix;
        
        $query = "DELETE FROM ".$table_prefix."_tblBilling WHERE fldBillingID='$id'";
        $adb->query($query);
        return true;
    }
    
    
}
?>
