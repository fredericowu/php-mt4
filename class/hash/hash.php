<?php 
abstract class Hash {
	protected $input;
	
 	abstract protected function generate();
	
	function __construct( $input = "") {
		$this->set_input( $input );
	} 
	
	function set_input ( $input ) {
		$this->input = $input;
	}
	
	
	function get_input ( ) {
		return $this->input;		
	}
	
	
}
?>