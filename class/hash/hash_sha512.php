<?php 
class SHA512Hash extends Hash {

	function generate () {
		return hash( 'sha512', $this->input );
	}
}
?>
