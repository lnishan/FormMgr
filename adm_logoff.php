<?php
	include "config.php";
	include "include_common.php";
	setCookie($ck, "", time()-1);
	include "page_header_notify.php";
	echo "<h3>成功登出！ 2秒後" . $rdrPbl . "</h3>";
	reload(2000);
	include "page_footer.php";
?>
	