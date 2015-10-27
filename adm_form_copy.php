<?php
	$pagename="adm_form_copy";
	include "page_header.php";
	
	include "auth_isLogin.php";
	include "include_common.php";
	if( $islogin )
	{
?>

<form name="frm_copy" action="adm_proc_form_copy.php" method="post">

<?php
	$srcfid=$_POST['fid'];
	$sql="select * from `forminfo` where `fid`='" . $srcfid . "';";
	if( $r=query($link, $sql) )
	{
		$row=mysqli_fetch_array($r);
		echo "<h3>複製表單：" . htmle($row['fname']) . "</h3>\n";
		echo "<div class=\"blocknl\"><pre>" . htmle($row['fdesc']) . "</pre></div>\n";
		echo "<input name=\"srcfid\" type=\"hidden\" value=\"" . $srcfid . "\" />\n";
	}
?>

<br>
<h3>新建表單</h3>

<label for="fname">表單名稱： </label><input name="fname" type="text" /><br>
<label for="fdesc">表單描述： </label><br><textarea name="fdesc" rows="10" cols="50"></textarea><br>

<input name="copyresults" type="checkbox" value="1" /> <label for="copyresults">複製表單結果</label><br><br>

<input name="fupbl" type="checkbox" value="1" checked /> <label for="fupbl">開放表單使用</label><br>
<input name="frpbl" type="checkbox" value="1" checked /> <label for="frpbl">公開表單結果</label><br>

<input type="submit" class="btn" value="複製表單" />

</form>

<?php
	}
	else
	{
		warn_back($notLgn, 2000);
	}
	
	include "page_footer.php";
?>