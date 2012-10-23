<?

class Country{
        
   	function findAll() {
		global $adb;
		global $table_prefix;
		
		$query = "SELECT * FROM tcountry ORDER BY country_name";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
		     
}
?>
