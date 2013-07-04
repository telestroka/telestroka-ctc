<?
	$i = 0;
	foreach ($items_info as $item_id => $item_params)
	{
		if ($item_params['answer']  == '') echo '<span style="color: red;">';
		echo $item_params['text'] . '<br/>(<a href="' . $site->PAGES['admin_feedback_edit']['url'] . '?id=' . $item_id  . '">редактировать</a> | <a href="' . $site->PAGES['admin_feedback_del']['url'] . '?id=' . $item_id  . '">удалить</a>)<br/><br/><br/>';
		if ($item_params['answer']  == '') echo '</span>';
		$i++;
	}
	if ($i == 0) echo '¬опросов нет.<br/><br/>';
?>