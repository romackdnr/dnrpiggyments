<?

class Sitemap{
   
    function addSitemap($sitemap){
        global $adb;
		global $table_prefix;
		
		
			
        $query="INSERT INTO ".$table_prefix."_tblSitemap SET ".
            "fldSitemapLocation='$sitemap->location',".			
			"fldSitemapModification='$sitemap->modification',".			
			"fldSitemapChange='$sitemap->change',".
			"fldSitemapPriority='$sitemap->priority'";
			
        $adb->query($query);
        return true;
    }
	
	function updateSitemap($sitemap) {
		 global $adb;
		 global $table_prefix;
		 
		
			$query="UPDATE ".$table_prefix."_tblSitemap SET ".
				"fldSitemapLocation='$sitemap->location',".			
				"fldSitemapModification='$sitemap->modification',".			
				"fldSitemapChange='$sitemap->change',".
				"fldSitemapPriority='$sitemap->priority'".
           		 " WHERE fldsitemapID=$sitemap->Id";
	    $adb->query($query);
        return true;
	}
    
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblSitemap";
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
		
		$query = "SELECT * FROM ".$table_prefix."_tblSitemap ORDER BY fldsitemapID";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countSitemap() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblSitemap";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findSitemap($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblSitemap WHERE fldsitemapID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deleteSitemap($id){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblSitemap WHERE fldsitemapID='$id'";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
