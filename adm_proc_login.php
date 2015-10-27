<?php
	include "include_common.php";
	include "auth_isLogin.php";
	if( $islogin )
	{
		include "page_header_notify.php";
		warn_back($LgnIn, 2000);
		include "page_footer.php";
	}
	else
	{
		$usr=$_POST['username'];
		$pw=$_POST['password'];
		$sql="select pw from `members` where `uname`='" . $usr . "';";
		if( $r=query($link, $sql) )
		{
			$row=mysqli_fetch_array($r);
			$encpw=encrypt($pw);
			if( $row['pw']==$encpw )
			{
				setCookie($ck, $usr . "__" . substr($encpw, rand(0, 32), 32));
				include "page_header_notify.php";
				echo "<h3>成功登入！ 2秒後" . $rdrAdm . "</h3>";
				reload(2000);
				include "page_footer.php";
			}
			else
			{
				include "page_header_notify.php";
				warn_back($badLgn, 2000);
				include "page_footer.php";
			}
		}
		else
		{
			include "page_header_notify.php";
			warn_back($badLgn, 2000);
			include "page_footer.php";
		}
	}
?>
	
	