<?php
	include "page_header_notify.php";
	
	include "auth_isLogin.php";
	include "include_common.php";
	
	if( $islogin )
	{
		$isOK=1;
		
		$title=$_POST['title'];
		$desc=$_POST['desc'];
		
		$sql="update `settings` set `value`='" . escape($link, $title) . "' where `name`='title';";
		if( !query($link, $sql) ) $isOK=0;
		
		$sql="update `settings` set `value`='" . escape($link, $desc) . "' where `name`='description';";
		if( !query($link, $sql) ) $isOK=0;
		
		if( $isOK )
		{
			echo "<h3>設定成功！ 2秒後" . $rdrAdm . "</h3>";
			reload(2000);
		}
		else
			warn_back($opFailed, 2000);
	}
	else
	{
		warn_back($notLgn, 2000);
	}
	
	include "page_footer.php";
?>