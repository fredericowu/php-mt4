<?php
class API_DeviceView extends API_BasicView {

	function process_action ($action, $vars) {
		$response_code = 200;
		$response = Array();
		
		if ( $action == "add" ) {
			$vars["datetime_creation"] = date('Y-m-d H:i:s');

			$device = new Device( $vars );
			$device->save();
		
			//$response["text"] = "ok " . $device->id;			
		} elseif ( $action == "del" ) {			
			$device = new Device( $vars );
			$device->del();
			$response["text"] = "Item excluído";			
		} elseif ( $action == "list" ) {
			$response["dataset"] = (new Device())->all_asarray();
			// $response["text"] = "ok " . count( $devices ) . " " . $devices[0]->fields["hostname"];
		} elseif ( $action == "ssh" ) {
			$device = new Device( $vars );
			
			$output = $device->ssh($vars["user"], $vars["pass"], $vars["command"]);
			$response["output"] = $output; 
			//$response["text"] = $device->fields["ip"];			
		} else {
			$response_code = 500;
		}
		
		$this->set_response($response, $response_code);
	}

	function process ($GET, $POST, $SESSION) {
		$response = Array();
		$response_code = 200;
		
		// TODO: Check if authorized
		if (array_key_exists("logged", $SESSION)) {
			if ( $SESSION["logged"] == 1 ) {
				$action = "list";
				
				$vars = $POST;				
				$vars["auth_user_id"] = $SESSION["auth_user_id"];
				
				if (array_key_exists("action", $POST)) {
					$action = $POST["action"];
					unset($vars["action"]);										
				}
				
				$this->process_action( $action, $vars );
				return;				
			}
		} 
		
		$this->set_response($response, $response_code);
	}	
}

?>