<?php
	include "config.php";
	
	function encrypt($str)
	{
		global $cryptstring;
		return hash("sha256", crypt($str, substr(md5($cryptstring), 0, 9)));
	}
?>