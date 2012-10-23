<?

  
    
class Client{
   
    
    function addClient($client){
        global $adb;
		global $table_prefix;
		
		$firstname = addslashes($client->firstname);
		$lastname = addslashes($client->lastname);
		$address = addslashes($client->address);
		$address1 = addslashes($client->address1);
		$city = addslashes($client->city);
		
		$password = $client->password;
		$date = date('Y-m-d');
		
        $query="INSERT INTO ".$table_prefix."_tblClient SET ".
            "fldClientUsername='$client->username',". 
			"fldClientPassword='$password',". 
			"fldClientLastname='$lastname',". 
			"fldClientFirstName='$firstname',". 
			"fldClientEmail='$client->email_address',".			
			"fldClientAddress='$address',".
			"fldClientAddress1='$address1',".
			"fldClientCity='$client->city',".
			"fldClientState='$client->state',".
			"fldClientCountry='$client->country',".
			"fldClientZip='$client->zip',".
			"fldClientPhoneNo='$client->phone',".			
			"fldClientRegDate='$date'";             
        $adb->query($query);
        return mysql_insert_id();
    }
	
	function updateClient($client) {
		 global $adb;
		 global $table_prefix;
		
		$firstname = addslashes($client->firstname);
		$lastname = addslashes($client->lastname);
		$address = addslashes($client->address);
		$address1 = addslashes($client->address1);
		$city = addslashes($client->city);

			$query="UPDATE ".$table_prefix."_tblClient SET ".			 
			"fldClientLastname='$lastname',". 
			"fldClientFirstName='$firstname',". 
			"fldClientEmail='$client->email_address',".			
			"fldClientAddress='$address',".
			"fldClientAddress1='$address1',".
			"fldClientCity='$client->city',".
			"fldClientState='$client->state',".
			"fldClientZip='$client->zip',".
			"fldClientCountry='$client->country',".
			"fldClientPhoneNo='$client->phone'".	             
            " WHERE fldClientID=$client->Id";
	    $adb->query($query);
        return true;
	}
	
	
	
	
	function changePassword($client) {
		 global $adb;
		 global $table_prefix;
		 
		$password = $client->password;
			$query="UPDATE ".$table_prefix."_tblClient SET ".          
			"fldClientUsername='$client->username',".
			"fldClientPassword='$password'".              
            " WHERE fldClientID=$client->Id";
	    $adb->query($query);
        return true;
	}
    
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblClient ORDER BY fldClientFirstName";
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
		
		$query = "SELECT * FROM ".$table_prefix."_tblClient ORDER BY fldClientFirstName";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countClient() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblClient";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function countClientEmail($email) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblClient WHERE fldClientEmail='$email'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function findClientByEmail($email){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblClient WHERE fldClientEmail='$email'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	function checkLogin($client) {	
		global $adb;
		global $table_prefix;
		
		$username  = $client->username;
		$password  = $client->password;
		
		$query = "SELECT * FROM ".$table_prefix."_tblClient WHERE fldClientUsername='$username' AND fldClientPassword='$password'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	 function getInfo($client){
        global $adb;
		global $table_prefix;
		
        $username  = $client->username;
		$password  = $client->password;
		
		$query = "SELECT * FROM ".$table_prefix."_tblClient WHERE fldClientUsername='$username' AND fldClientPassword='$password'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
    function findClient($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblClient WHERE fldClientID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	
	
	   
    function deleteClient($id){        
        global $adb;
		global $table_prefix;
        
        $query = "DELETE FROM ".$table_prefix."_tblClient WHERE fldClientID='$id'";
        $adb->query($query);
        return true;
    }
    
    
}
?>
