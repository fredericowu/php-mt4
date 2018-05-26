<?php
 
class API_BasicView extends BasicView {	
	protected $response_data = Array();
	protected $content_type = "application/json";

	function set_response ($response_data, $response_code = 200) {
		$this->response_code = $response_code;
		$this->response_data = $response_data; 
	}
	
	function render() {
		$this->content = json_encode( $this->response_data );
	}

}

?>