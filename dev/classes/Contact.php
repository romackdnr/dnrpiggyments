<?
class Contact{
   
    
    function addContact($contact){
        global $adb;
		global $table_prefix;
		
		$comments = addslashes(strip_tags($contact->comments));
		$address = addslashes(strip_tags($contact->address));
		$name = addslashes(strip_tags($contact->name));
		$phone = addslashes(strip_tags($contact->phone));
		$email = addslashes(strip_tags($contact->email));
		$city = addslashes(strip_tags($contact->city));
		$zip = addslashes(strip_tags($contact->zip));
		$phone = addslashes(strip_tags($contact->phone));
        $query="INSERT INTO ".$table_prefix."_tblContact SET ".
            "fldContactName='$name',". 					
			"fldContactPhoneNo='$phone',". 
			"fldContactAddress='$address',". 
			"fldContactCity='$city',". 
			"fldContactZip='$zip',". 
			"fldContactPhone='$phone',". 
			"fldContactEmail='$email',".  
			"fldContactMessage='$comments'";  
        $adb->query($query);
        return mysql_insert_id();
    }
	
	function updateContact($contact) {
		 global $adb;
		 global $table_prefix;
		 
	$comments = addslashes(strip_tags($contact->comments));
		$address = addslashes(strip_tags($contact->address));
		$name = addslashes(strip_tags($contact->name));
		$phone = addslashes(strip_tags($contact->phone));
		$email = addslashes(strip_tags($contact->email));
		$city = addslashes(strip_tags($contact->city));
		$zip = addslashes(strip_tags($contact->zip));
		$phone = addslashes(strip_tags($contact->phone));
		
			$query="UPDATE ".$table_prefix."_tblContact SET ".
				    "fldContactName='$name',". 					
					"fldContactPhoneNo='$phone',". 
					"fldContactAddress='$address',". 
					"fldContactCity='$city',". 
					"fldContactZip='$zip',". 
					"fldContactPhone='$phone',".
					"fldContactEmail='$email',".  
					"fldContactMessage='$comments'".
           		 " WHERE fldContactID=$contact->Id";
	    $adb->query($query);
        return true;
	}
    
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblContact";
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
		
		$query = "SELECT * FROM ".$table_prefix."_tblContact";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countContact() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblContact";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findEmail($email){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblContact WHERE fldContactEmail='$email'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	function findContact($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblContact WHERE fldContactID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	   
    function deleteContact($id){        
        global $adb;
		global $table_prefix;
        
        $query = "DELETE FROM ".$table_prefix."_tblContact WHERE fldContactID='$id'";
        $adb->query($query);
        return true;
    }
    
 
   
}
?>
