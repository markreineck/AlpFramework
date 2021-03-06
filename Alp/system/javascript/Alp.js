/*
Copyright (c) 2012-2015 Nth Generation. All rights reserved.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*/

function SetFieldValue (val, dest)
{
	d = document.getElementById(dest);
	if (d) {
		if (d.tagName && d.tagName.toLowerCase() == "input")
			d.value = val;
		else
			d.innerHTML = val;
	}
}

function CopyOptValue (src, dest)
{
	
	var s = document.getElementById(src);
	var d = document.getElementById(dest);
	var value = s[s.selectedIndex].value;

	for(var i=0; i < d.options.length; i++)
	{
		if(d.options[i].value === value) {
			d.getElementsByTagName('option')[i].selected=true;
			break;
		}
	}
}

function CopyFieldValue (src, dest)
{
	d = document.getElementById(dest);
	if (d) {
		s = document.getElementById(src);
		var val = '';
		if (s) {
			if (s.tagName && s.tagName.toLowerCase() == "input")
				val = s.value;
			else
				val = s.innerHTML;
		}
		if (d.tagName && d.tagName.toLowerCase() == "input")
			d.value = val;
		else
			d.innerHTML = val;
	}
}

function CopyFields(src, dest)
{
	for (var x=0; x<src.length && x<dest.length; x++) {
		CopyFieldValue (src[x], dest[x])
	}
}


function ShowTag (tagid) 
{
	tag = document.getElementById(tagid);
	if(tag){
		if (tag.tagName && tag.tagName.toLowerCase() == "tr")
			tag.style.display = 'table-row';
		else tag.style.display = 'block';
	}
}

function HideTag (tagid)
{
	tag = document.getElementById(tagid);
	if (tag)
		tag.style.display = 'none';
}

function TextBoxAutoTab(currentControl, maxLength, nextControl)
{
	if (document.getElementById(currentControl).value.length >= maxLength) {
		document.getElementById(nextControl).focus();
		document.getElementById(nextControl).select();
	} else {
		document.getElementById(currentControl).focus();    
	}
}

function DoCapitalization(str)
{
	toreturn='';
	firstchar = str.charAt(0);
	therest = str.substr(1);
	firstcharupper = firstchar.toUpperCase();

	haslowers = false;
	hasuppers = false;
	for (ctr2=0; ctr2<str.length; ctr2++) {
		thischar=str.charAt(ctr2);
		if (isNaN(thischar) && thischar != " ") {
			if (thischar == thischar.toLowerCase())	
				haslowers = true;
			if (thischar == thischar.toUpperCase())	
				hasuppers = true;
		}
		
		if (haslowers && hasuppers)
			break;
	}
	
	
	if (haslowers && hasuppers)
		toreturn += str;
	else
		toreturn += firstcharupper + therest.toLowerCase();

	return toreturn;
}

function EmailAddressOK (str)
{
	var matches = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
     
	if (matches.test(str)) { 
		return true;
	} else {
		return false;
	}
}

function IsUrl (urlstr) {
var validatestr = /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/; 
	if (validatestr.test(urlstr)) {
		return true;
	} else {
		return false; 
	}
}

function IsDigits(field, len)
{
var mtch= /[0-9]$/
	
	if (len > 0 && field.length < len)
		return false;

	if (mtch.test(field))
		return true;
	else
		return false;
}

function IsNumber(n)
{
	return !isNaN(parseFloat(n)) && isFinite(n);
}

function IsDate(value)
{
	var date = new Date(value);
	if (date)
		return true;
	else
		return false;
}