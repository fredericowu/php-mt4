<?php 
class HMACHash extends Hash {
	public $secret = 'shh';
	
	function generate () {
		return hash_hmac( 'ripemd160', $this->input, $this->secret );
	}
}
?>