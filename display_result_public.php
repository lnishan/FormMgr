<?php
	$pagename="display_result_public";
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
			$rpbl=$row['rpbl'];
			if( !$islogin && !$rpbl )
			{
				warn_back($fNotRPbl, 3000);
			}
			else
			{
?>

<div name="frm_result">

<?php
	echo "<h3>表單結果 - " . htmle($row['fname']) . "</h3>\n";
	echo "<div class=\"blocknl\">\n";
	echo "<div class=\"tb\">\n";
	
	$sql="select `iid`,`title` from `form" . $fid . "` where `pbl`=1;";
	$r=query($link, $sql);
	$cols=array(); $cc=0;
	echo "<div class=\"tr\">";
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
		for( $i=0; $i<$cc; $i++ )
			echo "<div class=\"td\">" . htmle($row['C'.$cols[$i]]) . "</div>";
		echo "</div>\n";
	}
	echo "</div>\n";


			}
		}
	}
?>

</div>

<?php
	include "page_footer.php";
?>