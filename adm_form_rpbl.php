<?php
	include "page_header_notify.php";
	
	include "include_common.php";
	include "auth_isLogin.php";
	if( $islogin )
	{
		$fid=$_POST['fid'];
		$cond=$_POST['btn_rpbl']=="關閉結果" ? 1 : 0;
		$sql="update `forminfo` set `rpbl`='" . (1-$cond) . "' where `fid`='" . $fid . "';";
		if( $r=query($link, $sql) )
		{
			echo "<h3>操作完成！ 2秒後" . $rdrAdm . "</h3>";
			redirect("adm_list.php", 2000);
		}
		else
			warn_back($opFailed, 2000);
	}
	else
		warn_back($notLgn, 2000);
	
	include "page_footer.php";
?>
