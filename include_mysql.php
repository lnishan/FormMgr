<?php
	include "config.php";
	
	function connect()
	{
		global $sqlserver, $sqluser, $sqlpw, $sqldb;
		$link=mysqli_connect($sqlserver, $sqluser, $sqlpw, $sqldb);
		if( mysqli_connect_errno() )
		{
			echo "Connection Failed!<br>";
			return null;
		}
		else
		{
			mysqli_query($link, "set names utf8");
			return $link;
		}
	}
	
	function escape($link, $q)
	{
		if( gettype($q)=="array" )
		{
			foreach( $q as $k => $v )
			{
				$q[$k]=mysqli_real_escape_string($link, $v);
			}
			return $q;
		}
		else
			return mysqli_real_escape_string($link, $q);
	}
	
	function unescape($str)
	{
		$pat=array("/\\\\\\\"/", "/\\\\\\\'/", "/\\\\\\\\/", "/\\\\n/", "/\\\\r/");
		$rep=array("\"", "\'", "\\", "\n", "\r");
		return preg_replace($pat, $rep, $str);
	}
	
	function query($link, $q)
	{
		return mysqli_query($link, $q);
	}
	
?>