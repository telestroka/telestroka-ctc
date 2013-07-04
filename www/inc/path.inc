<?
	$path = array();
	$path_page = $site->PAGE;

	//формируем массив основных страниц
	while ( isset($site->PAGES[$path_page]['parent']) )
	{
		$path[] = $path_page;
		$path_page = $site->PAGES[$path_page]['parent'];
	}
	if ($path_page != '')
	{
	    $path[] = $path_page;
	    $path[] = '';
	}
	$path = array_reverse($path);

	//вывод
	foreach ($path as $path_id => $page_name)
	{
		if ( isset($path[$path_id+1]) )
		{
			if (strstr($site->PAGES[$page_name]['url'],'part.php')) continue;
			if (strstr($site->PAGES[$page_name]['url'],'sect.php')) continue;
			if (strstr($site->PAGES[$page_name]['url'],'cat.php')) continue;
			if (strstr($site->PAGES[$page_name]['url'],'item.php')) continue;
			if ($path_id) echo ' > ';
			echo '<a href="' . $site->PAGES[$page_name]['url'] . '">' . $site->PAGES[$page_name]['name'] . '</a>';
		}
	    else
	    {
			if ($path_id) echo ' > ';
			if ( isset($path_part) ) echo '<a href="' . $path_part['url'] . '">' . $path_part['title'] . '</a> > ';
			if ( isset($path_sect) ) echo '<a href="' . $path_sect['url'] . '">' . $path_sect['title'] . '</a> > ';
			if ( isset($path_cat) ) echo '<a href="' . $path_cat['url'] . '">' . $path_cat['title'] . '</a> > ';
			if ( isset($path_item) ) echo '<a href="' . $path_item['url'] . '">' . $path_item['title'] . '</a> > ';
			if ( isset($path_current) ) echo $path_current;
			else echo $site->PAGES[$page_name]['name'];
	    }
	}
?>
<hr/>
<br/>