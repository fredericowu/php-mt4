<?php
 
class BasicView {
	protected $response_code = 200;
	protected $content_type = null;
	
	public $template;
	public $template_vars = Array();
	public $content = null;
			
	function __construct() {
		global $GLOBAL_TEMPLATE_VARS;
		
		$this->template_vars = $GLOBAL_TEMPLATE_VARS;
	}

	function set_content_type ($content_type) {
		$this->content_type = $content_type;
	}
	
	function render( ) {
		$file = "template/" . $this->template;

		if ( file_exists($file) ) {
			$fd = fopen($file, "r");
			$content = fread($fd, filesize($file));
			fclose($fd);			
			
			$this->content = $content;
			$this->render_template_vars();			
		} else {
			throw new Exception('Template file does not exists: ' . $file);
		}

	}
	
	function render_template_vars () {
		foreach ( $this->template_vars as  $key => $value ) {
			$this->content = str_replace( '%' . $key . '%', $value, $this->content );
		}
		// Removing not rendered vars
		$this->content = preg_replace("/%\S+\%/", "", $this->content);
	}
	
	function set_template_var( $key, $value) {
		$this->template_vars[$key] = $value;		
	}
	
	// Abstract
	function process ($GET, $POST, $SESSION) {
		
	}
	
	function display() {
		if ( is_null($this->content ) ) {
			$this->render();
		}

		http_response_code( $this->response_code );

		if (! is_null($this->content_type) ) {
			header("Content-type: " . $this->content_type );
		}
		echo $this->content;
	}

}

?>