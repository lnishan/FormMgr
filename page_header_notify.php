<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" media="screen" href="style/global.css" />

<style>
h3
{
	text-align: center;
}
</style>

<?php
	if( isset($pagename) && file_exists("style/" . $pagename . "css") )
		echo "<link rel=\"stylesheet\" media=\"screen\" href=\"style/" . $pagename . ".css\" />";
	
	if( isset($pagetitle) )
		echo "<title>" . $pagetitle . "</title>";
	
	if( isset($extscripts) )
		foreach( $extscripts as $script )
			echo "<script src=\"js/" . $script . "\"></script>\n";
?>

</head>

<body>