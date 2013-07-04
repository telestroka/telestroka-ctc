<?
  	$i = 0;
	foreach ($screen_sects as $sect_id => $sect_params)
	{
		echo '<a href="' . $site->PAGES['admin_screen_sect']['url'] . '?sect=' . $sect_id . '">' . $sect_params['title'] . '</a> (<a href="' . $site->PAGES['admin_screen_editsect']['url'] . '?sect=' . $sect_id . ' ">редактировать</a> | <a href="' . $site->PAGES['admin_screen_delsect']['url'] . '?sect=' . $sect_id . ' " onclick="return confirm(\'Вы действительно хотите удалить раздел и его содержимое?\')">удалить</a>)<br/>';
		$i++;
	}
  	if ($i == 0) echo 'Разделов нет.<br/>';
?>
<?=$alert->ALERT_SCRIPT;?>
<script src="js/validation.js"></script>
<script src="js/screen.js"></script>
<br/><br/>Добавить новый раздел:<br/><br/>
<form class="mainform" name="screen_addsect" action="<?=$site->PAGES[$site->PAGE]['url'];?>" method="post" class="mainform" onsubmit="return screen_sect_check(this);">
  <input type="hidden" name="part" value="<?=$smi_part;?>" />
  <span class="alert">*</span> Название раздела:<br/>
  <input name="title" type="Text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($screen_title, ENT_QUOTES);?>">
  <div class="alert"><?=$alert_title;?></div><br/>
  <button type="submit">Добавить</button>
  <div class="alert"><?=$result;?></div>
 </form>
