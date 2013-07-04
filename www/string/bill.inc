<?
	if ( (time() - $sid) < 604800 ):
	
?>
<h1 class="title">Формирование квитанции ПД-4 для оплаты через Сбербанк</h1><br/>
<h2 class="silver">Введите свои данные:</h2><br/>
<form class="mainform" name="string_bill" action="<?=$site->PAGES['string_form']['url'];?>" method="post" class="mainform">
	<input type="hidden" name="sid" value="<?=$sid;?>"/>
  Плательщик (Ф.И.О.):<br/>
  <input name="fio" type="Text" maxlength="255" value="">
  <br/>
  Адрес плательщика:<br/>
  <input name="ul" type="Text" maxlength="255" value=""><br/><br/>
    <label>Выберите дату оплаты:</label>
    <select name="day">
    	<?
    		for ($i = 1; $i < 32; $i++)
    		{
	    			echo '<option value="' . $date->dateDayNumbers[$i] . '"';
	    			if ($i == date('j') ) echo 'selected="selected"';
	    			echo '>' . $date->dateDayNumbers[$i] . '</option>';
			}
    	?>
    </select>
    <select name="month">
    	<?
    		for ($i = 1; $i < 13; $i++)
    		{
	    			echo '<option value="' . $i . '"';
	    			if ($i == date('n') ) echo 'selected="selected"';
	    			echo '>' . $date->dateMonthesOf[$i] . '</option>';
			}
    	?>
    </select>
	<?=date('Y');?> г.<br/><br/>
	<?=$item_info['pay'];?><br/>
	Сумма счета: <?=$item_info['rub'];?>руб. <?=$item_info['kop'];?> коп.<br/><br/>
  <button type="submit">Распечатать готовую квитанцию</button>
 </form>
 <? else: ?>
 Извините, прошло более 5 дней с даты формирования счета. <br><br>Пожалуйста, <a href="/">оформите заказ</a> заново.<br><br><br><br><br>
 <? endif; ?>
