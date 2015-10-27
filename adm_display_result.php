<?php
	$pagename="adm_display_result";
	$extscripts=array("adm_display_result.js");
	include "page_header.php";
	
	include "include_common.php";
	include "auth_isLogin.php";
	if( $islogin )
	{
	
	
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
?>

<div name="frm_admresult">

<?php
	echo "<h3>表單結果 - " . htmle($row['fname']) . "</h3>\n";
	echo "<form action=\"adm_proc_result.php\" method=\"post\" onsubmit=\"return confirmDel()\">\n";
	echo "<input name=\"fid\" type=\"hidden\" value=\"" . $fid . "\" />";
	echo "<div class=\"blocknl\">\n";
	echo "<input name=\"ptype\" type=\"submit\" value=\"刪除\" />";
	echo "</div>\n";
	echo "<div class=\"blocknl\">\n";
	echo "<div class=\"tb\">\n";
	
	$sql="select `iid`,`title` from `form" . $fid . "`;";
	$r=query($link, $sql);
	$cols=array(); $cc=0;
	echo "<div class=\"tr\">";
	echo "<div class=\"td\"><input name=\"chk_All\" type=\"checkbox\" onclick=\"toggleRid(this)\" /></div>";
	while( $row=mysqli_fetch_array($r) )
	{
		$cols[$cc++]=$row['iid'];
		echo "<div class=\"td\"><b>" . htmle($row['title']) . "</b></div>";
	}
	echo "</div>\n";
	
	
	$sql="select * from `result" . $fid . "`";
	$r=query($link, $sql);
	while( $row=mysqli_fetch_array($r) )
	{
		echo "<div class=\"tr\">";
		echo "<div class=\"td\"><input name=\"rid[]\" type=\"checkbox\" onclick=\"chkAllChange()\" value=\"" . $row['rid'] . "\" /></div>";
		for( $i=0; $i<$cc; $i++ )
			echo "<div class=\"td\">" . htmle($row['C'.$cols[$i]]) . "</div>";
		echo "</div>\n";
	}
	echo "</div>\n";
	echo "</form>\n";

		}
	}
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