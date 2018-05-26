<?php
class API_CryptView extends API_BasicView {
	function process ($GET, $POST, $SESSION) {
		$response = Array();
		$response_code = 200;

		if ( ! array_key_exists("crypt-input-text", $POST) or ! array_key_exists("crypt-input-key", $POST)  ) {
			$response_code = 500;			
		} else {
			$action = "crypt";
			if ( array_key_exists("action", $POST)  ) {
				$action = $POST["action"];
			}
			
			if ($POST["crypt-input-text"] == "" or $POST["crypt-input-key"] == "") {
				$response_code = 500;
				$response["text"] = "Por favor, forneça um texto e uma chave.";			
			} else {
				$input = $POST["crypt-input-text"];
				$key = $POST["crypt-input-key"];

				//$crypt = new Crypt( $input );
				
				if ( $action == "crypt" ) {						 
					$response["cesar"] = (new CesarCrypt( $input, $key))->crypt();
					$response["aes"] = (new AESCrypt( $input, $key ))->crypt();
					$response["tripledes"] = (new TripleDESCrypt( $input, $key ))->crypt();
				} elseif ( $action == "decrypt_cesar" ) {
					$response["decrypt_cesar"] = (new CesarCrypt( $input, $key ))->decrypt();
					
				} elseif ( $action == "decrypt_aes" ) {
					$response["decrypt_aes"] = (new AESCrypt( $input, $key ))->decrypt();
					
				} elseif ( $action == "decrypt_tripledes" ) {
					$response["decrypt_tripledes"] = (new TripleDESCrypt( $input, $key ))->decrypt();
																	
				} else {
					$response_code = 500;
					$response["text"] = "Unknown action";						
				}
			}		
		}
		
		$this->set_response($response, $response_code);
	}	
}

?>