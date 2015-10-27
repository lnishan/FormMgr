<?php
	$pagename="display_form";
	include "page_header.php";
	
	include "auth_isLogin.php";
	include "include_common.php";
	if( !isset($_GET['fid']) )
	{
		warn_back($fidNotSet, 3000);
	}
	else
	{
		// Verify Form ID
		$fid=escape($link, $_GET['fid']);
		$sql="select * from `forminfo` where `fid`='" . $fid . "';";
		$r=query($link, $sql);
		if( mysqli_num_rows($r)==0 )
		{
			warn_back($fidNotFound, 3000);
		}
		else
		{
			$row=mysqli_fetch_array($r);
			$upbl=$row['upbl'];
			if( !$islogin && !$upbl )
			{
				warn_back($fNotUPbl, 3000);
			}
			else
			{
?>

<form name="frm_form" action="proc_form.php" method="post">

<?php
	echo "<h3>" . htmle($row['fname']) . "<input type=\"submit\" class=\"sub\" value=\"送出\" /></h3>\n";
	echo "<div class=\"blocknl\"><pre>" . htmle($row['fdesc']) . "</pre></div>\n";
	echo "<input name=\"fid\" type=\"hidden\" value=\"" . $fid . "\" />\n";
	echo "<br>\n";
	echo "<div class=\"req\">* 為必填欄位，請務必填寫</div><br>\n";
	echo "<div class=\"vld\"># 為驗證欄位，請填入正確格式</div>\n";
	
	$sql="select * from `form" . $fid . "`;";
	$r=query($link, $sql);
	$rid=0;
	while( $row=mysqli_fetch_array($r) )
	{
		$req=isset($row['req']) ? ((int)$row['req']) : 0;
		$remark=isset($row['remark']) ? ((int)$row['remark']) : 0;
		$vld=isset($row['vld']) ? unescape($row['vld']) : "";
		echo "<div class=\"blocknl\">\n";
		if( $req ) echo "<div class=\"req\">* </div>";
		if( $remark!=0 ) echo "<div class=\"vld\"># </div>";
		echo ++$rid . ". " . htmle($row['title']) . "<br>\n";
		switch( $row['typ'] )
		{
			case "text":
				echo "<input name=\"C" . $row['iid'] . "\" type=\"text\" size=\"50\" value=\"" . htmle($row['value']) . "\" />\n";
				break;
			case "textarea":
				echo "<textarea name=\"C" . $row['iid'] . "\" rows=\"5\" cols=\"50\">" . htmle($row['value']) . "</textarea>\n";
				break;
			case "radio":
				$val=explode("||", $row['value']);
				foreach( $val as $k => $v )
				{
					echo "<input name=\"C" . $row['iid'] . "\" type=\"radio\" value=\"" . htmle($v) . "\" />" . htmle($v) . "<br>\n";
				}
				break;
			case "checkbox":
				$val=explode("||", $row['value']);
				foreach( $val as $k => $v )
				{
					echo "<input name=\"C" . $row['iid'] . "[]\" type=\"checkbox\" value=\"" . htmle($v) . "\" />" . htmle($v) . "<br>\n";
				}
				break;
			case "listbox":
				$val=explode("||", $row['value']);
				echo "<select name=\"C" . $row['iid'] . "\">\n";
				foreach( $val as $k => $v )
				{
					echo "<option value=\"" . htmle($v) . "\">" . htmle($v) . "</option>\n";
				}
				echo "</select>\n";
				break;
			case "number":
				echo "<input name=\"C" . $row['iid'] . "\" type=\"number\" size=\"30\" value=\"" . $row['value'] . "\" />\n";
				break;
		}
		if( $remark!=0 )	// validation existed
		{
			echo " <div class=\"vld\">";
			if( $remark>0 )	// text validation
			{
				switch( $remark )
				{
					case 1:
						echo "系統自訂，請詳閱標題";
						break;
					case 2:
						echo "英文字母";
						break;
					case 3:
						echo "數字";
						break;
					case 4:
						echo "英文字母及數字";
						break;
					case 5:
						echo "E-mail";
						break;
					case 6:
						echo "網址";
						break;
				}
			}
			else if( $remark==-1 )	// number validation
			{
				$tmp=explode("||", $vld);
				echo "數值必須介於 " . $tmp[0] . " 及 " . $tmp[1] . " 之間(包含上下界)";
			}
			echo "</div>\n";
		}
		echo "</div>\n";
	}
?>

</form>

<?php
			}
		}
	}

	include "page_footer.php";
?>