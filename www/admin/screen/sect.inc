<?
  	$i = 0;
	foreach ($screen_cats as $cat_id => $cat_params)
	{
		echo '<a href="' . $site->PAGES['admin_screen_cat']['url'] . '?cat=' . $cat_id . '">' . $cat_params['title'] . '</a> (<a href="' . $site->PAGES['admin_screen_editcat']['url'] . '?cat=' . $cat_id . ' ">редактировать</a> | <a href="' . $site->PAGES['admin_screen_delcat']['url'] . '?cat=' . $cat_id . ' " onclick="return confirm(\'Вы действительно хотите удалить рубрику и объекты?\')">удалить</a>)<br/>';
		$i++;
	}
  	if ($i == 0) echo 'Рубрик нет.<br/>';
?>
<?=$alert->ALERT_SCRIPT;?>
<script src="js/validation.js"></script>
<script src="js/screen.js"></script>
<br/><br/>Добавить новую рубрику:<br/><br/>
<form class="mainform" name="screen_addcat" action="<?=$site->PAGES[$site->PAGE]['url'];?>" method="post" class="mainform" onsubmit="return screen_cat_check(this);">
  <input type="hidden" name="sect" value="<?=$screen_sect;?>" />  
  <span class="alert">*</span> Название рубрики:<br/>
  <input name="title" type="Text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($screen_title, ENT_QUOTES);?>">
  <div class="alert"><?=$alert_title;?></div><br/>
  <button type="submit">Добавить</button>
  <div class="alert"><?=$result;?></div>
 </form>
