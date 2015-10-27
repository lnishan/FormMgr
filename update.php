<?php
	include "include_mysql.php";
	
	$isOK=1;
	
	if( $link=connect() )
	{
		$sql="select * from `forminfo`;";
		if( $r=query($link, $sql) )
		{
			while( $row=mysqli_fetch_array($r) )
			{
				$fid=$row['fid'];
				$sql="alter table `form" . $fid . "` change regex vld text;";
				if( !query($link, $sql) ) $isOK=0;
			}
		}
		else
			$isOK=0;
		
		$sql="insert into `settings` (`name`, `value`) values ('title', 'FormMgr v0.5');";
		if( !query($link, $sql) ) $isOK=0;
		$sql="insert into `settings` (`name`, `value`) values ('description', 'Simple/Easy-to-use Form Management System for Organizations.\\nDistributed under GNU General Public License\\n\\nAuthor: lnishan @ lnistudio.net');";
		if( !query($link, $sql) ) $isOK=0;
	}
	else
		$isOK=0;
	
	if( $isOK )
		echo "Updated Successfully!";
	else
		echo "Failed to Update!";
?>