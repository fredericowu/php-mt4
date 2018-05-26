<?php 
class TripleDESCrypt extends Crypt {
	public $salt = 'Lu70K$i3';
	public $cipher = "des-ede3-cbc";
	
	function crypt() {
		return openssl_encrypt($this->input, $this->cipher, $this->key, 0, $this->salt);
	}
	
	function decrypt() {
		return openssl_decrypt($this->input, $this->cipher, $this->key, 0, $this->salt);
	}
	
}
?>
