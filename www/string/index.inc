<h1 class="title">Размещение бегущей строки на ТВ города <?=$smi_part_info['title'];?>. Реклама по-быстрому!</h1>
<p>
	Выберите канал, напечатайте текст, узнайте стоимость и оформите заказ.<br/><br/><br/>
</p>
<? 	
	foreach ($string_sects as $string_sect_id => $string_sect_params)
	{
		$string_cats = $string->SqlGetSectObjects($string_sect_id, 'string_cats');
		foreach ($string_cats as $string_cat_id => $string_cat_params)
		{
			echo $string_cat_params['title'];
			if ( $string_cat_params['text'] != '' ) echo ' (' . $string_cat_params['text'] .  ')';
			echo '<ul class="smi-top-list">';
			$string_items = $string->SqlGetcatObjects($string_cat_id, 'string_items');	
			foreach ($string_items as $string_item_id => $string_item_params)
			{
				echo '<li><a href="' . $site->PAGES['string_item']['url'] . '?id=' . $string_item_id . '">' . $string_item_params['title'] . '</a></li>';
			}
			echo '</ul>';
		}
	}
?>
<div style="width: 0; height: 100px;"><span></span></div>