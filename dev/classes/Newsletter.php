<?
class Newsletter{

    function addNewsletter($newsletter){
        global $adb;
		global $table_prefix;
		
		$message = addslashes($newsletter->message);
		$name = addslashes($newsletter->name);
        $query="INSERT INTO ".$table_prefix."_tblNewsletter SET ".
            "fldNewsletterName='$name',".           
            "fldNewsletterDescription='$message'";
        $adb->query($query);
        return true;
    }
	
	function updateNewsletter($newsletter) {
		 global $adb;
		 global $table_prefix;
		 
		$message = addslashes($newsletter->message);
		$name = addslashes($newsletter->name);	
			$query="UPDATE ".$table_prefix."_tblNewsletter SET ".
           "fldNewsletterName='$name',".           
            "fldNewsletterDescription='$message'".		
            " WHERE fldNewsletterID=$newsletter->Id";				
	    $adb->query($query);
        return true;
	}
    
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblNewsletter";
		$result = $adb->query($query.$pg);
		$newsletter = array();
		while($row=$result->fetch_object()){
			$newsletter[]=$row;
		}
		return $newsletter;
	}
	
	function countNewsletter() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblNewsletter";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findNewsletter($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblNewsletter WHERE fldNewsletterID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deleteNewsletter($id){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblNewsletter WHERE fldNewsletterID='$id'";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
