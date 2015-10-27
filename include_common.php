<?php
	function warn_back($message, $time)
	{
		echo "<div class=\"err\">" . $message . "</div>";
		echo "<script>setTimeout(\"history.back()\", " . $time . ");</script>";
	}
	
	function htmle($s)
	{
		$htmlopen=0;
		if( $htmlopen )
			return unescape($s);
		else
			return htmlspecialchars(unescape($s));
	}
	
	function redirect($url, $time)
	{
		echo "<script>setTimeout(\"location.href='" . $url . "'\", " . $time . ");</script>";
	}
	
	function getIP()
	{
		if( !empty($_SERVER['HTTP_CLIENT_IP']) )
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		else if( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) )
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$ip=$_SERVER['REMOTE_ADDR'];
		return $ip;
	}
	
	function reload($time)
	{
		echo "<script>setTimeout(\"window.top.location.reload(true)\", " . $time . ");</script>";
	}
	
?>