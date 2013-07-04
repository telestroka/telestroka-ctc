function clean(value,text)
{
	if (value==text) value="";
	return value;
}

function add2favor()
{
	if (navigator.appName == "Microsoft Internet Explorer" && parseFloat(navigator.appVersion) >= 4.0)
		window.external.AddFavorite(location.href, document.title);
	else
		window.alert("Ваш браузер не поддерживает данную функцию.");
}

function show_hide(id)
{
	element = document.getElementById(id);
	element_icon = document.getElementById(id + "_icon");
	status = (element.style.display == "none") ? "open" : "close";
	element_icon.src = "images/design/" + status + ".gif";
	element.style.display = (element.style.display == "none") ? "block" : "none";
}

function explode(delimiter, string) {
	var emptyArray = { 0: '' };

	if ( arguments.length != 2
		|| typeof arguments[0] == 'undefined'
		|| typeof arguments[1] == 'undefined' )
	{
		return null;
	}

	if ( delimiter === ''
		|| delimiter === false
		|| delimiter === null )
	{
		return false;
	}

	if ( typeof delimiter == 'function'
		|| typeof delimiter == 'object'
		|| typeof string == 'function'
		|| typeof string == 'object' )
	{
		return emptyArray;
	}

	if ( delimiter === true ) {
		delimiter = '1';
	}

	return string.toString().split ( delimiter.toString() );
}