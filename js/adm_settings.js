// JavaScript Document

function confirm_del()
{
	var uids=document.getElementsByName("uid[]");
	var uidct=uids.length;
	var chkct=0;
	
	if( !uids || uidct==0 )
	{
		alert("沒有任何帳號可供刪除！");
		return false;
	}
	else
	{
		for( var i=0; i<uidct; i++ )
			if( uids[i].checked )
				chkct++;
		if( chkct )
		{
			return confirm("確定要刪除 " + chkct.toString() + " 個帳號嗎？");
		}
		else
		{
			alert("沒有選取任何帳號！");
			return false;
		}
	}
}