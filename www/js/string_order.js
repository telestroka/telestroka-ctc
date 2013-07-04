function formatFloat(src,digits)
{
var powered, tmp, result
// make sure it is number
if (isNaN(src)) return src;

// 10^digits
var powered = Math.pow(10,digits);

var tmp = src*powered;

// round tmp
tmp = Math.round(tmp);

// get result
var result = tmp/powered;
/*
result=result.toString();
a=result.indexOf(".");
b=result.substr(a,10);
if(b==result) result=result+".00";
if(b.length==0) result=result+".00";
if(b.length==1) result=result+"00";
if(b.length==2) result=result+"0";
*/
return result;
}

function order_check()
{
	var form = document.order;
	if ( !is_right_length(form.text.value, 0, 2000) )	{ alert("Текст сообщения должен быть от 0 до 2000 символов"); form.text.style.background="#EE9D9A"; return(false); }
	if ( !is_right_length(form.phones.value, 0, 2000) )	{ alert("Текст сообщения должен быть от 0 до 2000 символов"); form.phones.style.background="#EE9D9A"; return(false); }

	if (form.name.value=='' && form.phone.value=='') { alert("Форма должна быть заполнена"); return(false); }
	
	createCookie('text', form.text.value, 365);
	createCookie('phones', form.phones.value, 365);
	createCookie('kupon', form.kupon.value, 365);
	createCookie('duplicate', form.duplicate.checked ? 1 : 0, 365);
	createCookie('name', form.name.value, 365);
	createCookie('phone', form.phone.value, 365);
}

function close_maket()
{
	opener.document.order.area.selectedIndex=document.order.size.selectedIndex;
	opener.order_change();
	window.close();
}       

window.onload = function() {
	var form = document.order;
	form.text.value = ReadCookie('text');
	form.phones.value = ReadCookie('phones');
	form.kupon.value = ReadCookie('kupon');
	form.duplicate.checked = (ReadCookie('duplicate') == '1') ? true : false;
	form.name.value = ReadCookie('name');
	form.phone.value = ReadCookie('phone');
}