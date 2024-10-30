<?php 


class LoginCustomizerPlusDectivate {

	public static function deactivate() {

		flush_rewrite_rules();
	}

	
}


?>