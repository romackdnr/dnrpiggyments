<?

class ForumReply{
   
    function addForum($forum){
        global $adb;
		global $table_prefix;
		
		$message = addslashes($forum->message);
		$title = addslashes($forum->title);
		$date = date('Y-m-d');
		$status = 1;

	
        $query="INSERT INTO ".$table_prefix."_tblForumReply SET ".
            "fldForumReplyDate='$date',".
			"fldForumReplyClientID='$forum->client_id',".
			"fldForumReplyCategoryID='$forum->forum_category_id',".
			"fldForumReplyClientName='$forum->client_name',".
			"fldForumReplyForumID='$forum->forum_id',".
			"fldForumReplyTitle='$title',".
			"fldForumReplyStatus='$status',".
            "fldForumReplyMessage='$message'";
        $adb->query($query);
        return true;
    }
		
    
	function findAll($pg,$id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForumReply  WHERE fldForumReplyClientID='$id' ORDER BY fldForumReplyID DESC";
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
		
		$query = "SELECT * FROM ".$table_prefix."_tblForumReply WHERE fldForumReplyClientID='$id'  ORDER BY fldForumReplyID DESC";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function displayForumbyTopic($id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForumReply WHERE fldForumReplyForumID='$id'  ORDER BY fldForumReplyID DESC";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function displayPendingReplybyTopic($id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForumReply WHERE fldForumReplyForumID='$id'  ORDER BY fldForumReplyID DESC";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countForumReplyByCategory($id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForumReply WHERE fldForumReplyCategoryID='$id'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function countForumReplyByTopic($id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForumReply WHERE fldForumReplyForumID='$id'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function countTopics($id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForumReply WHERE fldForumReplyForumID='$id'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findForum($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblForumReply WHERE fldForumReplyID=$id";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	
   
    function deleteForum($id){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblForumReply WHERE fldForumReplyID=$id";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
