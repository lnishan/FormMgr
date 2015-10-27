
<div id="menu_section">
	<div id="button_section">
<?php
	if( !isset($islogin) )
		include "auth_isLogin.php";
	if( $islogin )
	{
		echo "\t\t<div id=\"button\"><a href=\"adm_list.php\" target=\"ifrm_content\">表單列表(管理)</a></div>\n";
		echo "\t\t<div id=\"button\"><a href=\"list_public.php\" target=\"ifrm_content\">表單列表(公開)</a></div>\n";
		echo "\t\t<div id=\"button\"><a href=\"createform.php\" target=\"ifrm_content\">建立表單</a></div>\n";
		echo "\t\t<div id=\"button\"><a href=\"adm_settings.php\" target=\"ifrm_content\">系統設定</a></div>\n";
		echo "\t\t<div id=\"button\"><a href=\"adm_logoff.php\" target=\"ifrm_content\">帳號登出</a></div>\n";
	}
	else
	{
		echo "\t\t<div id=\"button\"><a href=\"list_public.php\" target=\"ifrm_content\">表單列表</a></div>\n";
		echo "\t\t<div id=\"button\"><a href=\"adm_login.php\" target=\"ifrm_content\">帳號登入</a></div>\n";
	}
?>
	</div>
</div>
