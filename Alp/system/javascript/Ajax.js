var htmlsection;
var debugholder;

function GetXmlHttpObject(){
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		return new XMLHttpRequest();
	}
	if (window.ActiveXObject){
		// code for IE6, IE5
		return new ActiveXObject("Microsoft.XMLHTTP");
	}	  
		return null;
}

function showLoader(){
}

function hideLoader(){
};

function debugmsg(msg){
	if (debugholder != '') {
		r = document.getElementById(debugholder);
		if (r) {
			r.innerHTML += msg;
		}
	}
}

function AjaxSink(){
	debugmsg('.');

	if (xmlhttp.readyState==4){	
		debugmsg('received');
		var response = xmlhttp.responseText;
		if (response) {
			ajaxsect = document.getElementById(htmlsection);
			if (ajaxsect)
				ajaxsect.innerHTML = response;
			else
				debugmsg('<br>No element with id=' + htmlsection + ' was found.');
		}
	}
}

function AppendArg (args, input)
{
	if (input.name.length > 0 && input.value.length > 0) {
		if (args.length > 0)
			args += '&';
		if (input.type == "radio") {
			if (input.checked)
				args += input.name + '=' + input.value;
		} else {
			args += input.name + '=' + input.value;
		}
	}
	return args;
}

function FindArgs (args, form, type)
{
	inputs = form.getElementsByTagName(type);
	for (x = 0; x < inputs.length; ++x) {
		args = AppendArg (args, inputs[x]);
	}
	return args;
}

function DoAjaxFromForm(form, func, sect, args, getpost, debugdiv)
{
	if (form.nodeName != "FORM")
		form = form.form;

	args = FindArgs (args, form, 'input');
	args = FindArgs (args, form, 'textarea');
	args = FindArgs (args, form, 'select');

	DoAjaxFill(func, sect, args, getpost, debugdiv);
}

function DoAjaxFromFields(func, sect, args, fields, getpost, debugdiv)
{
	for (var x=0; x<fields.length; x++) {
		r = document.getElementById(fields[x]);
		if (r) {
			if (args.length > 0)
				args = args + "&";
			args = args + fields[x] + "=" + r.value;
		}
	}
	DoAjaxFill(func, sect, args, getpost, getpost, debugdiv);
}

function DoAjaxFill(func, sect, args, getpost, debugdiv)
{
	showLoader();
	htmlsection = sect;
	debugholder = debugdiv;
	var url = ajaxurl + func;
	debugmsg("<br>" + getpost + ": " + url);

	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null){
		alert ("Browser does not support HTTP Request");
		return;
	}
	xmlhttp.onreadystatechange=AjaxSink;
	if (getpost == 'POST' && args.length > 0) {
		xmlhttp.open("POST",url,true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		debugmsg("<br>Send: " + args);
		xmlhttp.send(args);
	} else {
		if (args.length > 0)
			url = url + "?" + args;
		xmlhttp.open(getpost,url,true);
		xmlhttp.send(null);
	}
}