<?
	$news_message = 'СТАТЬИ С ГЛАВНОЙ
	
';
	$business_message = '
	
БИЗНЕС
	
';
	
	function ReadSorce($source)
	{
		$handle = fopen($source, "rb");
		$contents = '';
		while (!feof($handle)) 
		{
			$contents .= fread($handle, 8192);
		}
		fclose($handle);
		return $contents;
	}
	
	function cmp($a, $b) 
	{
	    if ($a["comment"] > $b["comment"]) return -1;
	    if ($a["comment"] < $b["comment"]) return 1;
		return 0;
	}
	
	/*------NEWS------*/
	
	$source_news = ReadSorce('http://news.ngs.ru/what/what3.php') . ReadSorce('http://news.ngs.ru/what/what3.php?p=2');	

	preg_match_all("/news_title_article\">(.*)<\/a>/U", $source_news, $news_titles);
	preg_match_all("/<a href=\"(.*)\" class=\"news_title_article\">/U", $source_news, $news_links);
	preg_match_all("/<h3>\[(.*)\]/U", $source_news, $news_dates);
	preg_match_all("/комментариев<\/a>: (.*)<\/div>/U", $source_news, $news_comments);
			
	$news_titles = $news_titles[1];
	$news_links = $news_links[1];
	$news_dates = $news_dates[1];
	$news_comments = $news_comments[1];

	
	for ($i = 0; $i < count($news_titles); $i++) 
	{		
		$date = mktime ( 0, 0, 0, substr ($news_dates[$i], -2), substr ($news_dates[$i], 0, 2), 2008);
		$last_week = mktime(0, 0, 0, date("m"), date("d")-7, 2008);
		
		if ($date < $last_week) continue;
		
		$news[$i]['title'] = $news_titles[$i];
		$news[$i]['link'] = 'http://news.ngs.ru' . $news_links[$i];
		$news[$i]['date'] = $news_dates[$i];
		$news[$i]['comment'] = intval($news_comments[$i]);
	}
	uasort($news, "cmp");	
	
	foreach ($news as $article)
	{
		$news_message .= '
' . $article['title'] . '
ссылка: ' . $article['link'] . '
коммментариев: ' . $article['comment'] . '
дата: ' . $article['date'] . '

';		
	}
	
	/*------BUSINESS------*/
	
	$source_news = ReadSorce('http://business.ngs.ru/articles/');	

	$news = $news_titles = $news_links = $news_dates = $news_comments = array();
	
	preg_match_all("/<h1><a href=.*>(.*)<\/a><\/h1>/U", $source_news, $news_titles);
	preg_match_all("/<h1><a href=\"(.*)\".*<\/a><\/h1>/U", $source_news, $news_links);
	preg_match_all("/<div class=\"subheader\"><span>(.*)<\/span>/U", $source_news, $news_dates);
	preg_match_all("/<div class=\"comments\">.*комментариев: (.*)<\/a><\/div>/U", $source_news, $news_comments);
			
	$news_titles = $news_titles[1];
	$news_links = $news_links[1];
	$news_dates = $news_dates[1];
	$news_comments = $news_comments[1];

	
	for ($i = 0; $i < count($news_titles); $i++) 
	{		
		$date = mktime ( 0, 0, 0, substr ($news_dates[$i], -2), substr ($news_dates[$i], 0, 2), 2008);
		$last_week = mktime(0, 0, 0, date("m"), date("d")-7, 2008);
		
		if ($date < $last_week) continue;
		
		$news[$i]['title'] = $news_titles[$i];
		$news[$i]['link'] = 'http://business.ngs.ru' . $news_links[$i];
		$news[$i]['date'] = $news_dates[$i];
		$news[$i]['comment'] = intval($news_comments[$i]);
	}
	uasort($news, "cmp");	
	
	foreach ($news as $article)
	{
		$business_message .= '
' . $article['title'] . '
ссылка: ' . $article['link'] . '
коммментариев: ' . $article['comment'] . '
дата: ' . $article['date'] . '

';		
	}
mail("bvp@ensk.ru", "ngs articles", convert_cyr_string ( $news_message . $business_message, 'w', 'k'),
     "From: mailer@{$_SERVER['SERVER_NAME']}\r\n" .
     "Reply-To: ms@ensk.ru\r\n" .
     "X-Mailer: PHP/" . phpversion());
	
	echo '<pre>' . $news_message . $business_message;
?>