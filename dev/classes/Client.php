<?
class Client {

    function addClient($client){

        global $adb;
		global $table_prefix;		

		$firstname = addslashes($client->firstname);

		$lastname = addslashes($client->lastname);		
		$password = $client->password;

		$date = date('Y-m-d');		

        $query="INSERT INTO ".$table_prefix."_tblClient SET ".
            "fldClientUsername='$client->username',". 
			"fldClientPassword='$password',". 
			"fldClientLastname='$lastname',". 
			"fldClientFirstName='$firstname',". 
			"fldClientEmail='$client->email',".	
			"fldClientRegDate='$date'";             

        $adb->query($query);

        return mysql_insert_id();
    }

	function updateClient($client) {
		 global $adb;
		 global $table_prefix;
		$firstname = addslashes($client->fldClientFirstName);
		$lastname = addslashes($client->fldClientLastname);
		$query = "UPDATE ".$table_prefix."_tblClient SET ".	 
			"fldClientLastname='{$lastname}',". 
			"fldClientFirstName='{$firstname}',".
			"fldClientEmail='{$client->fldClientEmail}',".
			"fldClientUsername='{$client->fldClientUsername}'".
            " WHERE fldClientID={$client->fldClientID}";
	    $adb->query($query);

        return true;
	}	

	function changePassword($client) {
		global $adb;
		global $table_prefix;
		$password = $client->password;
			$query="UPDATE ".$table_prefix."_tblClient SET ".
			"fldClientPassword='{$client->fldClientPassword}'". 
            " WHERE fldClientID={$client->fldClientID}";

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

	function countClientUsername($username) {
		global $adb;
		global $table_prefix;
		$query = "SELECT * FROM ".$table_prefix."_tblClient WHERE fldClientUsername='$username'";
		$result = $adb->query($query);
		return $result->db_num_rows();
	}

	function findClientByEmail($email){
        global $adb;
		global $table_prefix;
        $query = "SELECT * FROM ".$table_prefix."_tblClient WHERE fldClientEmail LIKE '{$email}'";
        $result = $adb->query($query);
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

    /**
    * checks if the username is unique
    */
    function isUniqueUsername($username, $current_user_id)
    {
	    global $adb;
		global $table_prefix;
        $query = "SELECT * FROM ".$table_prefix."_tblClient ".
        	"WHERE fldClientUsername LIKE '{$username}' ".
        	"AND fldClientId != {$current_user_id}";
        $result = $adb->query($query);

        return ($result->num_rows() == 0);
    }

    /**
    * checks if the email is unique
    */
    function isUniqueEmail($email, $current_user_id)
    {
	    global $adb;
		global $table_prefix;
        $query = "SELECT * FROM ".$table_prefix."_tblClient ".
        	"WHERE fldClientEmail LIKE '{$email}' ".
        	"AND fldClientId != {$current_user_id}";
        $result = $adb->query($query);

        return ($result->num_rows() == 0);
    }

}

?>