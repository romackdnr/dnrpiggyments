<?
     
class PhotoGallery{
   
    function addPhotoGallery($photo,$image){
        global $adb;
		global $table_prefix;
		
		$name = addslashes($photo->name);
		$category = addslashes($photo->category);
		$description = addslashes($photo->description);
		
	
        $query="INSERT INTO ".$table_prefix."_tblPhotoGallery SET ".
            "fldPhotoGalleryName='$name',".
			"fldPhotoGalleryCategory='$category',".
			"fldPhotoGalleryDescription='$description',".
            "fldPhotoGalleryImage='$image'";
        $adb->query($query);
        return true;
    }
	
	function updatePhotoGallery($photo,$image) {
		 global $adb;
		 global $table_prefix;
		 
		$name = addslashes($photo->name);
		$category = addslashes($photo->category);
		$description = addslashes($photo->description);
		
		if($image == "") {
			$query="UPDATE ".$table_prefix."_tblPhotoGallery SET ".
			     "fldPhotoGalleryCategory='$category',".
				"fldPhotoGalleryDescription='$description',".
				 "fldPhotoGalleryName='$name'".	          
           		 " WHERE fldPhotoGalleryID=$photo->Id";
		} else {
			$query="UPDATE ".$table_prefix."_tblPhotoGallery SET ".
				 "fldPhotoGalleryName='$name',".
				 "fldPhotoGalleryCategory='$category',".
					"fldPhotoGalleryDescription='$description',".
	            "fldPhotoGalleryImage='$image'".
           		 " WHERE fldPhotoGalleryID=$photo->Id";
		}
	    $adb->query($query);
        return true;
	}
    
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblPhotoGallery";
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
		
		$query = "SELECT * FROM ".$table_prefix."_tblPhotoGallery ORDER BY fldPhotoGalleryName";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countPhotoGallery() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblPhotoGallery";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findPhotoGallery($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblPhotoGallery WHERE fldPhotoGalleryID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deletePhotoGallery($id){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblPhotoGallery WHERE fldPhotoGalleryID='$id'";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
