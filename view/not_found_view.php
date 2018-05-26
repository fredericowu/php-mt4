<?php 
require_once("class/view/basic_view.php");

class NotFoundView extends BasicView {
	protected $response_code = 404;	
	public $template = "404.html";
}

?>
