// JavaScript Document

function confirmDel()
{
	var count;
	var tmp=document.getElementsByName("rid[]");
	if( !tmp )
	{
		alert("沒有任何資料能進行操作!");
		return false;
	}
	else if( !tmp.length )
	{
		if( tmp.checked )
			count=1;
		else
			count=0;
	}
	else
	{
		count=0;
		for( var i=0; i<tmp.length; i++)
		{
			if( tmp[i].checked )
				count++;
		}
	}
	if( count==0 )
	{
		alert("沒有選取任何資料!");
		return false;
	}
	else
	{
		return confirm("確定要刪除 " + count.toString() + " 筆資料嗎？");
	}
}

function toggleRid(th)
{
	var rids=document.getElementsByName("rid[]");
	if( !rids )
	{
	}
	else if( !rids.length )
	{
		rids.checked=th.checked;
	}
	else
	{
		ridct=rids.length;
		for( var i=0; i<ridct; i++ )
			rids[i].checked=th.checked;
	}
}

function chkAllChange()
{
	var allchk=true;
	var rids=document.getElementsByName("rid[]");
	if( !rids )
	{
	}
	else if( !rids.length )
	{
		if( !rids.checked )
			allchk=false;
	}
	else
	{
		ridct=rids.length;
		for( var i=0; i<ridct; i++ )
			if( !rids[i].checked )
			{
				allchk=false;
				break;
			}
	}
	document.getElementsByName("chk_All")[0].checked=allchk;
}