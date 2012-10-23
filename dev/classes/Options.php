<?

class Options{
     
    function addOptions($options){
        global $adb;
		global $table_prefix;
		

		$name = htmlentities($options->name, ENT_QUOTES);
		
        $query="INSERT INTO ".$table_prefix."_tblOptions SET ".           						
			"fldOptionsCategoryId='$options->category_id',".
			"fldOptionsPosition='$options->position',".
			"fldOptionsName='$name'"; 						
        $adb->query($query);
        return true;
    }
	
	function updateOptions($options) {
		 global $adb;
		 global $table_prefix;
		 
		$name = htmlentities($options->name, ENT_QUOTES);

			$query="UPDATE ".$table_prefix."_tblOptions SET ".
			 "fldOptionsName='$name',". 						
			 "fldOptionsPosition='$options->position'".
            " WHERE fldOptionsID=$options->Id";
	    $adb->query($query);
        return true;
	}
    
	function findAll($pg,$category_id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblOptions WHERE fldOptionsCategoryId='$category_id' ORDER BY fldOptionsPosition";
		$result = $adb->query($query.$pg);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	
	function displayAllOptions($category_id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblOptions WHERE fldOptionsCategoryId='$category_id' ORDER BY fldOptionsPosition";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countOptions($category_id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblOptions WHERE fldOptionsCategoryId='$category_id'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findOptions($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblOptions WHERE fldOptionsID='$id'";
        error_log($query);

        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deleteOptions($id){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblOptions WHERE fldOptionsID='$id'";
        $adb->query($query);
        return true;
    }
    
}
?>