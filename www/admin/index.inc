<?
	$i = 0;
	foreach ($site->PAGES as $page_name => $page_attr)
	{
		if ( isset($page_attr['parent']) && $page_attr['parent'] == 'admin' )
		{
			if ($i > 0) echo ' <br/> '; //сепаратор
			if ($page_name == $site->PAGE) echo '<span>' . $page_attr['name'] . "</span>"; //активный
			else echo '<a href="' . $page_attr['url'] . ' ">' . $page_attr['name'] . "</a>"; //неактивный
			$i++;

		}
	}
?>