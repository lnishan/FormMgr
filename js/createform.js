// JavaScript Document

function addradio(id)
{
	var wrap=document.createElement("div");
	wrap.setAttribute("id", "optwrapper");
	
	var node1=document.createElement("input");
	node1.setAttribute("type", "radio");
	node1.setAttribute("checked", ( !document.getElementsByName("val"+id+"[]") )?"true":"false" );
	node1.setAttribute("disabled", "true");
	
	var node2=document.createElement("input");
	node2.setAttribute("name", "val"+id+"[]");
	node2.setAttribute("type", "text");
	node2.setAttribute("size", "40");
	
	var node3=document.createElement("input");
	node3.setAttribute("type", "button");
	node3.setAttribute("value", "刪除");
	node3.setAttribute("onclick", "innerRemove(this.parentNode)");
	
	wrap.appendChild(node1);
	wrap.appendChild(node2);
	wrap.appendChild(node3);
	
	var tmp=document.getElementById("div_val"+id);
	tmp.appendChild(wrap);
}

function addcheckbox(id)
{
	var wrap=document.createElement("div");
	wrap.setAttribute("id", "optwrapper");
	
	var node1=document.createElement("input");
	node1.setAttribute("type", "checkbox");
	node1.setAttribute("checked", ( !document.getElementsByName("val"+id+"[]") )?"true":"false" );
	node1.setAttribute("disabled", "true");
	
	var node2=document.createElement("input");
	node2.setAttribute("name", "val"+id+"[]");
	node2.setAttribute("type", "text");
	node2.setAttribute("size", "40");
	
	var node3=document.createElement("input");
	node3.setAttribute("type", "button");
	node3.setAttribute("value", "刪除");
	node3.setAttribute("onclick", "innerRemove(this.parentNode)");
	
	wrap.appendChild(node1);
	wrap.appendChild(node2);
	wrap.appendChild(node3);
	
	
	var tmp=document.getElementById("div_val"+id);
	tmp.appendChild(wrap);
}

function addlistbox(id)
{
	var wrap=document.createElement("div");
	wrap.setAttribute("id", "optwrapper");
	
	var node1=document.createElement("input");
	node1.setAttribute("name", "val"+id+"[]");
	node1.setAttribute("type", "text");
	node1.setAttribute("class", "list_box");
	node1.setAttribute("size", "40");
	
	var node2=document.createElement("input");
	node2.setAttribute("type", "button");
	node2.setAttribute("value", "刪除");
	node2.setAttribute("style", "margin: 0px");
	node2.setAttribute("onclick", "innerRemove(this.parentNode)");
	
	wrap.appendChild(node1);
	wrap.appendChild(node2);
	
	var tmp=document.getElementById("div_val"+id);
	tmp.appendChild(wrap);
}

function innerRemove(nd)
{
	nd.parentNode.removeChild(nd);
}

function createTitle(id)
{
	var nd=document.createElement("input");
	nd.setAttribute("name", "title" + id.toString());
	nd.setAttribute("type", "text");
	nd.setAttribute("size", "50");
	nd.setAttribute("required", "true");
	
	return nd;
}

function optvldchange(id)
{
	var optvld=document.getElementById("optvld"+id.toString());
	var vld=document.getElementById("vld"+id.toString());
	if( optvld.value=="1" )
	{
		vld.setAttribute("type", "text");
		vld.setAttribute("value", "");
		vld.value="";
	}
	else
	{
		vld.setAttribute("type", "hidden");
		switch(optvld.value)
		{
			case "2":
				vld.setAttribute("value", "^[a-zA-Z]+$");
				break;
			case "3":
				vld.setAttribute("value", "^[0-9]+$");
				break;
			case "4":
				vld.setAttribute("value", "^[a-zA-Z0-9]+$");
				break;
			case "5":
				vld.setAttribute("value", "^[a-zA-Z0-9_\\-\\.]+@[a-zA-Z0-9_\\-]+(\\.[a-zA-Z0-9\\-]+)+$");
				break;
			case "6":
				vld.setAttribute("value", "^https?://[a-zA-Z0-9_\\-]+(\\.[a-zA-Z0-9_\\-]+)+(/[a-zA-Z0-9;%&#=/_\\-\\.\\?]*)?$");
				break;
		}
	}
	
	var opts=optvld.childNodes;
	var optct=opts.length;
	for( var i=0; i<optct; i++)
	{
		if( opts[i].hasAttribute("selected") )
			opts[i].removeAttribute("selected");
	}
	
	document.getElementById("optvld"+id.toString()+"_"+optvld.value).setAttribute("selected", "true");
}

function vldnumberchange(id)
{
	var n1=document.getElementById("vld"+id.toString()+"_1");
	var n2=document.getElementById("vld"+id.toString()+"_2");
	if( !( n1.value=="" || !n1.value || n2.value=="" || !n2.value ) )
	{
		var nmin=parseInt(n1.value);
		var nmax=parseInt(n2.value);
		if( isNaN(n1.value) || isNaN(n2.value) || isNaN(nmin) || isNaN(nmax) )
		{
			alert("請輸入數字！");
			n1.value="";
			n2.value="";
			n1.setAttribute("value", "");
			n2.setAttribute("value", "");
			n1.focus();
		}
		else
		{
			if( nmin>nmax )
			{
				alert("最大值必須 大於等於 最小值！");
				n1.value="";
				n2.value="";
				n1.setAttribute("value", "");
				n2.setAttribute("value", "");
				n1.focus();
			}
			else
			{
				var vld=document.getElementById("vld"+id.toString());
				vld.value=n1.value+"||"+n2.value;
				vld.setAttribute("value", n1.value+"||"+n2.value);
			}
		}
	}
}

function chkvldchange(id, typ)
{
	var chkvld=document.getElementById("chkvld"+id.toString());
	var vldwrap=document.getElementById("vldwrapper"+id.toString());
	var vld=document.getElementById("vld"+id.toString());
	if( chkvld.checked )
	{
		vldwrap.style.display="inline-block";
		if( typ=="text" )
		{
			optvldchange(id);
		}
		else if( typ=="number" )
		{
			var ndmin=document.getElementById("vld"+id.toString()+"_1");
			var ndmax=document.getElementById("vld"+id.toString()+"_2");
			ndmin.setAttribute("required", "true");
			ndmax.setAttribute("required", "false");
		}
	}
	else
	{
		vldwrap.style.display="none";
		vld.value="";
		if( typ=="number" )
		{
			var ndmin=document.getElementById("vld"+id.toString()+"_1");
			var ndmax=document.getElementById("vld"+id.toString()+"_2");
			ndmin.value="";
			ndmin.setAttribute("value", "");
			ndmin.removeAttribute("required");
			ndmax.value="";
			ndmax.setAttribute("value", "");
			ndmax.removeAttribute("required");
		}
	}
}

function createOptions(id, typ, pbl, req, vld, vldtxt)
{
	var req=(typeof req==="undefined")?0:req;
	var pbl=(typeof pbl==="undefined")?0:pbl;
	var vld=(typeof vld==="undefined")?0:vld;
	var vldtxt=(typeof vldtxt==="undefined")?"":vldtxt;
	
	var nd=document.createElement("div");
	nd.setAttribute("class", "innerblock");
	
	
	var nodepbl=document.createElement("input");
	nodepbl.setAttribute("name", "pbl" + id.toString());
	nodepbl.setAttribute("type", "checkbox");
	if( pbl ) nodepbl.setAttribute("checked", "true");
	if( dis ) nodepbl.setAttribute("disabled", "true");
	var nodepbltxt=document.createTextNode("公開欄位");
	
	var nodenewline=document.createElement("br");
	
	var nodereq=document.createElement("input");
	nodereq.setAttribute("name", "req" + id.toString());
	nodereq.setAttribute("type", "checkbox");
	if( req ) nodereq.setAttribute("checked", "true");
	var nodereqtxt=document.createTextNode("必填欄位");
	
	var nodenewline2=document.createElement("br");
	
	
	if( typ=="text" )
	{
		var ndchkvalid=document.createElement("input");
		ndchkvalid.setAttribute("id", "chkvld" + id.toString());
		ndchkvalid.setAttribute("name", "chkvld" + id.toString());
		ndchkvalid.setAttribute("type", "checkbox");
		if( vld )
			ndchkvalid.setAttribute("checked", "true");
		ndchkvalid.setAttribute("value", "1");
		ndchkvalid.setAttribute("onclick", "chkvldchange(" + id.toString() + ", \"" + typ + "\")");
		var ndchkvalidtxt=document.createTextNode("欄位驗證");
		var nodenewline3=document.createElement("br");
		
		var ndwrapper=document.createElement("div");
		ndwrapper.setAttribute("id", "vldwrapper" + id.toString());
		if( vld )
			ndwrapper.setAttribute("style", "display: inline-block;");
		else
			ndwrapper.setAttribute("style", "display: none;");
		var nds=document.createElement("select");
		nds.setAttribute("id", "optvld" + id.toString());
		nds.setAttribute("name", "optvld" + id.toString());
		nds.setAttribute("onchange", "optvldchange(" + id.toString() + ")");
		var ndo=document.createElement("option");
		ndo.setAttribute("id", "optvld"+id+"_2");
		ndo.setAttribute("value", "2");
		if( vld==2 ) ndo.setAttribute("selected", "true");
		var ndotxt=document.createTextNode("英文字母");
		ndo.appendChild(ndotxt);
		nds.appendChild(ndo);
		ndo=document.createElement("option");
		ndo.setAttribute("id", "optvld"+id+"_3");
		ndo.setAttribute("value", "3");
		if( vld==3 ) ndo.setAttribute("selected", "true");
		var ndotxt=document.createTextNode("數字");
		ndo.appendChild(ndotxt);
		nds.appendChild(ndo);
		ndo=document.createElement("option");
		ndo.setAttribute("id", "optvld"+id+"_4");
		ndo.setAttribute("value", "4");
		if( vld==4 ) ndo.setAttribute("selected", "true");
		var ndotxt=document.createTextNode("英文字母及數字");
		ndo.appendChild(ndotxt);
		nds.appendChild(ndo);
		ndo=document.createElement("option");
		ndo.setAttribute("id", "optvld"+id+"_5");
		ndo.setAttribute("value", "5");
		if( vld==5 ) ndo.setAttribute("selected", "true");
		var ndotxt=document.createTextNode("E-mail");
		ndo.appendChild(ndotxt);
		nds.appendChild(ndo);
		ndo=document.createElement("option");
		ndo.setAttribute("id", "optvld"+id+"_6");
		ndo.setAttribute("value", "6");
		if( vld==6 ) ndo.setAttribute("selected", "true");
		var ndotxt=document.createTextNode("網址");
		ndo.appendChild(ndotxt);
		nds.appendChild(ndo);
		ndo=document.createElement("option");
		ndo.setAttribute("id", "optvld"+id+"_1");
		ndo.setAttribute("value", "1");
		if( vld==1 ) ndo.setAttribute("selected", "true");
		var ndotxt=document.createTextNode("自訂");
		ndo.appendChild(ndotxt);
		nds.appendChild(ndo);
		var nodenewline4=document.createElement("br");
		var ndregex=document.createElement("input");
		ndregex.setAttribute("id", "vld" + id.toString());
		ndregex.setAttribute("name", "vld" + id.toString());
		if( vld==1 )
		{
			ndregex.setAttribute("type", "text");
		}
		else
			ndregex.setAttribute("type", "hidden");
		if( vld )
			ndregex.setAttribute("value", vldtxt);
		ndregex.setAttribute("size", "15");
		ndregex.setAttribute("style", "margin-top: 0px");
		
		ndwrapper.appendChild(nds);
		ndwrapper.appendChild(nodenewline4);
		ndwrapper.appendChild(ndregex);
	}
	else if( typ=="number" )
	{
		var ndchkvalid=document.createElement("input");
		ndchkvalid.setAttribute("id", "chkvld" + id.toString());
		ndchkvalid.setAttribute("name", "chkvld" + id.toString());
		ndchkvalid.setAttribute("type", "checkbox");
		if( vld==-1 )
			ndchkvalid.setAttribute("checked", "true");
		ndchkvalid.setAttribute("value", "1");
		ndchkvalid.setAttribute("onclick", "chkvldchange(" + id.toString() + ", \"" + typ + "\")");
		var ndchkvalidtxt=document.createTextNode("欄位驗證");
		var nodenewline3=document.createElement("br");
		
		var ndwrapper=document.createElement("div");
		ndwrapper.setAttribute("id", "vldwrapper" + id.toString());
		if( vld==-1 )
			ndwrapper.setAttribute("style", "display: inline-block;");
		else
			ndwrapper.setAttribute("style", "display: none;");
		var ndopt=document.createElement("input");
		ndopt.setAttribute("id", "optvld" + id.toString());
		ndopt.setAttribute("name", "optvld" + id.toString());
		ndopt.setAttribute("type", "hidden");
		ndopt.setAttribute("value", "-1");
		
		var tmpvld;
		if( vld==-1 )
			tmpvld=vldtxt.split("||");
		var ndmin=document.createElement("input");
		ndmin.setAttribute("id", "vld"+id.toString()+"_1");
		ndmin.setAttribute("name", "vld"+id.toString()+"_1");
		ndmin.setAttribute("type", "text");
		ndmin.setAttribute("style", "width: 3em;");
		ndmin.setAttribute("placeholder", "最小");
		ndmin.setAttribute("onchange", "vldnumberchange(" + id.toString() + ")");
		if( vld==-1 )
		{
			ndmin.setAttribute("required", "true");
			ndmin.setAttribute("value", tmpvld[0]);
		}
		
		ndtxtto=document.createTextNode(" ~ ");
		
		var ndmax=document.createElement("input");
		ndmax.setAttribute("id", "vld"+id.toString()+"_2");
		ndmax.setAttribute("name", "vld"+id.toString()+"_2");
		ndmax.setAttribute("type", "text");
		ndmax.setAttribute("style", "width: 3em;");
		ndmax.setAttribute("placeholder", "最大");
		ndmax.setAttribute("onchange", "vldnumberchange(" + id.toString() + ")");
		if( vld==-1 )
		{
			ndmax.setAttribute("required", "true");
			ndmax.setAttribute("value", tmpvld[1]);
		}
		
		var ndvld=document.createElement("input");
		ndvld.setAttribute("id", "vld"+id.toString());
		ndvld.setAttribute("name", "vld"+id.toString());
		ndvld.setAttribute("type", "hidden");
		if( vld==-1 )
			ndvld.setAttribute("value", vldtxt);
		
		ndwrapper.appendChild(ndopt);
		ndwrapper.appendChild(ndmin);
		ndwrapper.appendChild(ndtxtto);
		ndwrapper.appendChild(ndmax);
		ndwrapper.appendChild(ndvld);
	}
	
	nd.appendChild(nodepbl);
	nd.appendChild(nodepbltxt);
	nd.appendChild(nodenewline);
	nd.appendChild(nodereq);
	nd.appendChild(nodereqtxt);
	nd.appendChild(nodenewline2);
	
	if( typ=="text" )
	{
		nd.appendChild(ndchkvalid);
		nd.appendChild(ndchkvalidtxt);
		nd.appendChild(nodenewline3);
		nd.appendChild(ndwrapper);
	}
	else if( typ=="number" )
	{
		nd.appendChild(ndchkvalid);
		nd.appendChild(ndchkvalidtxt);
		nd.appendChild(nodenewline3);
		nd.appendChild(ndwrapper);
	}
	
	return nd;
}

function createOperations(id)
{
	var nd=document.createElement("div");
	nd.setAttribute("class", "innerblock");
	
	var noderm=document.createElement("input");
	noderm.setAttribute("type", "button");
	noderm.setAttribute("class", "btn");
	noderm.setAttribute("value", "移除欄位"); 
	noderm.setAttribute("onclick", "del(this.parentNode.parentNode.parentNode)");
	
	nd.appendChild(noderm);
	
	return nd;
}

function add(typ)
{
	var regfrm=document.getElementById("reg");
	var id=document.getElementById("idc").value;
	switch(typ)
	{
		case "text":
			var node=document.createElement("div");
			node.setAttribute("id", "div"+id.toString() );
			node.setAttribute("class", "blocknl");
			node.setAttribute("draggable", "true");
			
			var nodei=document.createElement("div");
			nodei.setAttribute("id", "divinner"+id.toString() );
			
			var node0=document.createElement("input");
			node0.setAttribute("name", id);
			node0.setAttribute("type", "hidden");
			node0.setAttribute("value", "text");
			
			
			var na1=document.createElement("div");
			na1.setAttribute("class", "innerblock");
			
			var node1=document.createElement("div");
			node1.setAttribute("id", "rid");
			node1.setAttribute("name", "rid");
			var node1c1=document.createTextNode((++count).toString());
			node1.appendChild(node1c1);
			
			var node2=document.createTextNode(". 標題：");
			
			var node3=createTitle(id);
			
			var node4=document.createElement("br");
			
			var node5=document.createElement("input");
			node5.setAttribute("name", "val" + id.toString());
			node5.setAttribute("type", "text");
			node5.setAttribute("placeholder", "預設回答");
			node5.setAttribute("size", "50");
			
			na1.appendChild(node1);
			na1.appendChild(node2);
			na1.appendChild(node3);
			na1.appendChild(node4);
			na1.appendChild(node5);
			
			var na2=createOptions(id, typ);
			
			var na3=createOperations(id);
					
			nodei.appendChild(node0);
			nodei.appendChild(na1);
			nodei.appendChild(na2);
			nodei.appendChild(na3);
			
			node.appendChild(nodei);
			
			break;
		case "textarea":
			var node=document.createElement("div");
			node.setAttribute("id", "div"+id.toString() );
			node.setAttribute("class", "blocknl");
			node.setAttribute("draggable", "true");
			
			var nodei=document.createElement("div");
			nodei.setAttribute("id", "divinner"+id.toString() );
			
			var node0=document.createElement("input");
			node0.setAttribute("name", id);
			node0.setAttribute("type", "hidden");
			node0.setAttribute("value", "textarea");
			
			
			var na1=document.createElement("div");
			na1.setAttribute("class", "innerblock");
			
			var node1=document.createElement("div");
			node1.setAttribute("id", "rid");
			node1.setAttribute("name", "rid");
			var node1c1=document.createTextNode((++count).toString());
			node1.appendChild(node1c1);
			
			var node2=document.createTextNode(". 標題：");
			
			var node3=createTitle(id);
			
			var node4=document.createElement("br");
			
			var node5=document.createElement("textarea");
			node5.setAttribute("name", "val" + id.toString());
			node5.setAttribute("placeholder", "預設回答");
			node5.setAttribute("rows", "5");
			node5.setAttribute("cols", "40");
			
			na1.appendChild(node1);
			na1.appendChild(node2);
			na1.appendChild(node3);
			na1.appendChild(node4);
			na1.appendChild(node5);
			
			var na2=createOptions(id, typ);
			
			var na3=createOperations(id);
			
			nodei.appendChild(node0);
			nodei.appendChild(na1);
			nodei.appendChild(na2);
			nodei.appendChild(na3);
			
			node.appendChild(nodei);
			
			break;
		case "radio":
			var node=document.createElement("div");
			node.setAttribute("id", "div"+id.toString() );
			node.setAttribute("class", "blocknl");
			node.setAttribute("draggable", "true");
			
			var nodei=document.createElement("div");
			nodei.setAttribute("id", "divinner"+id.toString() );
			
			var node0=document.createElement("input");
			node0.setAttribute("name", id);
			node0.setAttribute("type", "hidden");
			node0.setAttribute("value", "radio");
			
			
			var na1=document.createElement("div");
			na1.setAttribute("class", "innerblock");
			
			var node1=document.createElement("div");
			node1.setAttribute("id", "rid");
			node1.setAttribute("name", "rid");
			var node1s1=document.createTextNode((++count).toString());
			node1.appendChild(node1s1);
			
			var node2=document.createTextNode(". 標題：");
			
			var node3=createTitle(id);
			
			var node4=document.createElement("br");
			
			var node5=document.createElement("div");
			node5.setAttribute("id", "div_val" + id.toString());
			node5.setAttribute("class", "innerblock");
			var node5c1=document.createElement("input");
			node5c1.setAttribute("type", "button");
			node5c1.setAttribute("class", "btn");
			node5c1.setAttribute("value", "增加");
			node5c1.setAttribute("onclick", "addradio('" + id.toString() + "')"); 
			var node5c2=document.createElement("br");
			
			var wrap=document.createElement("div");
			wrap.setAttribute("id", "optwrapper");
			var node5c3=document.createElement("input");
			node5c3.setAttribute("type", "radio");
			node5c3.setAttribute("checked", "true");
			node5c3.setAttribute("disabled", "true");
			var node5c4=document.createElement("input");
			node5c4.setAttribute("name", "val" + id.toString() + "[]");
			node5c4.setAttribute("type", "text");
			node5c4.setAttribute("size", "40");
			var node5c5=document.createElement("input");
			node5c5.setAttribute("type", "button");
			node5c5.setAttribute("value", "刪除");
			node5c5.setAttribute("onclick", "innerRemove(this.parentNode)");
			node5c5.setAttribute("disabled", "true");
			wrap.appendChild(node5c3);
			wrap.appendChild(node5c4);
			wrap.appendChild(node5c5);
			
			node5.appendChild(node5c1);
			node5.appendChild(node5c2);
			node5.appendChild(wrap);
			
			na1.appendChild(node1);
			na1.appendChild(node2);
			na1.appendChild(node3);
			na1.appendChild(node4);
			na1.appendChild(node5);
			
			var na2=createOptions(id, typ);
			
			var na3=createOperations(id);
			
			nodei.appendChild(node0);
			nodei.appendChild(na1);
			nodei.appendChild(na2);
			nodei.appendChild(na3);
			
			node.appendChild(nodei);
			
			break;
		case "checkbox":
			var node=document.createElement("div");
			node.setAttribute("id", "div"+id.toString() );
			node.setAttribute("class", "blocknl");
			node.setAttribute("draggable", "true");
			
			var nodei=document.createElement("div");
			nodei.setAttribute("id", "divinner"+id.toString() );
			
			var node0=document.createElement("input");
			node0.setAttribute("name", id);
			node0.setAttribute("type", "hidden");
			node0.setAttribute("value", "checkbox");
			
			
			var na1=document.createElement("div");
			na1.setAttribute("class", "innerblock");
			
			var node1=document.createElement("div");
			node1.setAttribute("id", "rid");
			node1.setAttribute("name", "rid");
			var node1s1=document.createTextNode((++count).toString());
			node1.appendChild(node1s1);
			
			var node2=document.createTextNode(". 標題：");
			
			var node3=createTitle(id);
			
			var node4=document.createElement("br");
			
			var node5=document.createElement("div");
			node5.setAttribute("id", "div_val" + id.toString());
			node5.setAttribute("class", "innerblock");
			var node5c1=document.createElement("input");
			node5c1.setAttribute("type", "button");
			node5c1.setAttribute("class", "btn");
			node5c1.setAttribute("value", "增加");
			node5c1.setAttribute("onclick", "addcheckbox('" + id.toString() + "')"); 
			var node5c2=document.createElement("br");
			
			var wrap=document.createElement("div");
			wrap.setAttribute("id", "optwrapper");
			var node5c3=document.createElement("input");
			node5c3.setAttribute("type", "checkbox");
			node5c3.setAttribute("checked", "true");
			node5c3.setAttribute("disabled", "true");
			var node5c4=document.createElement("input");
			node5c4.setAttribute("name", "val" + id.toString() + "[]");
			node5c4.setAttribute("type", "text");
			node5c4.setAttribute("size", "40");
			var node5c5=document.createElement("input");
			node5c5.setAttribute("type", "button");
			node5c5.setAttribute("value", "刪除");
			node5c5.setAttribute("onclick", "innerRemove(this.parentNode)");
			node5c5.setAttribute("disabled", "true");
			wrap.appendChild(node5c3);
			wrap.appendChild(node5c4);
			wrap.appendChild(node5c5);
			
			node5.appendChild(node5c1);
			node5.appendChild(node5c2);
			node5.appendChild(wrap);
			
			na1.appendChild(node1);
			na1.appendChild(node2);
			na1.appendChild(node3);
			na1.appendChild(node4);
			na1.appendChild(node5);
			
			var na2=createOptions(id, typ);
			
			var na3=createOperations(id);
			
			nodei.appendChild(node0);
			nodei.appendChild(na1);
			nodei.appendChild(na2);
			nodei.appendChild(na3);
			
			node.appendChild(nodei);
			
			break;
		case "listbox":
			var node=document.createElement("div");
			node.setAttribute("id", "div"+id.toString() );
			node.setAttribute("class", "blocknl");
			node.setAttribute("draggable", "true");
			
			var nodei=document.createElement("div");
			nodei.setAttribute("id", "divinner"+id.toString() );
			
			var node0=document.createElement("input");
			node0.setAttribute("name", id);
			node0.setAttribute("type", "hidden");
			node0.setAttribute("value", "listbox");
			
			
			var na1=document.createElement("div");
			na1.setAttribute("class", "innerblock");
			
			var node1=document.createElement("div");
			node1.setAttribute("id", "rid");
			node1.setAttribute("name", "rid");
			var node1s1=document.createTextNode((++count).toString());
			node1.appendChild(node1s1);
			
			var node2=document.createTextNode(". 標題：");
			
			var node3=createTitle(id);
			
			var node4=document.createElement("br");
			
			var node5=document.createElement("div");
			node5.setAttribute("id", "div_val" + id.toString());
			node5.setAttribute("class", "innerblock");
			var node5c1=document.createElement("input");
			node5c1.setAttribute("type", "button");
			node5c1.setAttribute("class", "btn");
			node5c1.setAttribute("value", "增加");
			node5c1.setAttribute("onclick", "addlistbox('" + id.toString() + "')");
			var node5c2=document.createElement("br");
			
			var wrap=document.createElement("div");
			wrap.setAttribute("id", "optwrapper");
			
			var node5c3=document.createElement("input");
			node5c3.setAttribute("name", "val" + id.toString() + "[]");
			node5c3.setAttribute("type", "text");
			node5c3.setAttribute("size", "40");
			node5c3.setAttribute("class", "list_box_first");
			var node5c4=document.createElement("input");
			node5c4.setAttribute("type", "button");
			node5c4.setAttribute("value", "刪除");
			node5c4.setAttribute("style", "margin: 0px");
			node5c4.setAttribute("onclick", "innerRemove(this.parentNode)");
			node5c4.setAttribute("disabled", "true");
			wrap.appendChild(node5c3);
			wrap.appendChild(node5c4);
			
			node5.appendChild(node5c1);
			node5.appendChild(node5c2);
			node5.appendChild(wrap);
			
			na1.appendChild(node1);
			na1.appendChild(node2);
			na1.appendChild(node3);
			na1.appendChild(node4);
			na1.appendChild(node5);
			
			var na2=createOptions(id, typ);
			
			var na3=createOperations(id);
			
			nodei.appendChild(node0);
			nodei.appendChild(na1);
			nodei.appendChild(na2);
			nodei.appendChild(na3);
			
			node.appendChild(nodei);
			
			break;
		case "number":
			var node=document.createElement("div");
			node.setAttribute("id", "div"+id.toString() );
			node.setAttribute("class", "blocknl");
			node.setAttribute("draggable", "true");
			
			var nodei=document.createElement("div");
			nodei.setAttribute("id", "divinner"+id.toString() );
			
			var node0=document.createElement("input");
			node0.setAttribute("name", id);
			node0.setAttribute("type", "hidden");
			node0.setAttribute("value", "number");
			
			
			var na1=document.createElement("div");
			na1.setAttribute("class", "innerblock");
			
			var node1=document.createElement("div");
			node1.setAttribute("id", "rid");
			node1.setAttribute("name", "rid");
			var node1c1=document.createTextNode((++count).toString());
			node1.appendChild(node1c1);
			
			var node2=document.createTextNode(". 標題：");
			
			var node3=createTitle(id);
			
			var node4=document.createElement("br");
			
			var node5=document.createElement("input");
			node5.setAttribute("name", "val" + id.toString());
			node5.setAttribute("type", "number");
			node5.setAttribute("value", "0");
			node5.setAttribute("size", "30");
			
			na1.appendChild(node1);
			na1.appendChild(node2);
			na1.appendChild(node3);
			na1.appendChild(node4);
			na1.appendChild(node5);
			
			var na2=createOptions(id, typ);
			
			var na3=createOperations(id);
			
			nodei.appendChild(node0);
			nodei.appendChild(na1);
			nodei.appendChild(na2);
			nodei.appendChild(na3);
			
			node.appendChild(nodei);
			
			break;
		default:
			break;
	}
	addListen(node);
	document.getElementById("reg").appendChild(node);
	document.getElementById("idc").value=parseInt(id)+1;
}

function del(nd)
{
	nd.parentNode.removeChild(nd);
	count--;
	var tmp=document.getElementsByName("rid");
	if( !tmp )
	{
	}
	else if( !tmp.length )
	{
		tmp.innerHTML="1";
	}
	else
	{
		for( i=1; i<=count; i++ )
		{
			tmp[i-1].innerHTML=i.toString();
		}
	}
}

var dSrc=null;

function swaprid(f, t)
{
	var tmp=document.querySelector("#div"+f+" #rid").innerHTML;
	document.querySelector("#div"+f+" #rid").innerHTML=document.querySelector("#div"+t+" #rid").innerHTML;
	document.querySelector("#div"+t+" #rid").innerHTML=tmp;
}

function changeid(f, t)
{
	var tmp=document.getElementsByName( f )[0];
	var typ=tmp.getAttribute("value");
	
	document.getElementById( "divinner"+f ).id="divinner"+t;
	document.getElementsByName( f )[0].name=t;
	document.getElementsByName( "title"+f )[0].name="title"+t;
	if( document.getElementById( "div_val"+f ) )
	{
		document.getElementById( "div_val"+f ).id="div_val"+t;
		var vals=[].slice.call(document.getElementsByName("val"+f+"[]"));
		var valct=vals.length;
		for( var i=0; i<valct; i++ )
			vals[i].name="val"+t+"[]";
	}
	else
	{
		document.getElementsByName( "val"+f )[0].name="val"+t;
	}
	document.getElementsByName( "pbl"+f )[0].name="pbl"+t;
	document.getElementsByName( "req"+f )[0].name="req"+t;
	
	
	if( typ=="text" )
	{
		var tmp=document.getElementById( "chkvld"+f );
		tmp.name="chkvld"+t;
		tmp.setAttribute("onclick", "chkvldchange("+t+", \""+typ+"\")");
		tmp.id="chkvld"+t;
	
		document.getElementById( "vldwrapper"+f ).id="vldwrapper"+t;
	
		var tmp=document.getElementById( "optvld"+f );
		var tmp2=tmp.childNodes; var tmp2l=tmp2.length;
		for( var i=0; i<tmp2l; i++ )
		{
			var pat=new RegExp("optvld"+f+"_([0-9]+)");
			tmp2[i].id=tmp2[i].id.replace(pat, "optvld" + t + "_$1");
		}
		tmp.name="optvld"+t;
		tmp.setAttribute("onchange", "optvldchange("+t+")");
		tmp.id="optvld"+t;
		var tmp=document.getElementById( "vld"+f );
		tmp.name="vld"+t;
		tmp.id="vld"+t;
	}
	else if( typ=="number" )
	{
		var tmp=document.getElementById( "chkvld"+f );
		tmp.name="chkvld"+t;
		tmp.setAttribute("onclick", "chkvldchange("+t+", \""+typ+"\")");
		tmp.id="chkvld"+t;
	
		document.getElementById( "vldwrapper"+f ).id="vldwrapper"+t;
	
		var tmp=document.getElementById( "optvld"+f );
		tmp.name="optvld"+t;
		tmp.id="optvld"+t;
		var tmp=document.getElementById( "vld"+f+"_1" );
		tmp.name="vld"+t+"_1";
		tmp.setAttribute("onchange", "vldnumberchange("+t+")");
		tmp.id="vld"+t+"_1";
		var tmp=document.getElementById( "vld"+f+"_2" );
		tmp.name="vld"+t+"_2";
		tmp.setAttribute("onchange", "vldnumberchange("+t+")");
		tmp.id="vld"+t+"_2";
		var tmp=document.getElementById( "vld"+f );
		tmp.name="vld"+t;
		tmp.id="vld"+t;
	}
}

function hdStart(e)
{
	this.style.opacity=0.6;
	
	dSrc=this;
	e.dataTransfer.effectAllowed="move";
	e.dataTransfer.setData("text/html", this.innerHTML);
}

function hdEnter(e)
{
	this.classList.add("dover");
}

function hdOver(e)
{
	if( e.preventDefault )
		e.preventDefault();
	
	e.dataTransfer.dropEffect="move";
}

function hdLeave(e)
{
	this.classList.remove("dover");
}

function hd(e)
{
	if( e.stopPropagation )
		e.stopPropagation();
	
	if( dSrc != this )
	{
		var sid=dSrc.id.substr(3), eid=this.id.substr(3);
		
		var scontent=dSrc.childNodes[0].cloneNode(true);
		var econtent=this.childNodes[0].cloneNode(true);
		
		dSrc.removeChild(dSrc.childNodes[0]);
		this.removeChild(this.childNodes[0]);
		dSrc.appendChild(econtent);
		this.appendChild(scontent);
		
		changeid(sid, "tmp");
		changeid(eid, sid);
		changeid("tmp", eid);
		swaprid(sid, eid);
	}
	
	return false;
}

function hdEnd(e)
{
	dSrc.style.opacity=1;
	var ctrls=document.querySelectorAll("#reg .blocknl");
	var ctrlct=ctrls.length;
	for( var i=0; i<ctrlct; i++ )
	{
		ctrls[i].classList.remove("dover");
	}
}

function addListen(nd)
{
	nd.addEventListener("dragstart", hdStart, false);
	nd.addEventListener("dragenter", hdEnter, false);
	nd.addEventListener("dragover", hdOver, false);
	nd.addEventListener("dragleave", hdLeave, false);
	nd.addEventListener("drop", hd, false);
	nd.addEventListener("dragend", hdEnd, false);
}

window.onresize=function(){
	document.getElementsByName("frm_final")[0].style.height=window.innerHeight - 250 + "px";
}