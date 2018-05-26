<?php 
class MD5Hash extends Hash {

	function generate () {
		return md5( $this->input );
	}
}
?>