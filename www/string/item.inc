<script src="js/validation.js"></script>
<script src="js/string_order.js"></script>
<script src="js/cookie.js"></script>
<script>
    <? 
		if ($smi_part == '14') require_once('js_extra.php');
		else require_once('js.php');
	?>
</script>
<?php $all_channels_link = ($smi_part == '14') ? '/string/part.php?part=14' : '/'?>
<h1>Заказать бегущую строку на телеканале "<?=$string_title;?>" в г.<?=$smi_part_info['title'];?> (<a href="/">другие города</a>)</h1>
<p>
	<?=$string_info;?>
</p>
<h1 class="gray" style="margin: 30px 0 20px 0;">Разместить рекламу на телеканале, заполнив заявку:<!-- по e-mail--></h1>
<!--<p>
	Если у вас уже есть готовый файл с текстом рекламы, отправьте его нам по электронной почте: <a href="mailto:info@telestroka.ru">info@telestroka.ru</a>.
<br/><br/>
	Также укажите, на каких каналах вы желаете его разместить и свои контактные данные. После получения письма мы свяжемся с вами для уточнения деталей и выставления счета.
</p>
<h1 class="gray" style="margin-top: 30px;">Или заполнив заявку:</h1><br/>-->
<form name="order" action="<?=$site->PAGES[$site->PAGE]['url'];?>" method="post" onsubmit="return order_check()">
	<input name="id" type="Hidden" value="<?=$string_id;?>">
	<table cellpadding="0" cellspacing="0" border="0" style="width: 370px;">
		<? if ($string_adv): ?>
		<tr>
			<td style="padding-left: 20px;">
				Укажите, является&nbsp;ли ваше объявление рекламой и&nbsp;(или)&nbsp;связано с осуществлением предпринимательской деятельности, или о&nbsp;продаже?<br/>
				<select name="type" onchange="order_change()">
					<option value="1" <? if ($order_type == 1) echo 'selected'; ?>>Да</option>
					<option value="0" <? if ($order_type == 0) echo 'selected'; ?>>Нет</option>
				</select>
				<div class="alert"><?=$alert_type;?></div><br/>	
			</td>
		</tr>
		<? else: ?>
		<input type="hidden" name="type" value="0">
		<? endif; ?>
		<tr>
			<td style="padding-left: 20px;">
				Напишите текст объявления (без телефонов, адресов электронной почты). <b>Cлова должны быть разделены пробелами!</b> Допустимы общеупотребительные сокращения: л/а, в/о, з/п и подобные.
				<textarea name="text" rows="5" style="width:370px;" onchange="order_change()"><?=htmlspecialchars($order_text,ENT_QUOTES);?></textarea>
				<div class="alert"><?=$alert_text;?></div><br/>	
			</td>
		</tr>
		<tr>
			<td style="padding-left: 20px;">
				Укажите телефоны, адреса электронной почты или сайта по&nbsp;одному в строке (один под другим):<br>
				
				<textarea name="phones" rows="5" style="width:370px;" onchange="order_change()"><?=htmlspecialchars($order_phones,ENT_QUOTES);?></textarea>
				<div class="alert"><?=$alert_phones;?></div><br/>	
			</td>
		</tr>					
		<?
			$translation_times = $string_price_array[$order_type];
			foreach ($translation_times as $index => $translation_time) {
				if ($translation_time == 0) unset($translation_times[$index]);
			}
			if (count($translation_times) > 1): 
		?>
		<tr>
			<td style="padding-left: 20px;">
				Выберите время трансляции<br/>
				<select name="time" onchange="order_change()">
					<? if ($string_price_array[$order_type]['morning'] > 0): ?>
						<option value="0" <? if ($order_time == 0) echo 'selected'; ?>>Утро</option>
					<? endif; ?>
					<? if ($string_price_array[$order_type]['day'] > 0): ?>
						<option value="1" <? if ($order_time == 1) echo 'selected'; ?>>День</option>
					<? endif; ?>
					<? if ($string_price_array[$order_type]['evening'] > 0): ?>
						<option value="2" <? if ($order_time == 2) echo 'selected'; ?>>Вечер</option>
					<? endif; ?>
					<? if ($string_price_array[$order_type]['all'] > 0): ?>
						<option value="3" <? if ($order_time == 3) echo 'selected'; ?>>Сквозная</option>
					<? endif; ?>
				</select>
				<div class="alert"><?=$alert_time;?></div><br/>			
			</td>
		</tr>
		<? else: ?>
		<input type="hidden" name="time" value="1">
		<? endif; ?>
		<tr>
			<td style="padding-left: 20px;">
				<input type="checkbox" name="duplicate"/>
				Дублировать в интернет-архиве<br/><br/>
			</td>
		</tr>
		<tr>
			<td style="padding-left: 20px;">
				<b>Укажите количество дней выходов:</b>
				<select name="num" onchange="order_change()">
					<?
						for ($i=1; $i<=10; $i++)
						{
							if ($i == $order_num) echo '<option value="' . $i . '" selected="selected">';
							else echo '<option value="' . $i . '">';
							echo $i . '</option>';
						}
					?>
					
				</select>
				<div class="alert"><?=$alert_num;?></div><br/>	
			</td>
		</tr>
		<tr>
			<td style="padding-left: 20px;">
				<table cellpadding="0" cellspacing="0" style="width: 375px;">
					<tr>
						<td>Купон постоянного&nbsp;заказчика:</td>
						<td style="text-align: right;"><input name="kupon" type="Text" maxlength="255" onclick="this.style.background='#ffffff'" value="<?=htmlspecialchars($order_kupon,ENT_QUOTES);?>"></td>
					</tr>
					<tr><td colspan=2>Стоимость объявления при выставлении счета будет уменьшена на гарантированную скидку.
					</td></tr>
				</table>
				<div class="alert"><?=$alert_kupon;?></div><br/>	
			</td>
		</tr>
	</table>
	<br/>
	<h1 class="gray">К оплате с учетом скидки <span id="discount">0</span>%: <span id="total_summa" class="orange"></span> <span class="orange">руб.</span></h1><!--br/>
	
	Эта стоимость может быть уменьшена при выставлении счета в&nbsp;соответствии с особенностями подсчета слов на канале. 
	<br--><br><br>
	
	<table cellpadding="0" cellspacing="0" border="0" style="width: 400px;">
		<tr>
			<td style="padding-left: 20px;">
				<input name="company" type="Hidden">
				Для связи с вами и выставления счета на оплату укажите: <br/><br/>1. Ваше имя:<br/>
				<input name="name" type="Text" maxlength="255" onclick="this.style.background='#ffffff'" value="<?=htmlspecialchars($order_name,ENT_QUOTES);?>" style="width:70%;">
				<div class="alert"><?=$alert_name;?></div><br/>
				2. Ваш телефон (е-mail):<br>
				<input name="phone" type="Text" maxlength="255" onclick="this.style.background='#ffffff'" value="<?=htmlspecialchars($order_phone,ENT_QUOTES);?>" style="width:70%;">
				<div class="alert"><?=$alert_phone?></div><br/>
			</td>
		</tr>
	</table>
	<br/>Трансляция — после подтверждения оплаты. <br/><br/>
	<input type="Submit" value="Отправить заявку">
	<div class="alert"><?=$result;?></div>
	<br/>
</form>
<script>
	order_change();
	setInterval('order_change()', 1000);
</script>