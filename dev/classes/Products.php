<?

class Products{
     
    function addProducts($products,$image){
        global $adb;
		global $table_prefix;
		
		$content = addslashes($products->content);		
		$name = addslashes($products->name);
		$overview = addslashes($products->overview);
		$information = addslashes($products->information);
		
        $query="INSERT INTO ".$table_prefix."_tblProducts SET ".           			
			"fldProductsCategoryID='$products->category_id',". 			
			"fldProductsName='$name',".
			"fldProductsAvailability='$products->isAvailable',". 
			"fldProductsPosition='$products->position',". 
			"fldProductsFeatured='$products->isFeatured',". 
			"fldProductsPrice='$products->price',". 				
			"fldProductsWeight='$products->weight',". 				
			"fldProductsInformation='$information',".
			"fldProductsOverview='$overview',".
			"fldProductsImage='$image',".
            "fldProductsDescription='$content'";
        $adb->query($query);
        return mysql_insert_id();
    }
	
	function updateProducts($products,$image) {
		 global $adb;
		 global $table_prefix;
		 
		$content = addslashes($products->content);		
		$name = addslashes($products->name);
		$overview = addslashes($products->overview);
		$information = addslashes($products->information);
		
		if($image == "") {
			$query="UPDATE ".$table_prefix."_tblProducts SET ".
           "fldProductsCategoryID='$products->category_id',". 			
			"fldProductsName='$name',".
			"fldProductsPosition='$products->position',". 
			"fldProductsAvailability='$products->isAvailable',". 
			"fldProductsFeatured='$products->isFeatured',".
			"fldProductsPrice='$products->price',". 		
			"fldProductsWeight='$products->weight',". 				
            "fldProductsOverview='$overview',".
			"fldProductsInformation='$information',".
			"fldProductsDescription='$content'".
            " WHERE fldProductsId=$products->Id";
		} else {
			$query="UPDATE ".$table_prefix."_tblProducts SET ".
        	"fldProductsCategoryID='$products->category_id',". 			
			"fldProductsName='$name',".
			"fldProductsPosition='$products->position',". 
			"fldProductsAvailability='$products->isAvailable',". 
			"fldProductsFeatured='$products->isFeatured',".
			"fldProductsPrice='$products->price',". 		
			"fldProductsWeight='$products->weight',". 				
			"fldProductsImage='$image',".
			"fldProductsOverview='$overview',".
			"fldProductsInformation='$information',".
            "fldProductsDescription='$content'".
            " WHERE fldProductsId=$products->Id";
		}
	    $adb->query($query);
        return true;
	}
    
	function findAll($pg) {
		global $adb;
		global $table_prefix;

		$query = "SELECT * FROM ".$table_prefix."_tblProducts  ORDER BY fldProductsPosition";
		$result = $adb->query($query.$pg);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function findAllByCategory($pg,$category_id) {
		global $adb;
		global $table_prefix;

		$query = "SELECT * FROM ".$table_prefix."_tblProducts WHERE fldProductsCategoryID='$category_id' ORDER BY fldProductsPosition";
		//$query = "SELECT * FROM ".$table_prefix."_tblProducts WHERE fldProductsCategoryID='$category_id' ORDER BY fldProductsName";
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

		$query = "SELECT * FROM ".$table_prefix."_tblProducts ORDER BY fldProductsName LIMIT 8";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	
	
	function displayAllProducts() {
		global $adb;
		global $table_prefix;

		$query = "SELECT * FROM ".$table_prefix."_tblProducts  ORDER BY fldProductsName";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function displayAllFeaturedProducts() {
		global $adb;
		global $table_prefix;
		$featured = 1;
		$query = "SELECT * FROM ".$table_prefix."_tblProducts WHERE fldProductsFeatured='$featured' ORDER BY fldProductsName";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countProducts() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblProducts";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function countProductsByCategory($category) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblProducts WHERE fldProductsCategoryID='$category'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
    function findProducts($id){
        global $adb;
		global $table_prefix;

        $query = "SELECT * FROM ".$table_prefix."_tblProducts WHERE fldProductsId={$id}";
        
        $result=$adb->query($query);
        
        return $result->fetch_object();
    }
	
	 function findProductsRecommended($id,$category_id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblProducts WHERE fldProductsId!={$id} AND fldProductsCategoryID='$category_id' ORDER BY rand()";
        $result=$adb->query($query);

        return $result->fetch_object();
    }
   
    function deleteProducts($id){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblProducts WHERE fldProductsId={$id}";
        $adb->query($query);
        return true;
    }
    
   
   
}
?>
