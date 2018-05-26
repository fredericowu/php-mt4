<?php
#require_once("../class/auth/auth.php");

class API_AuthView extends API_BasicView {
	function process ($GET, $POST, $SESSION) {
		$response = Array();
		$response_code = 200;

		if ( ! ( array_key_exists("username", $POST) and array_key_exists("password", $POST) ) ) {
			$response_code = 500;			
		} else {
			
			
			if ($POST["username"] == "" and $POST["password"] == "" ) {
				$response_code = 500;
				$response["text"] = "Por favor, informe usuário e senha";			
			} elseif ($POST["username"] == "demo" and $POST["password"] == "demo" ) {
				$_SESSION["logged"] = 1;
				$_SESSION["username"] = "demo";
				$_SESSION["auth_user_id"] = 1;
				// TODO: generate token and save on session				
				//$response["text"] = "Logado!";
			} else {
				$response_code = 500;
				$response["text"] = "Usuário ou senha incorretos!";				
			}		
		}
		
		$this->set_response($response, $response_code);
	}	
}

?>