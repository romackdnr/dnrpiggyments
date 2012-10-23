<?

class Category{
     
    function addCategory($category){
        global $adb;
		global $table_prefix;
		

		$name = addslashes($category->name);
		
        $query="INSERT INTO ".$table_prefix."_tblCategory SET ".           			
			"fldCategoryMainCatID='$category->MainCatID',". 
			"fldCategoryPosition='$category->position',". 
			"fldCategoryName='$name'"; 			
			
        $adb->query($query);
        return true;
    }
	
	function updateCategory($category) {
		 global $adb;
		 global $table_prefix;
		 
		$name = addslashes($category->name);
		

			$query="UPDATE ".$table_prefix."_tblCategory SET ".
             "fldCategoryMainCatID='$category->MainCatID',".
			 "fldCategoryPosition='$category->position',". 
			 "fldCategoryName='$name'". 						

            " WHERE fldCategoryID=$category->Id";
	    $adb->query($query);
        return true;
	}
    
	function findAll($pg,$category_id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblCategory WHERE fldCategoryMainCatID='$category_id'";
		$result = $adb->query($query.$pg);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	
	function displayAllCategory($category_id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblCategory WHERE fldCategoryMainCatID='$category_id' ORDER BY fldCategoryPosition";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countCategory($category_id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblCategory WHERE fldCategoryMainCatID='$category_id'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findCategory($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblCategory WHERE fldCategoryID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deleteCategory($id){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblCategory WHERE fldCategoryID='$id'";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
