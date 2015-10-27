<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" media="screen" href="style/global.css" />
<link rel="stylesheet" media="screen" href="style/index.css" />
<script>
	window.onload=function()
	{
		document.getElementById("ifrm_content").style.height=(window.innerHeight-100) + "px";
	}
	window.onresize=function()
	{
		document.getElementById("ifrm_content").style.height=(window.innerHeight-100) + "px";
	}
</script>

<?php
	include "include_settings.php";
	echo "<title>" . htmlspecialchars(unescape($settings['title'])) . "</title>\n";
	echo "<meta name=\"decription\" content=\"" . htmlspecialchars(unescape($settings['description'])) . "\" />";
?>

</head>

<body>
<?php
	include "page_menu.php";
	
	if( $islogin )
		echo "<iframe name=\"ifrm_content\" id=\"ifrm_content\" src=\"adm_list.php\" />";
	else
		echo "<iframe name=\"ifrm_content\" id=\"ifrm_content\" src=\"list_public.php\" />";
?>


</body>
</html>