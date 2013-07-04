function is_system(string)
{
	   re = /\W/;
	   if (re.test(string)) return(false);
	   return(true);
}

function is_right_length(string,min,max)
{
	   if ( string.length>max ) return(false);
	   if ( string.length<min ) return(false);
	   return(true);
}

function is_empty(string)
{
	   if ( string.length>0 ) return(false);
	   return(true);
}

function is_email(string)
{
	if ( string.length<6 ) return(false);
	if (string.indexOf('@') == -1) return(false);
	if (string.indexOf('.') == -1) return(false);
	return(true);
}

function is_url(string)
{
	if ( string.length<4 ) return(false);
	if (string.indexOf('.') == -1) return(false);
	return(true);
}

function is_icq(string)
{
   if ( string.length>9 ) return(false);
   if ( string.length<5 ) return(false);
   re = /\d/;
   if (re.test(string)) return(true);
   return(false);
}

function is_digital(string)
{
	   re = /\d/;
	   if (re.test(string)) return(true);
	   return(false);
}

function is_ip(string)
{
	   if ( string.length>15 ) return(false);
	   if ( string.length<7 ) return(false);
	   re = /\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/;
	   if (re.test(string)) return(true);
	   return(false);
}

function is_image(string)
{
	string = string.toLowerCase();	
	if (string.indexOf('.jpg') != -1) return(true);
	if (string.indexOf('.jpeg') != -1) return(true);
	if (string.indexOf('.gif') != -1) return(true);
	if (string.indexOf('.png') != -1) return(true);
	return(false);
}




//other
function set_error(field, error)
{
	alert(error);
	field.style.background="#EE9D9A";
	return(false);
}

