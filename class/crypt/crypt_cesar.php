<?php 
class CesarCrypt extends Crypt {

	function __construct( $input = "", $key = 4) {
		parent::__construct($input, $key);		
	}	
	
	function crypt() {
		return $this->Encipher( $this->input, $this->key );
	}

	function decrypt() {
		return $this->Decipher( $this->input, $this->key );
	}
	
	//
	// Original code from: https://www.programmingalgorithms.com/algorithm/caesar-cipher?lang=PHP
	//
	
	function Cipher($ch, $key)
	{
		if (!ctype_alpha($ch))
			return $ch;
	
		$offset = ord(ctype_upper($ch) ? 'A' : 'a');
		return chr(fmod(((ord($ch) + $key) - $offset), 26) + $offset);
	}
	
	function Encipher($input, $key)
	{
		$output = "";
	
		$inputArr = str_split($input);
		foreach ($inputArr as $ch)
			$output .= $this->Cipher($ch, $key);
	
		return $output;
	}
	
	function Decipher($input, $key)
	{
		return $this->Encipher($input, 26 - $key);
	}
	
	
}
?>
