<?php
	$pagename="createform2";
	$extscripts=array("createform.js");
	include "page_header.php";
	
	include "include_common.php";
	include "auth_isLogin.php";
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

<form name="frm_final" action="createform3.php" method="post">

	<?php
    	echo "<h3>表單名稱：" . htmle($_POST['frmname']) . "</h3>\n";
    	echo "<div class=\"blocknl\"><pre>" . htmle($_POST['frmdesc']) . "</pre></div>\n";
    	echo "<input name=\"frmname\" type=\"hidden\" value=\"" . htmle($_POST['frmname']) . "\" />\n";
        echo "<input name=\"frmdesc\" type=\"hidden\" value=\"" . htmle($_POST['frmdesc']) . "\" />\n";
		echo "<input name=\"frmupbl\" type=\"hidden\" value=\"" . (isset($_POST['frmupbl'])?"1":"0") . "\" />\n";
		echo "<input name=\"frmrpbl\" type=\"hidden\" value=\"" . (isset($_POST['frmrpbl'])?"1":"0") . "\" />\n";
	?>
	<div id="reg">
    	<h3>表單內容<input type="submit" class="sub" value="送出" /></h3>
	</div>
    <input name="idc" id="idc" type="hidden" value=0 />
</form>

<script> 
<?php echo "var dis=" . (isset($_POST['frmrpbl'])?"false":"true") . ";"; ?>

var count=0;
window.onload=function(){
		document.getElementsByName("frm_final")[0].style.height=window.innerHeight - 250 + "px";
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