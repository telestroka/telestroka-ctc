<?php
	require_once('cgi-bin/utils/sql.class');
    $sql = new Sql;
	$sql->SqlConnect();
	
	//инициализация
	$notes_cats = $sql->SqlGetTableCustom('notes_cats', ' where tags like "%Вакансии%" order by id desc limit 0,10');
		
	$rss = '<?xml version="1.0" encoding="windows-1251"?>
<rss xmlns:yandex="http://telestroka.ru" version="2.0">
  <channel>
	<title>ТелеСТРОКА. Объявления в эфире:</title>
	<link xmlns:xi="http://www.w3.org/2001/XInclude">http://telestroka.ru</link>
	<description xmlns:xi="http://www.w3.org/2001/XInclude">Объявления бегущей строки, транслируемые на телевидении Новосибирска службой телестрока.ру.</description>	
	<lastBuildDate>' . date('D, d M Y H:i:s O') . '</lastBuildDate>';
	
	if ($notes_cats)
	{
		foreach ($notes_cats as $item_id => $item_params)
		{
			$rss .= '<item>';
			$rss .= '<title><![CDATA[';
				if (isset($item_params['title'])) $rss .= htmlspecialchars($item_params['title'], ENT_QUOTES);
			$rss .= ']]></title>';
			$rss .= '<link>http://telestroka.ru/notes/index.php?cat=' . $item_params['id'] . '</link>';
			$rss .= '<description><![CDATA[';
				$rss .= $item_params['text'];
			$rss .= ']]></description>';
			$rss .= '<pubDate>';
				$rss .= date('D, d M Y H:i:s O', strtotime($item_params['date']));
			$rss .= '</pubDate>';
			$rss .= '<pubDateUT>';
				$rss .= strtotime($item_params['date']);
			$rss .= '</pubDateUT>';
			$rss .= '<guid>' . $item_params['id'] . '</guid>';
			$rss .= '</item>';
		}
	}	
	
  $rss .= '</channel>
</rss>';

	echo $rss;
?>