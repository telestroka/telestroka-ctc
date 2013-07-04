<?php
/***********************************************
-=Ms Site=-

Модуль: String
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: JavaScript для строковой рекламы с дополнительной логикой, как для Барнаула
***********************************************/
$string = 'var price_array=new Array(';
foreach ($string_price_array as $string_price_params)
{
	list($max_price, $max_price_words, $word_price) = preg_split("/[\<\+]/", $string_price_params['day']);
    $string.='{max_price:"' . $max_price . '",max_price_words:"' . $max_price_words . '",word_price:"' . $word_price . '"},';
}
$string=substr($string, 0, -1);
echo $string .= ');
';
?>
	
function order_change()
{
    var summa, price;
	var string_id = <?=$string_id;?>;
    var text = document.order.text.value;
    var phones = document.order["phones"].value;
    var num = document.order.num.value;
	var type = document.order.type.value;
	var discounts = Array(<?=$discounts_js;?>);
	var discount = parseInt(num) - 1; discount = discounts[discount];
	var max_price = parseInt(price_array[type].max_price);
	var max_price_words = parseInt(price_array[type].max_price_words);
	var word_price = parseInt(price_array[type].word_price);
	
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
	
	if (!is_digital(num)) num = document.order.num.value = 1;
	
	var max_price_words_count = (words > max_price_words) ? max_price_words : words,
		extra_words_count = (words > max_price_words) ? (words - max_price_words) : 0;
	
	price = (max_price_words_count + phones_words * 5) * max_price + extra_words_count * word_price;	
	
	price = price - price * discount / 100;	
	summa = num * price;
	
	document.getElementById("total_summa").innerHTML = formatFloat(summa,2);	
	document.getElementById("discount").innerHTML = discount;
}