
function GetXmlHttpObject()
{
	var xmlHttp=null;
	try
	  {
	  // Firefox, Opera 8.0+, Safari
	 
	  xmlHttp=new XMLHttpRequest();
	   
	  }
	catch (e)
	  {
	  // Internet Explorer
	  try
	    {
	   
	    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
	     
	    }
	  catch (e)
	    {
	    
	    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	    
	    }
	  }
	return xmlHttp;
}

function ajaxRequest(action,div){
	xmlHttp = GetXmlHttpObject();
	document.getElementById(div).innerHTML="<center>Please wait...</center>";
	xmlHttp.onreadystatechange=function(){stateChanged(div);}
	xmlHttp.open("GET",action,true);
	xmlHttp.send(null);
}
function stateChanged(div){ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){	
		document.getElementById(div).innerHTML =xmlHttp.responseText;
	}
}
