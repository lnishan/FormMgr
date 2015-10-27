<?php
	if( !isset($settings) )
	{
		if( !isset($link) )
		{
			include "include_mysql.php";
			$link=connect();
		}
		$sql="select * from `settings`";
		$r=query($link, $sql);
		$settings=array();
		while( $row=mysqli_fetch_array($r) )
		{
			$settings[$row['name']]=$row['value'];
		}
	}
?>