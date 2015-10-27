<?php
	include "page_header_notify.php";
	
	include "auth_isLogin.php";
	include "include_common.php";
	
	if( $islogin )
	{
		$uname=escape($link, $_POST['uname']);
		$pw=encrypt($_POST['pw']);
		$email=escape($link, $_POST['email']);
		
		$sql="select * from `members` where `uname`='" . $uname . "';";
		if( $r=query($link, $sql) )
		{
			if( mysqli_num_rows($r)>0 )
			{
				warn_back("帳號重複！", 2000);
			}
			else
			{
				$sql="insert into `members` (`uname`, `pw`, `email`) values ('" . $uname . "', '" . $pw . "', '" . $email . "');";
				if( query($link, $sql) )
				{
					echo "<h3>帳號(" . htmlspecialchars($uname) . ")" . " 開通成功！ 2秒後" . $rdrSet . "</h3>";
					redirect("adm_settings.php", 2000);
				}
				else
					warn_back($opFailed, 2000);
			}
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