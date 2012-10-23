<?
class Administrator{
  
    function addAdministrator($administrator){
        global $adb;
		global $table_prefix;
		
		$password = md5($administrator->password);
        $query="INSERT INTO ".$table_prefix."_tblAdministrator SET ".
            "fldAdministratorusername='$administrator->username',".				
            "fldAdministratorPassword='$password',".
			"fldAdministratorEmail='$administrator->email',".
            "fldAdministratorRealName='$administrator->real_name'";
        $adb->query($query);
        return true;
    }
	
	function addAdministratorSite($administrator){
        global $adb;
		global $table_prefix;
		
		$password = md5($administrator->password);
		$about = addslashes($administrator->about);
        $query="INSERT INTO ".$table_prefix."_tblAdministrator SET ".
            "fldAdministratorRealName='$administrator->real_name',".				
			"fldAdministratorusername='$administrator->username',".				
            "fldAdministratorPassword='$password',".
			"fldAdministratorEmail='$administrator->email',".
			"fldAdministratorPhone='$administrator->phone',".			
			"fldAdministratorSitename='$administrator->sitename',".
			"fldAdministratorBlog='$administrator->blog',".
			"fldAdministratorFaceBook='$administrator->facebook',".
			"fldAdministratorTwitter='$administrator->twitter',".
			"fldAdministratorLinkedin='$administrator->linkedin',".			
            "fldAdministratorAbout='$about'";
        $adb->query($query);
        return true;
    }
	
	function updateAdministratorSite($administrator){
        global $adb;
		global $table_prefix;
		
		$about = addslashes($administrator->about);
		
		if($administrator->password == "") {
			$query="UPDATE ".$table_prefix."_tblAdministrator SET ".
				"fldAdministratorRealName='$administrator->real_name',".				
				"fldAdministratorusername='$administrator->username',".				
				"fldAdministratorEmail='$administrator->email',".
				"fldAdministratorPhone='$administrator->phone',".			
				"fldAdministratorSitename='$administrator->sitename',".
				"fldAdministratorBlog='$administrator->blog',".
				"fldAdministratorFaceBook='$administrator->facebook',".
				"fldAdministratorTwitter='$administrator->twitter',".
				"fldAdministratorLinkedin='$administrator->linkedin',".			
				"fldAdministratorAbout='$about'".
            " WHERE fldAdministratorID=$administrator->Id";
		} else {		
			$password = md5($administrator->password);						
        	$query="UPDATE ".$table_prefix."_tblAdministrator SET ".
				"fldAdministratorRealName='$administrator->real_name',".				
				"fldAdministratorusername='$administrator->username',".				
				"fldAdministratorPassword='$password',".
				"fldAdministratorEmail='$administrator->email',".
				"fldAdministratorPhone='$administrator->phone',".			
				"fldAdministratorSitename='$administrator->sitename',".
				"fldAdministratorBlog='$administrator->blog',".
				"fldAdministratorFaceBook='$administrator->facebook',".
				"fldAdministratorTwitter='$administrator->twitter',".
				"fldAdministratorLinkedin='$administrator->linkedin',".			
				"fldAdministratorAbout='$about'".
            " WHERE fldAdministratorID=$administrator->Id";
		}
        $adb->query($query);
        return true;
    }
	
	
    function changePassword($id,$password){
        global $adb;
		global $table_prefix;
		
		
			$password = md5($password);
        	$query="UPDATE ".$table_prefix."_tblAdministrator SET ".
           
  	       "fldAdministratorPassword='$password'".
            " WHERE fldAdministratorID=$id";
		
        $adb->query($query);
        return true;
    }
	
	function updateAdministrator($administrator){
        global $adb;
		global $table_prefix;
		
		if($administrator->password == "") {
			$query="UPDATE ".$table_prefix."_tblAdministrator SET ".
           "fldAdministratorusername='$administrator->username',". 			
		   "fldAdministratorEmail='$administrator->email',".
           "fldAdministratorRealName='$administrator->real_name'".
            " WHERE fldAdministratorID=$administrator->Id";
		} else {
			$password = md5($administrator->password);
        	$query="UPDATE ".$table_prefix."_tblAdministrator SET ".
           "fldAdministratorusername='$administrator->username',". 			
		   "fldAdministratorEmail='$administrator->email',".
           "fldAdministratorRealName='$administrator->real_name',".
  	       "fldAdministratorPassword='$password'".
            " WHERE fldAdministratorID=$administrator->Id";
		}	
        $adb->query($query);
        return true;
    }
    function findAdministrator($id){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblAdministrator WHERE fldAdministratorID=$id";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	function findAdministratorLogin($admin){
        global $adb;
		global $table_prefix;
		
        $password = md5($admin->password);
        $query = "SELECT * FROM ".$table_prefix."_tblAdministrator WHERE fldAdministratorusername='$admin->username' AND fldAdministratorPassword='$password'";
		
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	function administratorLogin($admin){
        global $adb;
		global $table_prefix;
		
		$password = md5($admin->password);
        $query = "SELECT * FROM ".$table_prefix."_tblAdministrator WHERE fldAdministratorusername='$admin->username' AND fldAdministratorPassword='$password'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
    function findAdministratorByCondition($condition){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblAdministrator WHERE $condition";        
        $result=$adb->query($query);
        return $result->fetch_object();
    }
    function findAll($pg){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblAdministrator " ;        
        $result=$adb->query($query.$pg);
        $admins = array();
		while($row=$result->fetch_object()){
			$admins[]=$row;
		}
		return $admins;
    }
    function findAllAdministratorByCondition($condition){
        global $adb;
		global $table_prefix;
		
		
        $query = "SELECT * FROM ".$table_prefix."_tblAdministrator WHERE $condition";
        $result=$adb->query($query);
        $vendors = array();
		while($row=$result->fetch_object()){
			$vendors[]=$row;
		}
		return $vendors;		
    }
	
	
	
	function countAdministrator() {
		global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblAdministrator";
        $result=$adb->query($query);
		return $result->db_num_rows();
	}
    function deleteAdministrator($administrator_id){        
        global $adb;
		global $table_prefix;
		
        if($administrator_id==1){
            return false;//cannot delete main administrator account
        }
        $query = "DELETE FROM ".$table_prefix."_tblAdministrator WHERE fldAdministratorID=$administrator_id";
        $adb->query($query);
        return true;
    }
    
   function findAdministratorClient(){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblAdministrator WHERE fldAdministratorID!=1";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
	
	function findAdministratorByEmail($email){
        global $adb;
		global $table_prefix;
		
        $query = "SELECT * FROM ".$table_prefix."_tblAdministrator WHERE fldAdministratorEmail='$email'";
        $result=$adb->query($query);
        return $result->fetch_object();
    }
   
}
?>
