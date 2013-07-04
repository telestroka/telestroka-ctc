<script language="JavaScript" type="text/javascript">
	string_array = new Array (
<?
	$string = '';
	foreach ($notes_items as $item_id => $item_params) $string .= "'" . $item_params['title'] . "',";
	echo substr($string, 0, -1);
?>
	);
	link_array = new Array (
<?
	$string = '';
	foreach ($notes_items as $item_id => $item_params) $string .= "'" . $item_id . "',";
	echo substr($string, 0, -1);
?>
	);	
	fading_index = 0;

	function show() {
		electrotext_content = $('#electrotext-content');
		
		var html = '<a href="/notes/index.php?cat=' + link_array[fading_index] + '" id="notes_link"><span id="notes_text">' + string_array[fading_index] + '</span></a>';
		electrotext_content.html(html);
		electrotext_content.fadeIn('slow').delay(1000).fadeOut('slow', show);
		fading_index++;
		if (fading_index >= string_array.length) fading_index = 0;
	}
	
	$(function() {
		show();
	});
		
</script>

<div style="min-height: 80px">
	<div class="electrotext-title">Сентябрь 2012. Объявления в эфире: </div>
	<div id="electrotext-content"></div>
</div>	
	
<div class="electrotext-more">
	<a href="/notes/tags.php?tag=%C2%E0%EA%E0%ED%F1%E8%E8">Вакансии</a>
	<a href="/notes/tags.php?tag=%D1%F0%EE%F7%ED%EE%21">Срочно в эфир!</a>
	<a href="/notes/tags.php?tag=Тр. — бесплатно!">Тр. — бесплатно!</a>
	<a href="/notes/tags.php?tag=Скидка+50%" style="color: #F26522">Со&nbsp;скидкой&nbsp;50%</a>
</div>