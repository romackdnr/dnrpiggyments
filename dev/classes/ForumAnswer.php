<?
  
class ForumAnswer{
   
    function addForum($forum){
        global $adb;
		global $table_prefix;

		$content = addslashes($forum->content);
		$title = addslashes($forum->title);
		$date = date('Y-m-d');
		$status = 0;
	
        $query="INSERT INTO ".$table_prefix."_tblForumAnswer SET ".
            "fldForumAnswerDate='$date',".
			"fldForumAnswerClientID='$forum->client_id',".			
			"fldForumAnswerClientName='$forum->client_name',".
			"fldForumAnswerForumID='$forum->forum_id',".
			"fldForumAnswerReplyID='$forum->reply_id',".
			"fldForumAnswerTitle='$title',".			
            "fldForumAnswerContent='$content'";
        $adb->query($query);
        return true;
    }
	
	
	function findAll($pg,$id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForumAnswer  WHERE fldForumAnswerReplyID='$id' ORDER BY fldForumAnswerID DESC";
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
		
		$query = "SELECT * FROM ".$table_prefix."_tblForumAnswer WHERE fldForumAnswerReplyID='$id'  ORDER BY fldForumAnswerID DESC";
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
		
		$query = "SELECT * FROM ".$table_prefix."_tblForumAnswer WHERE fldForumAnswerReplyID='$id'  ORDER BY fldForumAnswerID DESC";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	
	
	
	
	function countTopics($id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblForumAnswer WHERE fldForumAnswerReplyID='$id'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findForum($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblForumAnswer WHERE fldForumAnswerID=$id";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	
   
    function deleteForum($id){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblForumAnswer WHERE fldForumAnswerID=$id";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
