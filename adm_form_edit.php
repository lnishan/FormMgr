<?php
	$pagename="adm_form_edit";
	$extscripts=array("createform.js", "adm_form_edit.js");
	include "page_header.php";
	
	include "auth_isLogin.php";
	include "include_common.php";
	if( $islogin )
	{
?>

<div name="frm_add">
	<h3>增加表單物件</h3>
	<div class="block">
		文字 ( 單行 )<br>
		<input name="demo_text" type="text" value="範例文字" style="width: 100px;" /><br>
        <input name="add_text" type="button" class="btn" value="加入" onclick="add('text')" />
	</div>
	<div class="block">
		文字 ( 多行 )<br>
		<textarea name="demo_textarea" rows="3" style="width: 100px;"  >
範例文字
範例文字
範例文字
		</textarea><br>
        <input name="add_textarea" type="button" class="btn" value="加入" onclick="add('textarea')" />
	</div>
	<div class="block">
		單選按鈕<br>
        <input name="demo_radio" type="radio" />選項1<br>
        <input name="demo_radio" type="radio" />選項2<br>
        <input name="add_radio" type="button" class="btn" value="加入" onclick="add('radio')" />
	</div>
	<div class="block">
		勾選按鈕<br>
        <input name="demo_checkbox1" type="checkbox" />選項1<br>
        <input name="demo_checkbox2" type="checkbox" />選項2<br>
        <input name="add_checkbox" type="button" class="btn" value="加入" onclick="add('checkbox')" />
	</div>
    <div class="block">
		下拉式選單<br>
        <select name="demo_list">
        	<option>選項1</option>
            <option>選項2</option>
        </select><br>
        <input name="add_list" type="button" class="btn" value="加入" onclick="add('listbox')" />
	</div>
    <div class="block">
		數字控制項<br>
        <input name="demo_number" type="number" value="0" style="width: 60px;" /><br>
        <input name="add_number" type="button" class="btn" value="加入" onclick="add('number')" />
	</div>
</div>

<form name="frm_final" action="createform3.php" method="post" onsubmit="return confirmEdit()">

<?php
	$fid=$_POST['fid'];
	echo "<input name=\"fid\" type=\"hidden\" value=\"" . $fid . "\" />";
	$sql="select * from `forminfo` where `fid`='" . $fid . "';";
	if( $r=query($link, $sql) )
	{
		$row=mysqli_fetch_array($r);
		echo "<h3>編輯表單：<input name=\"frmname\" type=\"text\" value=\"" . htmle($row['fname']) . "\" required /></h3>\n";
		echo "<div class=\"blocknl\"><textarea name=\"frmdesc\" rows=\"10\" cols=\"50\">" . htmle($row['fdesc']) . "</textarea></div>\n";
		//echo "<input name=\"frmname\" type=\"hidden\" value=\"" . htmle($row['fname']) . "\" />\n";
        //echo "<input name=\"frmdesc\" type=\"hidden\" value=\"" . htmle($row['fdesc']) . "\" />\n";
		echo "<input name=\"frmupbl\" type=\"hidden\" value=\"" . $row['upbl'] . "\" />\n";
		echo "<input name=\"frmrpbl\" type=\"hidden\" value=\"" . $row['rpbl'] . "\" />\n";
		echo "<input name=\"existedfrm\" type=\"hidden\" value=\"1\" />\n";
		
		echo "<script>var dis=" . ( $row['rpbl']=="1"?"false":"true" ) . ";</script>\n";
	}
?>

	<div id="reg">
    	<h3>表單內容<input type="submit" class="sub" value="送出" /></h3>

<?php
	$arriid=array(); $ac=0;
	$arrtyp=array();
	$arrpbl=array();
	$arrreq=array();
	$arrvld=array();
	$arrrmk=array();
	$maxiid=0;
	$count=0;
	$sql="select * from `form" . $fid . "`;";
	$r=query($link, $sql);
	echo "<script> var count=" . mysqli_num_rows($r) . ";</script>\n";
	while( $row=mysqli_fetch_array($r) )
	{
		$iid=$row['iid'];
		$typ=$row['typ'];
		$title=htmle($row['title']);
		$value=htmle($row['value']);
		$pbl=$row['pbl'];
		$req=isset($row['req'])?$row['req']:"";
		$vld=isset($row['vld'])?$row['vld']:"";
		$remark=isset($row['remark']) ? ((int)$row['remark']) : 0;
		
		$arriid[$ac  ]=$iid;
		$arrtyp[$ac  ]=$typ;
		$arrpbl[$ac  ]=(int)$pbl;
		$arrreq[$ac  ]=(int)$req;
		$arrvld[$ac  ]=unescape($vld);
		$arrrmk[$ac++]=$remark;
		
		$maxiid=max($maxiid, $iid);
		echo "<div id=\"div" . $iid . "\" class=\"blocknl\" draggable=\"true\">";
		echo "<div id=\"divinner" . $iid . "\">\n";
		echo "<input name=\"" . $iid . "\" type=\"hidden\" value=\"" . $typ . "\" />\n";
		
		echo "<div class=\"innerblock\">\n";
			echo "<div id=\"rid\" name=\"rid\">" . (++$count) . "</div>. 標題： ";
			echo "<input name=\"title" . $iid . "\" type=\"text\" size=\"50\" value=\"" . $title . "\" /><br>\n";
			switch( $typ )
			{
				case "text":
					echo "<input name=\"val" . $iid . "\" type=\"text\" size=\"50\" value=\"" . $value . "\" />\n";
					break;
				case "textarea":
					echo "<textarea name=\"val" . $iid . "\" rows=\"5\" cols=\"40\">" . $value . "</textarea>\n";
					break;
				case "radio":
					echo "<div id=\"div_val" . $iid . "\" class=\"innernlock\">\n";
					echo "<input type=\"button\" class=\"btn\" value=\"增加\" onclick=\"addradio('" . $iid . "')\" />";
					$avalue=explode("||", $value);
					$avc=count($avalue);
					for( $i=0; $i<$avc; $i++ )
					{
						echo "<div id=\"optwrapper\">";
							echo "<input type=\"radio\" checked disabled />";
							echo "<input name=\"val" . $iid . "[]\" type=\"text\" size=\"40\" value=\"" . $avalue[$i] . "\" />";
							echo "<input type=\"button\" value=\"刪除\" onclick=\"innerRemove(this.parentNode)\"" . ( $i>0?"":" disabled" ) . " />";
						echo "</div>\n";
					}
					echo "</div>\n";
					break;
				case "checkbox":
					echo "<div id=\"div_val" . $iid . "\" class=\"innernlock\">\n";
					echo "<input type=\"button\" class=\"btn\" value=\"增加\" onclick=\"addcheckbox('" . $iid . "')\" />";
					$avalue=explode("||", $value);
					$avc=count($avalue);
					for( $i=0; $i<$avc; $i++ )
					{
						echo "<div id=\"optwrapper\">";
							echo "<input type=\"checkbox\" checked disabled />";
							echo "<input name=\"val" . $iid . "[]\" type=\"text\" size=\"40\" value=\"" . $avalue[$i] . "\" />";
							echo "<input type=\"button\" value=\"刪除\" onclick=\"innerRemove(this.parentNode)\"" . ( $i>0?"":" disabled" ) . " />";
						echo "</div>\n";
					}
					echo "</div>\n";
					break;
				case "listbox":
					echo "<div id=\"div_val" . $iid . "\" class=\"innerblock\">\n";
					echo "<input type=\"button\" class=\"btn\" value=\"增加\" onclick=\"addlistbox('" . $iid . "')\" />";
					$avalue=explode("||", $value);
					$avc=count($avalue);
					for( $i=0; $i<$avc; $i++ )
					{
						echo "<div id=\"optwrapper\">";
							echo "<input name=\"val" . $iid . "[]\" type=\"text\" size=\"40\" class=\"" . ( $i>0?"list_box":"list_box_first" ) . "\" value=\"" . $avalue[$i] . "\" />";
							echo "<input type=\"button\" value=\"刪除\" style=\"margin: 0px\" onclick=\"this.innerRemove(this.parentNode)\"" . ( $i>0?"":" disabled" ) . " />";
						echo "</div>\n";
					}
					echo "</div>\n";
					break;
				case "number":
					echo "<input name=\"val" . $iid . "\" type=\"number\" size=\"30\" value=\"" . $value . "\" />";
					break;
				default:
			}
		echo "</div>\n";
		
		echo "</div></div>\n";
	}
?>

	</div>
    
<?php
    echo "<input name=\"idc\" id=\"idc\" type=\"hidden\" value=\"" . ($maxiid+1) . "\" />\n";
?>

</form>


<script>
window.onload=function()
{
	document.getElementsByName("frm_final")[0].style.height=window.innerHeight - 250 + "px";
	
<?php
	for( $i=0; $i<$ac; $i++ )
	{
		echo "\tvar na2=createOptions(" . $arriid[$i] . ", \"".$arrtyp[$i]."\"" . ( $arrpbl[$i]?", 1":", 0" ) . ( $arrreq[$i]?", 1":", 0" ) . ( ", ".$arrrmk[$i] ) . ( ", \"".addcslashes($arrvld[$i],"\\") ) . "\");\n";
		echo "\tvar na3=createOperations(" . $arriid[$i] . ");\n";
		echo "\tdocument.getElementById(\"divinner" . $arriid[$i] . "\").appendChild(na2);\n";
		echo "\tdocument.getElementById(\"divinner" . $arriid[$i] . "\").appendChild(na3);\n";
	}
?>

	// adding drop listeners
	var ctrls=document.querySelectorAll("#reg .blocknl");
	var ctrlct=ctrls.length;
	for( var i=0; i<ctrlct; i++ )
	{
		addListen(ctrls[i]);
	}
}
</script>

<?php
	}
	else
	{
		warn_back($notLgn, 2000);
	}
	
	include "page_footer.php";
?>