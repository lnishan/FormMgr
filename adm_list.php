<?php
	$pagename="adm_list";
	$extscripts=array("adm_list.js");
	include "page_header.php";
	
	include "include_common.php";
	include "auth_isLogin.php";
	if( $islogin )
	{
?>

<div name="frm_admlist">
	<h3>表單列表(管理)</h3>
	<div class="tb">
    	<div class="tr"><div class="td">名稱</div><div class="td">結果</div><div class="td">公開</div><div class="td">操作</div></div>

<?php
	$sql="select * from `forminfo` order by `ctime` desc";
	$r=query($link, $sql);
	while( $row=mysqli_fetch_array($r) )
	{
		echo "<div class=\"tr\">";
		echo "<div class=\"td\"><label title=\"最後更新時間：" . htmle($row['ctime']) . "\n最後編輯者：" . htmle($row['creator']) . "\n表單描述：" . htmle($row['fdesc']) . "\"><a href=\"display_form.php?fid=" . $row['fid'] . "\">" . htmle($row['fname']) . "</a></label></div>";
		echo "<div class=\"td\"><a href=\"adm_display_result.php?fid=" . $row['fid'] . "\">查看</a></div>";
		echo "<div class=\"td\">";
			echo "<form action=\"adm_form_upbl.php\" method=\"post\"><input name=\"fid\" type=\"hidden\" value=\"" . $row['fid'] . "\" /><input name=\"btn_upbl\" type=\"submit\" class=\"btn_" . (($row['upbl']) ? "red" : "green") . "\" value=\"" . (($row['upbl']) ? "關閉註冊" : "開放註冊") . "\" /></form><br>";
			echo "<form action=\"adm_form_rpbl.php\" method=\"post\"><input name=\"fid\" type=\"hidden\" value=\"" . $row['fid'] . "\" /><input name=\"btn_rpbl\" type=\"submit\" class=\"btn_" . (($row['rpbl']) ? "red" : "green") . "\" value=\"" . (($row['rpbl']) ? "關閉結果" : "開放結果") . "\" /></form>";
		echo "</div>";
		echo "<div class=\"td\">";
			echo "<form action=\"adm_form_edit.php\" method=\"post\"><input name=\"fid\" type=\"hidden\" value=\"" . $row['fid'] . "\" /><input type=\"submit\" class=\"btn\" value=\"編輯\" /></form>";
			echo "<form action=\"adm_form_copy.php\" method=\"post\"><input name=\"fid\" type=\"hidden\" value=\"" . $row['fid'] . "\" /><input type=\"submit\" class=\"btn\" value=\"複製\" /></form>";
			echo "<form action=\"adm_form_del.php\" method=\"post\" onsubmit=\"return confirm_form_del('" . addcslashes(htmle($row['fname']), "\\") . "')\"><input name=\"fid\" type=\"hidden\" value=\"" . $row['fid'] . "\" /><input type=\"submit\" class=\"btn\" value=\"刪除\" /></form>";
		echo "</div>";
		echo "</div>\n";
	}
?>

	</div>
</div>

<?php
	}
	else
	{
		warn_back($notLgn, 2000);
	}
	
	include "page_footer.php";
?>