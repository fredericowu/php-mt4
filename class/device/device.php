<?php
set_include_path("lib/phpseclib");
require_once('Net/SSH2.php');

class Device extends DataBaseModel {
	public $table = "device";

	function ssh ($user, $pass, $cmd) {		
		$host = $this->fields["ip"];
		if ( $host == "" ) {
			$host = $this->fields["hostname"];
		}
		
		$ssh = new Net_SSH2( $host);
		if (!$ssh->login($user, $pass)) {
			return 'Login Failed';
		}
		
		return $ssh->exec( $cmd );
	}
	
}
?>