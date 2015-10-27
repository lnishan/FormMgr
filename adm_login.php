<?php
	$pagename="adm_login";
	include "page_header.php";
	
	include "include_common.php";
	include "auth_isLogin.php";
	if( !$islogin )
	{
?>

<form name="frm_login" action="adm_proc_login.php" method="post" />
	<div class="center"><h3>帳號登入</h3></div>
	<div class="blocknl">
    	<div class="center">
			帳號： <input name="username" type="text" />
        </div>
	</div>
    <div class="blocknl">
    	<div class="center">
			密碼： <input name="password" type="password" />
        </div>
	</div>
    <input type="submit" class="button_login" value="登入" />
</form>

<?php
	}
	else
	{
		warn_back($LgnIn, 2000);
	}
	
	include "page_footer.php";
?>