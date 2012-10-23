<?
   
class Blogs{
   
    function addBlogs($blogs){
        global $adb;
		global $table_prefix;
		
		$description = addslashes($blogs->description);
		$name = addslashes($blogs->name);
		$author = addslashes($blogs->author);
		$category = addslashes($blogs->category);
		$tags = addslashes($blogs->tags);
	
        $query="INSERT INTO ".$table_prefix."_tblBlogs SET ".
            "fldBlogsName='$name',".
			"fldBlogsDescription='$description',".	
			"fldBlogsAuthor='$author',".	
			"fldBlogsCategory='$category',".	
			"fldBlogsTags='$tags',".	
            "fldBlogsDate='$blogs->blogs_date'";
        $adb->query($query);
        return true;
    }
	
	function updateBlogs($blogs) {
		 global $adb;
		 global $table_prefix;
		 
		$description = addslashes($blogs->description);
		$name = addslashes($blogs->name);
		$author = addslashes($blogs->author);
		$category = addslashes($blogs->category);
		$tags = addslashes($blogs->tags);
		
			$query="UPDATE ".$table_prefix."_tblBlogs SET ".
				"fldBlogsName='$name',".
				"fldBlogsDescription='$description',".	
				"fldBlogsAuthor='$author',".	
				"fldBlogsCategory='$category',".	
				"fldBlogsTags='$tags',".
	            "fldBlogsDate='$blogs->blogs_date'".
           		 " WHERE fldBlogsID=$blogs->Id";
	    $adb->query($query);
        return true;
	}
    
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblBlogs";
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
		
		$query = "SELECT * FROM ".$table_prefix."_tblBlogs ORDER BY fldBlogsName";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countBlogs() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblBlogs";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findBlogs($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblBlogs WHERE fldBlogsID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deleteBlogs($id){        
        global $adb;
		global $table_prefix;
        
        $query = "DELETE FROM ".$table_prefix."_tblBlogs WHERE fldBlogsID='$id'";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
