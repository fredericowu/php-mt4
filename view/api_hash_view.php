<?php
class API_HashView extends API_BasicView {
	function process ($GET, $POST, $SESSION) {
		$response = Array();
		$response_code = 200;

		if ( !  array_key_exists("hash-input-text", $POST)  ) {
			$response_code = 500;			
		} else {
			if ($POST["hash-input-text"] == "") {
				$response_code = 500;
				$response["text"] = "Por favor, forneça um texto e uma chave.";			
			} else {
				$input = $POST["hash-input-text"];
				
				$response["hash_md5"] = (new MD5Hash( $input ))->generate();
				$response["hash_sha512"] = (new SHA512Hash( $input ))->generate();
				$response["hash_hmac"] = (new HMACHash( $input ))->generate();
			}		
		}
		
		$this->set_response($response, $response_code);
	}	
}

?>