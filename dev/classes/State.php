<?

class State{
        
   	function findAll() {
		global $adb;
		$query = "SELECT * FROM tstate ORDER BY tStateName";
		$result = $adb->query($query);
		$testi = array();
		while($row=$result->fetch_object()){
			$testi[]=$row;
		}
		return $testi;
	}
	
	function findState($state){
        global $adb;
        $query = "SELECT * FROM tstate WHERE tStateID='$state'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	  
   
}
?>
