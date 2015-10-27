<?php
	include "page_header.php";
	include "include_common.php";
	include "include_mysql.php";
	include "include_crypt.php";
	if( $link=connect() )
	{
		$isOK=1;
		
		echo "<h3>Installation Started !</h3><br>";
		
		$sql="create table if not exists settings( name text, value text ) character set=utf8;";
		if( !query($link, $sql) ) $isOK=0;
		
		$sql="insert into `settings` (`name`, `value`) values ('title', 'FormMgr v0.4');";
		if( !query($link, $sql) ) $isOK=0;
		$sql="insert into `settings` (`name`, `value`) values ('description', 'A system dedicated to providing simple form management for organizations. \\nAuthor: lnishan @ lnistudio.net');";
		if( !query($link, $sql) ) $isOK=0;
		
		$sql="create table if not exists members( uid int auto_increment primary key, uname text, pw text, email text, remark text ) character set=utf8;";
		if( !query($link, $sql) ) $isOK=0;
		
		$sql="insert into members (`uname`, `pw`, `email`) values ('" . $adm_uname . "', '" . encrypt($adm_pw) . "', '" . $adm_email . "');";
		if( !query($link, $sql) ) $isOK=0;
		
		$sql="create table if not exists forminfo( fid int auto_increment primary key, ctime datetime, creator text, fname text, fdesc text, upbl bool, rpbl bool, remark text ) character set=utf8;";
		if( !query($link, $sql) ) $isOK=0;
		
		if( $isOK )
		{
			echo "<h3>Installation Complete !</h3>";
			redirect("index.php", 2000);
		}
		else
		{
			echo "<div class=\"err\">Installation Failed</div>";
		}
	}
	
	include "page_footer.php";
?>