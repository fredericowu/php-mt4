<?php 
class DataBaseModel {
	protected $connection = null;
		
	public $id = null;
	public $fields = Array();
	public $table = null;

	function __construct( $fields = Array() ) {
		$this->set_fields( $fields );	
		$this->connection = new DataBaseConnection();
		
		if ( array_key_exists($this->get_id_field(), $fields) ) {
			$this->load();			
		}  
	}
	
	function all() {
		$class = get_class($this);		
		$result = Array();
		
		$sql = $this->get_sql("SELECT");
		$rs = $this->connection->execute_sql( $sql );
		
		while($row = $this->connection->fetch( $rs ) ) {
			array_push( $result, new $class( $row ) );
		}

		return $result;		
	}

	function all_asarray() {
		$result = $this->all();
		$arr = Array();
		foreach ( $result as $obj ) {
			array_push( $arr, $obj->fields );						
		}		
		
		#return json_encode( $json );
		return $arr;
	}	
	
	function get_id_field () {
		return $this->table . "_id";
	}
	
	function get_id_value() {
		return $this->fields[ $this->get_id_field() ];
	}
	
	function set_fields ( $fields ) {
		$this->fields = $fields;
	}
	

	function get_sql ( $type ) {
		$quoted_values = Array();
		$quoted_keys = Array();
		
		foreach ( $this->fields  as $key => $val) {
			array_push($quoted_values, $this->connection->escape( $val ) );
			array_push($quoted_keys, $this->connection->escape( $key ) );
		}
				
		if ($type == "INSERT") {
			$quoted_values_str = "('" . join("','", $quoted_values ) . "')";
			$quoted_keys_str = "(`" . join("`,`", $quoted_keys ) . "`)";				
			$sql = "INSERT INTO " . $this->table . " " . $quoted_keys_str . " VALUES " . $quoted_values_str . ";"; 
		} elseif ( $type == "SELECT") {
			$sql = "SELECT * from " . $this->table . ";";
		} elseif ( $type == "LOAD") {
				$sql = "SELECT * from " . $this->table . " WHERE " . $this->get_id_field() . " = " . $this->get_id_value() . ";";									
		} elseif ( $type == "DELETE" ) {
			$sql = "DELETE from " . $this->table . " WHERE " . $this->get_id_field() . " = " . $this->get_id_value() . ";";
		}
		
		return $sql;
		
	}
	
	function del() {
		$sql = $this->get_sql("DELETE");
		return $this->connection->execute_sql( $sql );
	}
	
	function load() {
		$sql = $this->get_sql("LOAD");
		$rs =  $this->connection->execute_sql( $sql );
		$row = $this->connection->fetch( $rs );
		
		foreach( $this->fields as $key => $val ) {
			if (array_key_exists($key, $row)) {
				$row[$key] = $val;
			}			
		}
		
		$this->set_fields( $row );		
	}
	
	function save() {
		$type_sql = "INSERT";
		if ( array_key_exists($this->get_id_field(), $this->fields) )  {
			$type_sql = "UPDATE";
		}
		
		$sql = $this->get_sql($type_sql);
		$result = $this->connection->execute_sql( $sql );
		$id = $this->connection->last_id;
		
		// for update later
		if ( $id > 0 ) {
			$this->fields[ $this->get_id_field() ] = $id;
			$this->id = $id;			
		}
		
		return $result;
		
	}


}
?>