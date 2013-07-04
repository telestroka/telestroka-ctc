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

function change_maketing()
{
	if (document.order.maketing.checked)
	{
		document.getElementById('maketing_false').style.display='none';
		document.getElementById('maketing_true').style.display='block';
		document.getElementById('maketing_true_text').style.display='block';
	}
	else
	{
		document.getElementById('maketing_false').style.display='block';
		document.getElementById('maketing_true').style.display='none';
		document.getElementById('maketing_true_text').style.display='none';
	}
}

function size_change()
{
	var list = document.order.size ;
    area = list.options[list.selectedIndex].value;
    document.getElementById("sample").style.width=(price_array[list.selectedIndex].width)/2+"px";
    document.getElementById("sample").style.height=(price_array[list.selectedIndex].height)/2+"px";
	return(true);
}

function order_check()
{
	form=document.order;
	if ( !is_email(form.email.value) && !is_empty(form.email.value) ) { alert("Введен несуществующий адрес e-mail"); form.email.style.background="#EE9D9A"; return(false); }
	if ( !is_right_length(form.text.value, 0, 2000) )	{ alert("Текст сообщения должен быть от 0 до 2000 символов"); form.text.style.background="#EE9D9A"; return(false); }

	if (form.company.value=='' && form.name.value=='' && form.phone.value=='' && form.email.value=='' && form.file.value=='' && form.text.value=='') { alert("Форма должна быть заполнена"); return(false); }
}

function close_maket()
{
	opener.document.order.area.selectedIndex=document.order.size.selectedIndex;
	opener.order_change();
	window.close();
}       
