<?

class ForumCategory{
     
    function addForumCategory($forum){
        global $adb;
		global $table_prefix;
		
		$content = addslashes($forum->content);		
		$title = addslashes($forum->title);
		
        $query="INSERT INTO ".$table_prefix."_tblForumCategory SET ".           			
			"fldForumCategoryTitle='$title',". 		
			"fldForumCategoryMainCatID='$forum->MainCatID',". 		
            "fldForumCategoryContent='$content'";
        $adb->query($query);
        return true;
    }
	
	function updateForumCategory($forum) {
		 global $adb;
		 global $table_prefix;
		 
		$content = addslashes($forum->content);		
		$title = addslashes($forum->title);
		
			$query="UPDATE ".$table_prefix."_tblForumCategory SET ".
            "fldForumCategoryTitle='$title',". 		
			"fldForumCategoryMainCatID='$forum->MainCatID',".
            "fldForumCategoryContent='$content'".
            " WHERE fldForumCategoryID=$forum->Id";
	    $adb->query($query);
        return true;
	}
    
	function findAll($pg,$id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForumCategory WHERE fldForumCategoryMainCatID='$id' ORDER BY fldForumCategoryTitle";
		$result = $adb->query($query.$pg);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function displayAll($id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForumCategory WHERE fldForumCategoryMainCatID='$id' ORDER BY fldForumCategoryTitle";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	
	
	function countForumCategory($id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForumCategory WHERE fldForumCategoryMainCatID='$id'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findForumCategory($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblForumCategory WHERE fldForumCategoryID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deleteForumCategory($id){        
        global $adb;
		global $table_prefix;
        
        $query = "DELETE FROM ".$table_prefix."_tblForumCategory WHERE fldForumCategoryID='$id'";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
