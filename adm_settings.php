<?php
	$pagename="adm_settings";
	$extscripts=array("adm_settings.js");
	include "page_header.php";

	include "auth_isLogin.php";
	include "include_common.php";
	if( $islogin )
	{
?>

<div name="frm_settings">
<h3>系統設定</h3>

<?php
	include "include_settings.php";
	
	$title=isset($settings['title']) ? htmle($settings['title']) : "";
	$desc=isset($settings['description']) ? htmle($settings['description']) : "";
	
	echo "<div class=\"blocknl\">\n";
	echo "<form action=\"adm_settings_edit.php\" method=\"post\">\n";
	echo "網站標題： " . "<input name=\"title\" type=\"text\" class=\"title\" value=\"" . $title . "\" /><br>\n";
	echo "網站描述： " . "<br><textarea name=\"desc\" class=\"desc\">" . $desc . "</textarea>\n";
	echo "<div class=\"sub_center\"><input type=\"submit\" class=\"btn\" value=\" 編輯 \" /></div>\n";
	echo "</form>\n";
	echo "</div>\n";
	
	echo "<div class=\"blocknl\">\n";
	echo "<form action=\"adm_account_delete.php\" method=\"post\" onsubmit=\"return confirm_del()\">\n";
	echo "帳號管理： <input type=\"button\" class=\"btn_green\" value=\"開通帳號\" onclick=\"location.href='adm_account_create.php'\" />";
	if( $member['uid']==1 )
		echo " <input type=\"submit\" class=\"btn_red\" value=\"移除帳號\" />";
	echo "<br>\n";
	
	$sql="select * from `members`";
	if( $r=query($link, $sql) )
	{
		echo "<div class=\"innerblock width95\">\n";
		echo "<div class=\"tb\">\n";
		echo "<div class=\"tr\"><div class=\"td\"></div><div class=\"td\">帳號</div><div class=\"td\">Email</div></div>\n";
		while( $row=mysqli_fetch_array($r) )
		{
			echo "<div class=\"tr\">";
			echo "<div class=\"td\"><input name=\"uid[]\" type=\"checkbox\" value=\"" . $row['uid'] . "\"" . ( $row['uid']==1?" disabled":""  ) . " /></div>";
			echo "<div class=\"td\">" . $row['uname'] . "</div><div class=\"td\">" . $row['email'] . "</div></div>\n";
		}
		echo "</div>";
		echo "</div>";
	}
	else
		echo "<div class=\"err\">" . $opFailed . "</div>\n";
	echo "</form>\n";
	
	echo "</div>\n";
?>

</div>

<?php
	}
	else
	{
		warn_back($notLgn, 2000);
	}
	
	include "page_footer.php";
?>