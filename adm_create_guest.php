<?php
	include "page_header_notify.php";
	
	include "auth_isLogin.php";
	include "include_common.php";
	if( $islogin )
	{
		$isOK=1;
		
		$sql="insert into `members` (`uname`, `pw`, `email`) values ('" . "guest" . "', '" . encrypt("guest") . "', '" . "abc123@def.com" . "');";
		// echo $sql . "<br>";
		if( !query($link, $sql) ) $isOK=0;
		
		if( $isOK )
		{
			echo "<h3>Guest帳號成功建立</h3>";
			redirect("adm_list.php", 2000);
		}
		else
			warn_back($opFailed, 2000);
	}
	
	include "page_footer.php";
?>