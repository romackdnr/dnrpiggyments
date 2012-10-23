<?

class Connection{
        
   	function findConnection(){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM tblConnection";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
		     
}
?>
