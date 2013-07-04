<!--<?php
	$channels = array('МИР — СТС','Домашний','ОТС (Город+область!)','49 канал','Рен ТВ','Регион ТВ','ТВ-3','Вега ТВ — СТС','ТВК-1',);
	$other_tags = array('Последние 50', 'Все объявления', '|', 'Новосибирск', 'Барнаул', '|',  'Скидка 50%', 'Выгодно', 'Срочно!', 'Коммерческое', 'Происшествия и сообщения', 'Условия и правила');
?>
<h1 class="gray" style="margin-bottom: 20px;">По каналам:</h1>
<ul>
	<?php
		foreach ($channels as $channel_tag) {
			if ($channel_tag == $notes_tag) {
				echo '<li>' . $channel_tag . '</li>';
			} else {
				echo '<li><a href="' . $site->PAGES['notes_tags']['url'] . '?tag=' . urlencode( trim($channel_tag) )  . '">' . $channel_tag . '</a></li>';
			}
		}
	?>
</ul>
<h1 class="gray" style="margin-bottom: 20px; margin-top: 30px;">За период:</h1>
<ul>
	<?php
		for ($i = date('Y'); $i > 2007; $i--) {
			echo '<li><a href="' . $site->PAGES['notes_tags']['url'] . '?year=' . $i . '">' . $i . '</a></li>';
		}
	?>
</ul>
<h1 class="gray" style="margin-bottom: 20px; margin-top: 30px;">Другие разделы:</h1>

<ul>
	<?php
		foreach ($other_tags as $notes_tags_tag)
		{
			switch ($notes_tags_tag)
			{
				case '|': echo '<br/>'; break;
				case $notes_tag: echo '<li>' . $notes_tags_tag . '</li>'; break;
				case 'Последние 50': echo '<li><a href="' . $site->PAGES['notes']['url'] . '">' . $notes_tags_tag . '</a></li>'; break;
				default: echo '<li><a href="' . $site->PAGES['notes_tags']['url'] . '?tag=' . urlencode( trim($notes_tags_tag) )  . '">' . $notes_tags_tag . '</a></li>';
			}
		}
	?>
</ul>-->