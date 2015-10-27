<?php
	include "page_header_notify.php";
	
	include "include_common.php";
	include "auth_isLogin.php";
	if( $islogin )
	{
		$isOK=1;
		
		$fid=$_POST['fid'];
		$sql="delete from `forminfo` where `fid`='" . $fid . "';";
		if( !query($link, $sql) ) $isOK=0;
		$sql="drop table `form" . $fid . "`;";
		if( !query($link, $sql) ) $isOK=0;
		$sql="drop table `result" . $fid . "`;";
		if( !query($link, $sql) ) $isOK=0;
		
		if( $isOK )
		{
			echo "<h3>刪除成功！ 2秒後" . $rdrAdm . "</h3>";
			redirect("adm_list.php", 2000);
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