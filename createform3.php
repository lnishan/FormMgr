<?php
	include "page_header_notify.php";
	
	include "include_common.php";
	include "auth_isLogin.php";
	if( $islogin )
	{


	$isOK=1;
	
	if( isset($_POST['existedfrm']) )
	{
		$fid=$_POST['fid'];
		
		$sql="delete from `forminfo` where `fid`='" . $fid . "';";
		if( !query($link, $sql) ) $isOK=0;
		
		$sql="drop table `form" . $fid . "`";
		if( !query($link, $sql) ) $isOK=0;
		
		$sql="drop table `result" . $fid . "`";
		if( !query($link, $sql) ) $isOK=0;
	}
	else
	{
		$sql="show table status like 'forminfo'";
		if( !$r=query($link, $sql) ) $isOK=0;
		$row=mysqli_fetch_array($r);
		$fid=$row['Auto_increment'];
	}
	
	$datetime=new DateTime(null, new DateTimeZone('Asia/Taipei'));
	$sql="insert into `forminfo` (" . (isset($_POST['existedfrm'])?"`fid`, ":"") . "`ctime`, `creator`, `fname`, `fdesc`, `upbl`, `rpbl`) values ('" . (isset($_POST['existedfrm'])?$fid."', '":"") . $datetime->format("Y-m-d H:i:s") . "', '" . $member['username'] . "', '" . escape($link, $_POST['frmname']) . "', '" . escape($link, $_POST['frmdesc']) . "', '" . $_POST['frmupbl'] . "', '" . $_POST['frmrpbl'] . "');";
	if( !query($link, $sql) ) $isOK=0;
	
	$sql="create table if not exists `form" . $fid . "` ( iid int auto_increment primary key, typ text, title text, value text, pbl bool, req bool, vld text, remark text ) character set=utf8;";
	if( !query($link, $sql) ) $isOK=0;
	
	$idc=(int)$_POST['idc'];
	for( $i=0; $i<$idc; $i++ )
	{
		if( isset($_POST[(string)$i]) )
		{
			$typ=escape($link, $_POST[(string)$i]);
			$title=escape($link, $_POST['title'.$i]);
			$val=$_POST['val'.$i]; // escape later
			$pbl= ( isset($_POST['pbl' . $i]) ) ? 1 : 0 ;
			$req= ( isset($_POST['req' . $i]) ) ? 1 : 0 ;
			if( isset($_POST['chkvld'.$i]) )
			{
				$remark=$_POST['optvld'.$i];
				$vld=escape($link, $_POST['vld'.$i]);
			}
			else
			{
				$remark=0;
				$vld="";
			}
			$sql="insert into `form" . $fid . "` (`typ`, `title`, `value`, `pbl`, `req`, `vld`, `remark`) values ('" . $typ . "', '" . $title . "', '";
			if( gettype($val)=="array" )
			{
				foreach( $val as $key => $value )
					$val[$key]=escape($link, $value);
				$sql = $sql . implode("||", $val);
			}
			else
				$sql = $sql . escape($link, $val);
			$sql = $sql . "', '" . $pbl . "', '" . $req . "', '" . $vld . "', '" . $remark . "');";
			// echo $sql . "<br>";
			if( !query($link, $sql) ) $isOK=0;
		}
	}
	
	$sql="create table if not exists `result" . $fid . "` ( rid int auto_increment primary key, rtime datetime, rIP text, ";
	
	if( !$r=query($link, "select iid from `form" . $fid . "`") ) $isOK=0;
	while( $row=mysqli_fetch_array($r) )
	{
		$sql = $sql . "C" . $row['iid'] . " text, ";
	}
	$sql=substr($sql, 0, strlen($sql)-2) . " ) character set=utf8;";
	// echo $sql . "<br>";
	if( !query($link, $sql) ) $isOK=0;
	
	if( $isOK )
	{
		echo "<h3>表單已成功" . ( isset($_POST['existedfrm'])?"編輯":"建立" ) . "！ 2秒後" . $rdrAdm . "</h3>";
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
