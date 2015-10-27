<?php
	include "page_header_notify.php";

	include "include_common.php";
	include "auth_isLogin.php";
	if( $islogin )
	{
		$fid=$_POST['fid'];
		$rid=$_POST['rid'];
		if( $_POST['ptype']=="刪除" )
		{
			$sql="delete from `result" . $fid . "` where ";
			$rc=count($rid);
			for( $i=0; $i<$rc; $i++ )
			{
				if( $i>0 )
					$sql = $sql . " or ";
				$sql = $sql . "`rid`='" . $rid[$i] . "'";
			}
			$sql = $sql . ";";
			if( $r=query($link, $sql) )
			{
				echo "<h3>成功刪除 <b>" . $rc . "</b> 筆資料！ 2秒後" . $rdrAdm . "</h3>";
				redirect("adm_list.php", 2000);
			}
			else
			{
				warn_back("刪除失敗！", 2000);
			}
		}
	}
	else
	{
		warn_back($notLgn, 2000);
	}
	
	include "page_footer.php";
?>