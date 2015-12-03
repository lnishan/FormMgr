<?php
	include "page_header_notify.php";
	
	include "auth_isLogin.php";
	include "include_common.php";
	if( $islogin )
	{
		$isOK=1;
		
		$srcfid=$_POST['srcfid'];
		$sql="show table status like 'forminfo';";
		if( !$r=query($link, $sql)) $isOK=0;
		$row=mysqli_fetch_array($r);
		$fid=$row['Auto_increment'];
		
		// copy forminfo, create new creator+datetime
		$dtime=new DateTime(null, new DateTimeZone('Asia/Taipei'));
		$sql="insert into `forminfo` (`ctime`, `creator`, `fname`, `fdesc`, `upbl`, `rpbl`) values ('" . $dtime->format("Y-m-d H:i:s") . "', '" . $member['username'] . "', '" . escape($link, $_POST['fname']) . "', '" . escape($link, $_POST['fdesc']) . "', '" . ( isset($_POST['fupbl'])?"1":"0" ) . "', '" . ( isset($_POST['frpbl'])?"1":"0" ) . "');";
		if( !query($link, $sql) ) $isOK=0;
			
		$sql="create table if not exists `form" . $fid . "` ( iid int auto_increment primary key, typ text, title text, value text, pbl bool, req bool, vld text, remark text ) character set=utf8;";
		if( !query($link, $sql) ) $isOK=0;
			
		$sql="create table if not exists `result" . $fid . "` ( rid int auto_increment primary key, rtime datetime, rIP text, ";
		if( !$r=query($link, "select * from `form" . $srcfid . "`;") ) $isOK=0;
		$cols=array(); $cc=0;
		while( $row=mysqli_fetch_array($r) )
		{
			$cols[$cc++]="C" . $row['iid'];
			$sql=$sql . "C".$row['iid'] . " text, ";
			$sql2="insert into `form" . $fid . "` (`typ`, `title`, `value`, `pbl`, `req`, `vld`, `remark`) values ('" . $row['typ'] . "', '" . escape($link, $row['title']) . "', '" . escape($link, $row['value']) . "', '" . $row['pbl'] . "', '" . escape($link, ( isset($row['req'])?$row['req']:"" )) . "', '" . escape($link, ( isset($row['vld'])?$row['vld']:"" )) . "', '" . escape($link, ( isset($row['remark'])?$row['remark']:"" )) . "');";
			//echo $sql2 . "<br>";
			if( !query($link, $sql2) ) $isOK=0;
		}
		$sql=substr($sql, 0, strlen($sql)-2) . " ) character set=utf8;";
		//echo $sql;
		if( !query($link, $sql) ) $isOK=0;;
		
		if( isset($_POST['copyresults']) )
		{
			$sql="select * from `result" . $srcfid . "`;";
			if( !$r=query($link, $sql) ) $isOK=0;
			$k="rtime, rIP, ";
			$k=$k . implode(", ", $cols);
			while( $row=mysqli_fetch_array($r) )
			{
				$sql="insert into `result" . $fid . "` ( ";
				$v="'" . $row['rtime'] . "', '" . $row['rIP'] . "'";
				for( $i=0; $i<$cc; $i++ )
					$v=$v . ", '" . $row[$cols[$i]] . "'";
				$sql=$sql . $k . " ) values ( " . $v . " );";
				if( !query($link, $sql) ) $isOK=0;
			}
		}
		
		if( $isOK )
		{
			echo "<h3>複製完成！ 2秒後" . $rdrAdm . "</h3>";
			redirect("adm_list.php", 2000);
		}
		else
			warn_back($opFailed, 2000);
	}
	else
	{
		warn_back($notLgn, 2000);
	}
	
	include "page_footer.php";
?>