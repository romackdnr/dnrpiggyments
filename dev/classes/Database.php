<?
class  MysqlResult {

	var $result = null;

	function MysqlResult($res)
	{
		$this->result = $res;
	}

	function fetch_array() {
        return @mysql_fetch_array($this->result) ;
    }

	function fetch_assoc() {
        return @mysql_fetch_assoc($this->result) ;
    }
	function fetch_object() {
        return @mysql_fetch_object($this->result) ;        
    }
    function db_affected_rows() {
        return @mysql_affected_rows();
    }

	function fetch_row() {
		return @mysql_fetch_row($this->result);
	}

	function db_num_rows() {
        return @mysql_num_rows($this->result) ;
    }

	function num_rows() {
		return @mysql_num_rows($this->result);
	}

	function num_fields() {
		return @mysql_num_fields($this->result);
	}


}
class Database
{
    var $result;
    var $row=array();
    var $conID;
    var $sql;

    function Database(){

        global $DB_NAME;
        global $DB_HOST;
        global $DB_USER;
        global $DB_PASS;

        $this->_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
        //$this->connectDB("localhost","root","","mysite");
    }


    //connect to mysql server and select database
    function _connect($host,$username,$password,$database){

        if(!$this->conID=mysql_connect($host,$username,$password)){
            $this->isError('Error connecting to the server');
        }
        if(!mysql_select_db($database,$this->conID)){
                $this->isError('Error selecting database');
        }

    }

    function query($sql) {
        $this->sql = $sql;
        if(!$this->result=mysql_query($sql)){
            $this->isError('Error performing query '.$sql);
        }
		return new MysqlResult($this->result);
    }
	//get last inserted query id
	function last_inserted_id(){
	    return mysql_insert_id();
	}

    //fetch row
    function fetchRow(){
            return mysql_fetch_assoc($this->result);
    }
    //fetch row
    function fetchObject(){
            return mysql_fetch_object($this->result);
    }

	//get total number of rows for the select query
    function getNumRows(){
        return mysql_num_rows($this->result);
    }

    //handle sql errors
    function isError($msg){
        die($msg. ''.mysql_error());
    }
    //free result
   function freeResult(){
        mysql_free_result($this->result);
   }

}


?>
