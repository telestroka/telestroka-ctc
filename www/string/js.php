<?php
/***********************************************
-=Ms Site=-

Модуль: String
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: JavaScript для строковой рекламы
***********************************************/
$string = 'var price_array=new Array(';
foreach ($string_price_array as $string_price_params)
{
    $string.='{day:"' . $string_price_params['day'] . '",evening:"' . $string_price_params['evening'] . '",all:"' . $string_price_params['all'] . '"},';
}
$string=substr($string, 0, -1);
echo $string .= ');
';
?>
	
function order_change()
{   
	var string_id = <?=$string_id;?>;
    var text = document.order.text.value;
    var phones = document.order["phones"].value;
    var num = document.order.num.value;
	var type = document.order.type.value;
	var time = document.order.time.value;
	var discounts = Array(<?=$discounts_js;?>);
	var discount = parseInt(num) - 1; discount = discounts[discount];
	
	text = text.replace(/^\s+/, '');
	text = text.replace(/\s+$/, '');
	text = text.replace(/-/g, ' ');
	text = text.replace(/\\/g, ' ');
	text = text.replace(/\//g, ' ');
	words = explode(' ', text);
	words = words.length;
	if (text == "") words = 0;	
	
	var phones_words = phones.split("\n");
	phones_words = phones_words.length;
	if (phones == "") phones_words = 0;
	var total_words = words+phones_words*5;
	
	if (!is_digital(num)) num = document.order.num.value = 1;
	
    var summa;
	
	if (time==1)  price = price_array[type].day;
	if (time==2)  price = price_array[type].evening;
	if (time==3)  price = price_array[type].all;
	price = price - price * discount / 100;	
	summa = num*price*total_words;
	document.getElementById("total_summa").innerHTML = formatFloat(summa,2);
	
	document.getElementById("discount").innerHTML = discount;
}