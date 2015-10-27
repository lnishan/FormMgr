<?php
	$pagename="list_public";
	include "page_header.php";
?>

<div name="frm_list">
<h3>表單列表</h3>

<?php
	include "include_common.php";
	include "include_mysql.php";
	if( $link=connect() )
	{
		echo "<div class=\"tb\">\n";
		echo "<div class=\"tr\"><div class=\"td\">名稱</div><div class=\"td\">描述</div><div class=\"td\">結果</div></div>\n";
		$r=query($link, "select * from `forminfo` order by `ctime` desc");
		while( $row=mysqli_fetch_array($r) )
		{
			if( $row['upbl'] )
				echo "<div class=\"tr\"><div class=\"td\"><a href=\"display_form.php?fid=" . $row['fid'] . "\">" . htmle($row['fname']) . "</a></div><div class=\"td\"><pre>" . htmle($row['fdesc']) . "</pre></div>";
			else
				echo "<div class=\"tr\"><div class=\"td\"><font color=\"grey\">" . htmle($row['fname']) . "</font></div><div class=\"td\"><font color=\"grey\"><pre>" . htmle($row['fdesc']) . "</pre></font></div>";
			
			if( $row['rpbl'] )
				echo "<div class=\"td\"><a href=\"display_result_public.php?fid=" . $row['fid'] . "\">查看</a></div></div>\n";
			else
				echo "<div class=\"td\"><font color=\"grey\">不公開</font></div></div>\n";
		}
		echo "</div>\n";
	}
?>

</div>

<?php
	include "page_footer.php";
?>