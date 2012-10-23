<?
    
class VideoGallery{
   
    function addVideoGallery($video,$image){
        global $adb;
		global $table_prefix;
		
		$name = addslashes($video->name);
		$category = addslashes($video->category);
		$description = addslashes($video->description);
		
	
        $query="INSERT INTO ".$table_prefix."_tblVideoGallery SET ".
            "fldVideoGalleryName='$name',".
			"fldVideoGalleryCategory='$category',".
			"fldVideoGalleryDescription='$description',".
            "fldVideoGalleryImage='$image'";
        $adb->query($query);
        return true;
    }
	
	function updateVideoGallery($video,$image) {
		 global $adb;
		 global $table_prefix;
		 
		$name = addslashes($video->name);
		$category = addslashes($video->category);
		$description = addslashes($video->description);
		if($image == "") {
			$query="UPDATE ".$table_prefix."_tblVideoGallery SET ".
			     "fldVideoGalleryCategory='$category',".
				  "fldVideoGalleryDescription='$description',".
				 "fldVideoGalleryName='$name'".	            
           		 " WHERE fldVideoGalleryID=$video->Id";
		} else {
			$query="UPDATE ".$table_prefix."_tblVideoGallery SET ".
				 "fldVideoGalleryName='$name',".
				 "fldVideoGalleryCategory='$category',".
				"fldVideoGalleryDescription='$description',".
	            "fldVideoGalleryImage='$image'".
           		 " WHERE fldVideoGalleryID=$video->Id";
		}
	    $adb->query($query);
        return true;
	}
    
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblVideoGallery";
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
		
		$query = "SELECT * FROM ".$table_prefix."_tblVideoGallery ORDER BY fldVideoGalleryName";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countVideoGallery() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblVideoGallery";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findVideoGallery($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblVideoGallery WHERE fldVideoGalleryID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deleteVideoGallery($id){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblVideoGallery WHERE fldVideoGalleryID='$id'";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
