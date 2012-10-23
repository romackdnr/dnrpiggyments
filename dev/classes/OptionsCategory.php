<?

class OptionsCategory{
     
    function addOptionsCategory($category){
        global $adb;
		global $table_prefix;
		

		$name = addslashes($category->name);
		
        $query="INSERT INTO ".$table_prefix."_tblOptionsCategory SET ".           						
			"fldOptionsCategoryName='$name'"; 						
        $adb->query($query);
        return true;
    }
	
	function updateOptionsCategory($category) {
		 global $adb;
		 global $table_prefix;
		 
		$name = addslashes($category->name);
		

			$query="UPDATE ".$table_prefix."_tblOptionsCategory SET ".
			 "fldOptionsCategoryName='$name'". 						

            " WHERE fldOptionsCategoryID=$category->Id";
	    $adb->query($query);
        return true;
	}
    
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblOptionsCategory ORDER BY fldOptionsCategoryName";
		$result = $adb->query($query.$pg);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	
	function displayAllOptionsCategory() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblOptionsCategory ORDER BY fldOptionsCategoryName";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countOptionsCategory() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblOptionsCategory";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findOptionsCategory($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblOptionsCategory WHERE fldOptionsCategoryID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deleteOptionsCategory($id){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblOptionsCategory WHERE fldOptionsCategoryID='$id'";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
