<h1 class="title" style="margin-bottom: 20px;">Размещение <span class="runner">бегущей строки</span> на ТВ города <?=$smi_part_info['title'];?></h1>
<div class="titled" style="margin-bottom: 30px;">Выберите канал, напечатайте текст, узнайте стоимость:</div>
<div class="titled">Для коммерческих объявлений: о&nbsp;продаже или покупке</div>
<div class="moved" style="margin-bottom: 3px;">
в том числе: средств производства, или во&nbsp;множественном числе, в&nbsp;том числе с&nbsp;указанием наименований юридических лиц и&nbsp;торговых марок, и&nbsp;подобное.
</div>
<ul class="smi-top-list">
	<?php
		foreach ($string_items as $string_item_id => $string_item_params)
		{
			if ( strstr($string_item_params['price_list'], "\n") )
				echo '<li><a href="' . $site->PAGES['string_item']['url'] . '?id=' . $string_item_id . '">' . $string_item_params['title'] . '</a></li>';
		}
	?>
</ul>
<br/>
<div class="titled">Для социальных объявлений: о&nbsp;вакансиях, утере, ДТП</div>
<div class="moved" style="margin-bottom: 3px;">
информационные сообщения без указания наименований торговых марок и&nbsp;юридических лиц, и&nbsp;подобное.
</div>
<ul class="smi-top-list">
	<?php
		foreach ($string_items as $string_item_id => $string_item_params)
		{
			echo '<li><a href="' . $site->PAGES['string_item']['url'] . '?id=' . $string_item_id . '&order_type=0">' . $string_item_params['title'] . '</a></li>';
		}
	?>
</ul>
<div class="accent-block electrotext">
	<? include_once($site->PATH_INC . '/work.inc'); ?>
</div>
<div style="width: 0; height: 40px;"><span></span></div>