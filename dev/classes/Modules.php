<?

class Modules{
   
  
	function countModules($module_id) {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM ".$table_prefix."_tblModules WHERE fldModulesNameID ='$module_id'";
		$result = $adb->query($query);
		return $result->db_num_rows();
		
	}
	
   
    
   
   
}
?>
