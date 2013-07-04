<?
  	$i = 0;
	foreach ($string_cats as $cat_id => $cat_params)
	{
		echo '<a href="' . $site->PAGES['admin_string_cat']['url'] . '?cat=' . $cat_id . '">' . $cat_params['title'] . '</a> (<a href="' . $site->PAGES['admin_string_editcat']['url'] . '?cat=' . $cat_id . ' ">редактировать</a> | <a href="' . $site->PAGES['admin_string_delcat']['url'] . '?cat=' . $cat_id . ' " onclick="return confirm(\'Вы действительно хотите удалить рубрику и объекты?\')">удалить</a>)<br/>';
		$i++;
	}
  	if ($i == 0) echo 'Рубрик нет.<br/>';
?>
<?=$alert->ALERT_SCRIPT;?>
<script src="js/validation.js"></script>
<script src="js/string.js"></script>
<br/><br/>Добавить новую рубрику:<br/><br/>
<form class="mainform" name="string_addcat" action="<?=$site->PAGES[$site->PAGE]['url'];?>" method="post" class="mainform" onsubmit="return string_cat_check(this);">
  <input type="hidden" name="sect" value="<?=$string_sect;?>" />  
  <span class="alert">*</span> Название рубрики:<br/>
  <input name="title" type="Text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($string_title, ENT_QUOTES);?>">
  <div class="alert"><?=$alert_title;?></div><br/>
  <button type="submit">Добавить</button>
  <div class="alert"><?=$result;?></div>
 </form>
