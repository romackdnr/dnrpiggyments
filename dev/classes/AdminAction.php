<?

class AdminAction{
   
    function addAdminAction($username,$updates){
        global $adb;
		global $table_prefix;
		
		$date = date('Y-m-d g:i:s');
				
        $query="INSERT INTO ".$table_prefix."_tblAction SET ".
            "fldActionUsername='$username',".			
			"fldActionUpdates='$updates',".			
			"fldActionDateTime='$date'";
        $adb->query($query);
        return true;
    }
	
	    
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblAction";
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
		
		$query = "SELECT * FROM ".$table_prefix."_tblAction ORDER BY fldActionDateTime DESC LIMIT 2";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countAction() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblAction";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findAction($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblAction WHERE fldActionID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deleteAction($id){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblAction WHERE fldActionID='$id'";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
