<?php 
class IndexView extends BasicView {
	public $template = "index.html";	

	function process ($GET, $POST, $SESSION) {
		$logged = False;
		if (array_key_exists("logged", $SESSION)) {
			if ( $SESSION["logged"] == 1 ) {
				// Redirects to DEVICE view as main view
				$this->set_template_var("LOAD_SCRIPT", "load_view('device');");
				$logged = True;				
			}
		}
		
		if ( ! $logged ) {			
			$this->set_template_var("LOAD_SCRIPT", "$('.jumbotron').removeClass('hide');");
		}
		
	}
}

?>