<?php
	include "page_header_notify.php";
	
	include "include_mysql.php";
	include "include_common.php";
	
	$fid=$_POST['fid'];
	$fvalid=1;
	if( $link=connect() )
	{
		$isOK=1;
		
		$col="";
		$val="";
		$sql="select `iid`, `req`, `vld`, `remark` from `form" . $fid . "`;";
		if( !$r=query($link, $sql) ) $isOK=0;
		while( $row=mysqli_fetch_array($r) )
		{
			$col=$col . "`C" . $row['iid'] . "`, ";
			$frmval=isset($_POST['C'.$row['iid']]) ? $_POST['C'.$row['iid']] : "";
			
			// Validating input values
			$req=isset($row['req']) ? (int)$row['req'] : 0;
			$remark=isset($row['remark']) ? (int)$row['remark'] : 0;
			$vld=isset($row['vld']) ? unescape($row['vld']) : "";
			if( $req )
			{
				if( empty($frmval) )
				{
					$fvalid=0;
					break;
				}
			}
			
			if( $remark>0 )
			{
				if( !preg_match("/" . addcslashes($vld, "/") . "/", $frmval) )
				{
					$fvalid=0;
					break;
				}
			}
			else if( $remark==-1 )
			{
				$tmpvld=explode("||", $vld);
				if( !is_numeric($frmval) || !( ((int)$frmval) >= ((int)$tmpvld[0]) && ((int)$frmval) <= ((int)$tmpvld[1]) ) )
				{
					$fvalid=0;
					break;
				}
			}
			
			$frmval=escape($link, $frmval);
			if( gettype($frmval)!="array" )
				$val = $val . "'" . $frmval . "', ";
			else
				$val = $val . "'" . join("||", $frmval) . "', ";
		}
		
		if( $fvalid )
		{
			$col=substr($col, 0, strlen($col)-2);
			$val=substr($val, 0, strlen($val)-2);
			
			$datetime=new DateTime(null, new DateTimeZone('Asia/Taipei'));
			
			$sql="insert into `result" . $fid . "` (`rtime`, `rIP`, " . $col . ") values ('" . $datetime->format("Y-m-d H:i:s") . "', '" . getIP() . "', " . $val . ");";
			// echo $sql . "<br>";
			if( !query($link, $sql) ) $isOK=0;
			
			if( $isOK )
			{
				echo "<h3>註冊完成！ 2秒後" . $rdrPbl . "</h3>";
				redirect("list_public.php", 2000);
			}
			else
				warn_back($opFailed, 2000);
		}
		else
		{
			echo "<div class=\"err\">欄位不符合規定！</div>";
			warn_back("請檢查是否有填寫所有必填欄位，以及正確的格式。", 3000);
		}
	}
	
	include "page_footer.php";
?>