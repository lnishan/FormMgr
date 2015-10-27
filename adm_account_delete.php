<?php
	include "page_header_notify.php";
	
	include "auth_isLogin.php";
	include "include_common.php";
	
	if( $islogin )
	{
		$isOK=1;
		
		$uid=$_POST['uid'];
		$uc=count($uid);
		$sql="delete from `members` where ";
		for( $i=0; $i<$uc; $i++ )
		{
			if( $uid[$i]!=1 && is_numeric($uid[$i]) )
				$sql=$sql . "`uid`='" . $uid[$i] . "' or ";
			else
			{
				$isOK=0;
				break;
			}
		}
		if( $isOK )
		{
			$sql=substr($sql, 0, strlen($sql)-4) . ";";
			if( query($link, $sql) )
			{
				echo "<h3>成功刪除 " . $uc . " 個帳號！ 2秒後" . $rdrSet . "</h3>";
				redirect("adm_settings.php", 2000);
			}
			else
				warn_back($opFailed, 2000);
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