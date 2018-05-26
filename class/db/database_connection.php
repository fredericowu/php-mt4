<?php 
class DataBaseConnection {
	private $connection = null;
	public $last_id = null;

	
	function __construct() {
		$this->connect();		
	}
	
	function fetch ( $rs ) {
		return mysqli_fetch_assoc( $rs );
	}
		
	function escape ( $str ) {
		return mysqli_real_escape_string( $this->connection, $str );
	}
	
	function connect() {
		if ( is_null($this->connection) ) {
			global $DB;
			
			$this->connection = mysqli_connect($DB["HOST"], $DB["USER"], $DB["PASS"], $DB["DATABASE"]);			
		}
	}	
	
	function execute_sql ( $sql ) {
		//echo $sql;
		$this->last_id = null;
		$rs = mysqli_query( $this->connection, $sql ) or die(mysql_error());
		$this->last_id = mysqli_insert_id( $this->connection );

		return $rs;
	}
}
?>