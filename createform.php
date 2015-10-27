<?php
	$pagename="createform";
	include "page_header.php";
	
	include "include_common.php";
	include "auth_isLogin.php";
	if( $islogin )
	{
?>

<form name="frm_create" action="createform2.php" method="post">
<h3>建立表單</h3>
表單名稱： <input name="frmname" type="text" required /><br>
表單描述： <br>
<textarea name="frmdesc" rows="10" cols="50"></textarea><br>
<input name="frmupbl" type="checkbox" value="1" checked /> 開放表單使用<br>
<input name="frmrpbl" type="checkbox" value="1" checked /> 公開表單結果<br>
<input name="btn_submit" type="submit" class="btn" value="下一步" />
</form>

<?php
	}
	else
	{
		warn_back($notLgn, 2000);
	}
	
	include "page_footer.php";
?>