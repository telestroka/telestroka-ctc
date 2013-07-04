<HTML>

<head>
	<? include_once($site->PATH_INC . '/meta.inc'); ?>
	<title><? echo $site->NAME_SITE . " :: " . $site->PAGES[$site->PAGE]['name'] ?></title>
	<base href="<?=$site->PATH;?>/" />
	
<style type="text/css">
form		{margin: 0;}

hr		{border: 0; color: #999999; background-color: #999999; height: 1px; margin: 10px 0;}
	
div.header	{margin: 4px; font-size: 80%;}
td.balance	{border-left: 1px solid #777777; border-right: 1px solid #777777;}
div.balance	{margin: 4px; font-weight: bold;}
td.user		{border-left: 1px solid #777777;}
td.user td	{font-size: 80%;}
td.user td a	{color: #000000;}

	
h3.title	{margin-left: 20px;}
table.payment td{font-size: 80%;}
td.generic, td.sum {border-bottom: 1px solid #EFEFEF; }
td.sum		{text-align: right;}
tr.total td     {border: 1px solid black; background-color: #F2F2F2}
td.b_sum	{font-size: 80%; border-bottom: 1px solid #EFEFEF; border-right: 1px solid #777777;}
td.sortedby	{font-size: 80%; background-color: #CAE8D1; border: 1px solid #66A775;}
td.th		{border: 1px solid #FFFFFF;}
td.b_th		{font-size: 80%; border: 1px solid #FFFFFF; border-right: 1px solid #777777;}
table.operations a				{color: #000000}
table.operations td, table.operations th	{font-size: 80%;}
table.payment a					{color: #0033CC}

table.filter td	{font-size: 80%; color: #666666;}

div.column	{margin-right: 40px;}
div.sum		{margin-left: 40px;}

#copyright {margin: 0 0 20px 20px; font-size: 100%;}
#copyright a:link {color: blue}
#copyright a:alink {color: blue}
#copyright a:visited {color: blue}

td.content	{padding: 0; padding-left: 20px;}
td.menu		{padding: 0; padding-left: 20px;}
td.menu a	{color: #907918;}
td.menuitem	{font-size: 80%;}
td.current	{font-size: 80%; color: #907918; background-color: #F1E9C6; border: 1px solid #CDC18D; border-right: 0;}
td.about	{font-size: 80%; color: #666666;}
td.about a	{color: #666666;}

.smaller	{font-size: 80%;}

dl.payment dd	{
	margin-bottom: 1.5em;
}
dt.payment {
}
dd.payment {
}

dt.payment_disabled {
	color: #AFAFAF;
}
dd.payment_disabled {
	color: #AFAFAF;
}


tr.separator td					{border-top: 1px solid #000000;}
td.itogo						{padding-right: 0; font-size: 80%; font-weight: bold;}

         table.invoice { border-collapse: collapse;}
         table.invoice td {border:black 1px solid; }
         table.invoice td { font-size: 10pt;}

table.dogovor{
margin:20px 0px 0px;
}
table.dogovor td{
font-size: 10pt;
vertical-align: top;
border:0px;
width: 50%;
}
ol li{
padding-top:20px;
font-size: 10pt;
}

ol.ofert li{
padding-top:20px;
font-size: 9pt;
}
.progressbar {position: absolute; top: 20%; left: 45%; border: 1px solid #666666; background-color: #E8F2E1; font-size: 90%; padding: 1em;}
.border {border-bottom: 1px solid black; margin-bottom:-0.2em; padding-bottom: 0px; }
.print-content {margin-left: 1.5em; margin-right: 1.5em; margin-top: 2em; margin-bottom: 3em; }

</style>
	<script language="javascript">
	
	function print1()
	{if (confirm ('Проверьте еще раз правильность введенных Вами платежных данных.\n- Если обнаружена ошибка, то нажмите "Отмена" и отредактируйте форму.\n- Если все нормально, нажмите "ОК" - бланк будет отправлен на печать.  '))
	 window.print()
	 else
	 history.go(-1)
	}
	
	</script>	
</head>

<body leftmargin="0" rightmargin="0" topmargin="0" bgcolor="white" link="#0000cc" marginheight="0" marginwidth="0" onload="print1()">
<div class="print-content"><div align="center"><table style="border: 1px solid black; max-width: 750px; width: 637px;" border="0" cellpadding="0" cellspacing="0"><tbody>
<tr valign="top">
<td style="padding: 5px; font-size: 11pt;" align="center">
<div>Извещение</div>
<div style="margin-top: 12em;">Кассир</div>
</td>
<td style="border-right: 1px solid black;" bgcolor="black" width="1" height="250"><div style="width: 1px; height: 250px;"><img src="invoice-print-ph.xml_files/black.gif" width="1" height="1"></div></td>
<td style="padding: 5px; font-size: 10pt; padding-bottom: 5px;">
<div class="border"><i>ООО "Технология"</i></div>
<div style="font-size: 8pt; padding-top: 0pt;" align="center">получатель платежа</div>
<div class="border"><i>КПП:540 701 001 ИНН:540 745 8450</i></div>
<div style="font-size: 8pt; padding-top: 0pt;" align="center">реквизиты получателя</div>
<div style="float: left; margin-right: 20pt;">
<div class="border"><i>НФ АКБ "ЛАНТА-БАНК (ЗАО) г. НОВОСИБИРСК</i></div>
<div style="font-size: 8pt;" align="center">наименование банка</div>
</div>
<div style="float: right;">
<div class="border"><i>407 028 109 000 100 09827</i></div>
<div style="font-size: 8pt;" align="center">расчетный счет</div>
</div>
<br clear="all"><div class="border" style="font-size: 8pt;"><i>К/с №301 018 1 0000000000 837 БИК 045 004 837</i></div>
<div style="font-size: 8pt;" align="center">другие банковские реквизиты</div>
<div class="border"><i><?=$_POST['fio'];?></i></div>
<div style="font-size: 8pt;" align="center">Фамилия И.О. и адрес плательщика</div>
<div class="border"><i><?=$_POST['ul'];?></i></div><br/>
<div class="border"><i><?=$item_info['pay'];?>&nbsp;</i></div>
<div style="font-size: 8pt;" align="center">наименование платежа</div>
<div style="float: right; margin-left: 40pt;" class="border"><i><?=$_POST['day'];?> <?=$date->dateMonthesOf[$_POST['month']];?> <?=date('Y');?> г.</i></div>
<div>
<span style="font-size: 8pt;">Сумма&nbsp;платежа&nbsp;</span><span class="border"><i><?=$item_info['rub'];?> руб. <?=$item_info['kop'];?> коп.</i></span>
</div>
<div style="font-size: 8pt; padding-top: 10px;">Подпись<br> плательщика</div>
</td>
</tr>
<tr>
<td style="border-top: 1px solid black;" align="right" bgcolor="black" width="190"><div style="width: 190px; height: 1px;"><img src="invoice-print-ph.xml_files/black.gif" width="1" height="1"></div></td>
<td><img src="invoice-print-ph.xml_files/black.gif" width="1" height="1"></td>
<td style="border-top: 1px solid black;" bgcolor="black"><div style="width: 200px; height: 1px;"><img src="invoice-print-ph.xml_files/black.gif" width="1" height="1"></div></td>
</tr>
<tr>
<td style="padding: 5px; font-size: 11pt;" align="center" valign="bottom">
<div>Квитанция</div>
<div style="margin-top: 1em;">Кассир</div>
</td>
<td style="border-right: 1px solid black;" bgcolor="black" width="1" height="250"><div style="width: 1px; height: 250px;"><img src="invoice-print-ph.xml_files/black.gif" width="1" height="1"></div></td>
<td style="padding: 5px; font-size: 10pt; padding-bottom: 5px;">
<div class="border"><i>ООО "Технология"</i></div>
<div style="font-size: 8pt; padding-top: 0pt;" align="center">получатель платежа</div>
<div class="border"><i>КПП:540 701 001 ИНН:540 745 8450</i></div>
<div style="font-size: 8pt; padding-top: 0pt;" align="center">реквизиты получателя</div>
<div style="float: left; margin-right: 20pt;">
<div class="border"><i>НФ АКБ "ЛАНТА-БАНК (ЗАО) г. НОВОСИБИРСК</i></div>
<div style="font-size: 8pt;" align="center">наименование банка</div>
</div>
<div style="float: right;">
<div class="border"><i>407 028 109 000 100 09827</i></div>
<div style="font-size: 8pt;" align="center">расчетный счет</div>
</div>
<br clear="all"><div class="border" style="font-size: 8pt;"><i>К/с №301 018 1 0000000000 837 БИК 045 004 837</i></div>
<div style="font-size: 8pt;" align="center">другие банковские реквизиты</div>
<div class="border"><i><?=$_POST['fio'];?></i></div>
<div style="font-size: 8pt;" align="center">Фамилия И.О. и адрес плательщика</div>
<div class="border"><i><?=$_POST['ul'];?></i></div><br/>
<div class="border"><i><?=$item_info['pay'];?>&nbsp;</i></div>
<div style="font-size: 8pt;" align="center">наименование платежа</div>
<div style="float: right; margin-left: 40pt;" class="border"><i><?=$_POST['day'];?> <?=$date->dateMonthesOf[$_POST['month']];?> <?=date('Y');?> г.</i></div>
<div>
<span style="font-size: 8pt;">Сумма&nbsp;платежа&nbsp;</span><span class="border"><i><?=$item_info['rub'];?> руб. <?=$item_info['kop'];?> коп.</i></span>
</div>
<div style="font-size: 8pt; padding-top: 10px;">Подпись<br> плательщика</div>
</td>
</tr>
</tbody></table></div></div></body></html>