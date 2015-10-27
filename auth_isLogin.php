<?php
	include "include_crypt.php";
	
	if( !isset($link) )
	{
		include "include_mysql.php";
		$link=connect();
	}

	if( isset($_COOKIE[$ck]) )
	{
		$tmp=explode("__", $_COOKIE[$ck]);
		$sql="select * from `members` where uname='" . $tmp[0] . "';";
		if( $r=query($link, $sql) )
		{
			$row=mysqli_fetch_array($r);
			if( strpos($row['pw'], $tmp[1])==false )
			{
				$islogin=false;
				exit("Bad Cookie. 請清除cookie並重新登入");
			}
			else
			{
				$member=array();
				$islogin=true;
				$member['uid']=$row['uid'];
				$member['username']=$tmp[0];
			}
		}
		else
		{
			$islogin=false;
			exit("Bad Cookie. 請清除cookie並重新登入");
		}
	}
	else
	{
		$islogin=false;
	}
?>