<?php 
class AESCrypt extends Crypt {
	public $salt = 'Lu70K$i3pu5xf7*I';
	public $cipher = "aes-256-cbc";
	
	function crypt() {		
		return openssl_encrypt($this->input, $this->cipher, $this->key, 0, $this->salt);				
	}

	function decrypt() {
		return openssl_decrypt($this->input, $this->cipher, $this->key, 0, $this->salt);
	}

}
?>