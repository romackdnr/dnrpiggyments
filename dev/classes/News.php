<?
   
class News{
   
    function addNews($news){
        global $adb;
		global $table_prefix;
		
		$description = addslashes($news->description);
		$name = addslashes($news->name);
		
	
        $query="INSERT INTO ".$table_prefix."_tblNews SET ".
            "fldNewsTitle='$name',".
			"fldNewsDescription='$description',".				
            "fldNewsDate='$news->date_news'";
        $adb->query($query);
        return true;
    }
	
	function updateNews($news) {
		 global $adb;
		 global $table_prefix;
		 
		$description = addslashes($news->description);
		$name = addslashes($news->name);
		
		
			$query="UPDATE ".$table_prefix."_tblNews SET ".
				"fldNewsTitle='$name',".
				"fldNewsDescription='$description',".					
	            "fldNewsDate='$news->date_news'".
           		 " WHERE fldNewsID=$news->Id";
	    $adb->query($query);
        return true;
	}
    
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblNews";
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
		
		$query = "SELECT * FROM ".$table_prefix."_tblNews ORDER BY fldNewsTitle";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countNews() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblNews";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findNews($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblNews WHERE fldNewsID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deleteNews($id){        
        global $adb;
		global $table_prefix;
        
        $query = "DELETE FROM ".$table_prefix."_tblNews WHERE fldNewsID='$id'";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
