<?
	
class Forum{
   
    function addForum($forum){
        global $adb;
		global $table_prefix;
		
		$content = addslashes($forum->content);
		$title = addslashes($forum->title);
		$date = date('Y-m-d');

	
        $query="INSERT INTO ".$table_prefix."_tblForum SET ".
            "fldForumDate='$date',".
			"fldForumClientID='$forum->client_id',".
			"fldForumCategoryID='$forum->category_id',".
			"fldForumClientName='$forum->client_name',".			
			"fldForumTitle='$title',".			
            "fldForumContent='$content'";
        $adb->query($query);
        return true;
    }
	
	function updateForum($forum) {
		 global $adb;
		 global $table_prefix;
		 
		$content = addslashes($forum->content);
		$title = addslashes($forum->title);
		
			$query="UPDATE ".$table_prefix."_tblForum SET ".            		
			"fldForumCategoryID='$forum->category_id',".			
			"fldForumTitle='$title',".			
            "fldForumContent='$content'".
            " WHERE fldForumID=$forum->Id";
	    $adb->query($query);
        return true;
	}
	
	function updateForumCount($countViews,$id) {
		 global $adb;
		 global $table_prefix;
		
			$query="UPDATE ".$table_prefix."_tblForum SET ".            		
            "fldForumCountView='$countViews'".
            " WHERE fldForumID='$id'";
	    $adb->query($query);
        return true;
	}
    
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForum  ORDER BY fldForumID DESC";
		$result = $adb->query($query.$pg);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function findAllbyClient($pg,$id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForum  WHERE fldForumClientID='$id' ORDER BY fldForumID DESC";
		$result = $adb->query($query.$pg);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countForumbyClient($id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForum WHERE fldForumClientID='$id'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function displayAll($id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForum WHERE fldForumCategoryID='$id' ORDER BY fldForumID DESC";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function displayForumHome() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForum ORDER BY fldForumID DESC LIMIT 3";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countForum() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForum";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function countForumHome() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForum";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function findAllHome($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForum ORDER BY fldForumDate DESC";
		$result = $adb->query($query.$pg);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countTopics($id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForum WHERE fldForumCategoryID='$id'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findForum($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblForum WHERE fldForumID=$id";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	function findLastPostForum($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblForum WHERE fldForumCategoryID='$id' ORDER BY fldForumID DESC";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deleteForum($id){        
        global $adb;
		global $table_prefix;		
        
        $query = "DELETE FROM ".$table_prefix."_tblForum WHERE fldForumID=$id";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
