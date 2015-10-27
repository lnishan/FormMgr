<?php
	$pagename="adm_account_create";
	include "page_header.php";
	
	include "auth_isLogin.php";
	include "include_common.php";
	if( $islogin )
	{
?>

<form name="frm_newacc" action="adm_proc_account_create.php" method="post">
<h3>開通帳號</h3>
<div id="wrapper_newacc">
帳號： <input name="uname" type="text" /><br>
密碼： <input name="pw" type="password" /><br>
Email： <input name="email" type="text" /><br>
<input type="submit" class="btn" value="開通帳號" />
</div>
</form>

<?php
	}
	else
	{
		warn_back($notLgn, 2000);
	}
	
	include "page_footer.php";
?>