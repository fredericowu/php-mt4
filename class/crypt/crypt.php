<?php 
abstract class Crypt {
	protected $input;
	protected $key;
	
	abstract protected function crypt();
	abstract protected function decrypt();
	
	function __construct( $input = "", $key = "chave") {
		$this->set_input( $input );
		$this->set_key( $key );
	} 
	
	function set_input ( $input ) {
		$this->input = $input;
	}
	
	function set_key ( $key ) {
		$this->key = $key;
	}
	
	function get_input ( ) {
		return $this->input;		
	}
	
	function get_key ( ) {
		return $this->key;
	}
	
	
}
?>