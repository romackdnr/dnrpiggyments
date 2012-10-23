<?
   
class Testimonials{
   
    function addTestimonials($testimonials){
        global $adb;
		global $table_prefix;
		
		$description = addslashes($testimonials->description);
		$name = addslashes($testimonials->name);
		
	
        $query="INSERT INTO ".$table_prefix."_tblTestimonials SET ".
            "fldTestimonialsName='$name',".
			"fldTestimonialsDescription='$description',".				
            "fldTestimonialsWebsite='$testimonials->website'";
        $adb->query($query);
        return true;
    }
	
	function updateTestimonials($testimonials) {
		 global $adb;
		 global $table_prefix;
		 
		$description = addslashes($testimonials->description);
		$name = addslashes($testimonials->name);
		
		
			$query="UPDATE ".$table_prefix."_tblTestimonials SET ".
				"fldTestimonialsName='$name',".
				"fldTestimonialsDescription='$description',".					
	            "fldTestimonialsWebsite='$testimonials->website'".
           		 " WHERE fldTestimonialsID=$testimonials->Id";
	    $adb->query($query);
        return true;
	}
    
	function findAll($pg) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblTestimonials";
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
		
		$query = "SELECT * FROM ".$table_prefix."_tblTestimonials ORDER BY fldTestimonialsName";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countTestimonials() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblTestimonials";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function findTestimonialsHome(){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblTestimonials ORDER BY fldTestimonialsID DESC";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
    function findTestimonials($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblTestimonials WHERE fldTestimonialsID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deleteTestimonials($id){        
        global $adb;
		global $table_prefix;
        
        $query = "DELETE FROM ".$table_prefix."_tblTestimonials WHERE fldTestimonialsID='$id'";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
