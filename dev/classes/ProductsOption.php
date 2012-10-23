<?
class ProductsOption{
     
    function addProductsOption($category_id,$option_id,$product_id){
        global $adb;
		global $table_prefix;
		
        $query="INSERT INTO ".$table_prefix."_tblProductsOption SET ".           						
			"fldProductsOptionCategoryId='{$category_id}',".
			"fldProductsOptionMainId='{$option_id}',".
			"fldProductsOptionProductsId='{$product_id}'";

        $adb->query($query);
        return true;
    }
	
	function updateProductsOptions($options) {
		 global $adb;
		 global $table_prefix;
	
		$amount = addslashes($options->amount);
		
			$query="UPDATE ".$table_prefix."_tblProductsOption SET ".
          		 "fldProductsOptionAmount='$amount'". 			
            " WHERE fldProductsOptionID=$options->Id";
		
	    $adb->query($query);
        return true;
	}
	
	function findAll($pg,$product_id) {
		global $adb;
		global $table_prefix;

		$query = "SELECT * FROM ".$table_prefix."_tblProductsOption WHERE fldProductsOptionProductsId='$product_id'";
		$result = $adb->query($query.$pg);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function countProductOptions($product_id,$option_id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblProductsOption WHERE fldProductsOptionProductsId='$product_id' AND fldProductsOptionMainId='$option_id'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function countProductOptionsByProducts($product_id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblProductsOption WHERE fldProductsOptionProductsId='$product_id'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function countProductOptionsByCategory($product_id,$category_id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblProductsOption WHERE fldProductsOptionProductsId='$product_id' AND fldProductsOptionCategoryId='$category_id'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
	function displayAllProductOptionsCategory($product_id,$category_id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblProductsOption WHERE fldProductsOptionProductsId='$product_id' AND fldProductsOptionCategoryId='$category_id'";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
    function findProductsOptionByCategory($category_id,$product_id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblProductsOption WHERE fldProductsOptionCategoryId='$category_id' AND fldProductsOptionProductsId='$product_id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	function findProductsOption($id,$product_id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblProductsOption WHERE fldProductsOptionID='$id' AND fldProductsOptionProductsId='$product_id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
    function deleteProductsOption($product_id, $category_id = null, $option_id = null){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblProductsOption WHERE fldProductsOptionProductsId='{$product_id}'";
        if(!is_null($category_id)) $query .= " AND fldProductsOptionCategoryId = '{$category_id}'";
        if(!is_null($option_id)) $query .= " AND fldProductsOptionMainId = '{$option_id}'";
        $adb->query($query);

        error_log("Removed Option ProductID(" . $product_id . ") - CategoryId(" . $category_id . ") - OptionId(" . $option_id . ")");

        return true;
    }
	
	function deleteProductsOptionByOptions($id){        
        global $adb;
        global $table_prefix;
		
        $query = "DELETE FROM ".$table_prefix."_tblProductsOption WHERE fldProductsOptionID='$id'";
        $adb->query($query);
        return true;
    }
	
	function findProductsOptionCart($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblProductsOption WHERE fldProductsOptionID='$id'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }

	function isOptionSettingExists($product_id, $category_id, $option_id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblProductsOption WHERE " .
        	"fldProductsOptionCategoryId = '$category_id' " .
        	"AND fldProductsOptionProductsId = '$product_id' " .
        	"AND fldProductsOptionMainId = '$option_id'";

        $result = $adb->query($query);
        return ($result->num_rows() > 0);
    }

    function getProductOptions($product_id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblProductsOption WHERE fldProductsOptionProductsId='{$product_id}'";

		$result = $adb->query($query);

		$ret_val = array();
        if($result->num_rows() > 0){
        	while($row = $result->fetch_assoc()){
        		$ret_val[] = $row;
        	}
        }

        return $ret_val;
	}

	function getProductOptionsByCategory($category_id, $product_id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT fldProductsOptionMainId FROM ".$table_prefix."_tblProductsOption WHERE ".
        	"fldProductsOptionCategoryId='$category_id' ".
        	"AND fldProductsOptionProductsId='$product_id'";

        $result=$adb->query($query);

        $ret_val = array();
        if($result->num_rows() > 0){
        	while($row = $result->fetch_assoc()){
        		$ret_val[] = $row['fldProductsOptionMainId'];
        	}
        }

        return $ret_val;
    }

    /**
    * Traverse List if an option is in the List
    */
    function isOptionInOptionList($option, $list)
    {
    	if(empty($list)){ 
    		return false; 
    	}
    	if(is_null($option)){ 
    		return false; 
    	}
    	if(is_null($option['fldProductsOptionProductsId'])){ 
    		return false; 
    	}
    	foreach ($list as $item)
    	{
    		if(
    			($option['fldProductsOptionProductsId'] 	== $item['fldProductsOptionProductsId'])
    			&& ($option['fldProductsOptionCategoryId'] 	== $item['fldProductsOptionCategoryId'])
    			&& ($option['fldProductsOptionMainId'] 		== $item['fldProductsOptionMainId'])
    			)
    		{
    			return true;
    		}
    	}

    	return false;
    }
}

?>