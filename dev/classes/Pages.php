<?

class Pages{
   
    function addPages($pages){
        global $adb;
		global $table_prefix;
		
		$content = addslashes($pages->content);
		$name = addslashes($pages->name);		
		$navigation = addslashes($pages->navigation);
		$date = date('Y-m-d');
		$google_meta = addslashes($pages->google_meta);
		$google_analytics = addslashes($pages->google_analytics);
		$meta_title = addslashes($pages->meta_title);
		$meta_keywords = addslashes($pages->meta_keywords);
		$meta_description = addslashes($pages->meta_description);
		
			
        $query="INSERT INTO ".$table_prefix."_tblPages SET ".
            "fldPagesName='$name',".			
			"fldPagesNavigation='$navigation',".			
			"fldPagesDateModified='$date',".
			"fldPagesGoogleMetaTags='$google_meta',".
			"fldPagesGoogleMetaAnalytics='$google_analytics',".			
			"fldPagesMetaTitle='$meta_title',".
			"fldPagesMetaDescription='$meta_description',".
			"fldPagesMetaKeywords='$meta_keywords',".			
            "fldPagesDescription='$content'";
        $adb->query($query);
        return true;
    }
	
	function updatePages($pages) {
		 global $adb;
		 global $table_prefix;
		 
		$content = addslashes($pages->content);
		$name = addslashes($pages->name);
		$title = addslashes($pages->title);
		$navigation = addslashes($pages->navigation);
		$date = date('Y-m-d');
		$google_meta = addslashes($pages->google_meta);
		$google_analytics = addslashes($pages->google_analytics);
		$meta_title = addslashes($pages->meta_title);
		$meta_keywords = addslashes($pages->meta_keywords);
		$meta_description = addslashes($pages->meta_description);
		
			$query="UPDATE ".$table_prefix."_tblPages SET ".
				"fldPagesName='$name',".
				"fldPagesTitle='$title',".
				"fldPagesNavigation='$navigation',".			
				"fldPagesDateModified='$date',".
				"fldPagesGoogleMetaTags='$google_meta',".
				"fldPagesGoogleMetaAnalytics='$google_analytics',".			
				"fldPagesMetaTitle='$meta_title',".
				"fldPagesMetaDescription='$meta_description',".
				"fldPagesMetaKeywords='$meta_keywords',".			
				"fldPagesDescription='$content'".
           		 " WHERE fldPagesID=$pages->Id";
	    $adb->query($query);
        return true;
	}
    
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblPages";
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
		
		$query = "SELECT * FROM ".$table_prefix."_tblPages ORDER BY fldPagesName";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countPages() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblPages";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findPages($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblPages WHERE fldPagesID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deletePages($id){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblPages WHERE fldPagesID='$id'";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
