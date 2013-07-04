<?
  	$i = 0;
	foreach ($smi_parts as $part_id => $part_params)
	{
		echo '<a href="' . $site->PAGES['admin_smi_part']['url'] . '?part=' . $part_id . '">' . $part_params['title'] . '</a> (<a href="' . $site->PAGES['admin_smi_editpart']['url'] . '?part=' . $part_id . ' ">редактировать</a> | <a href="' . $site->PAGES['admin_smi_delpart']['url'] . '?part=' . $part_id . ' " onclick="return confirm(\'Вы действительно хотите сектор и все его содержимое?\')">удалить</a>)<br/>';
		$i++;
	}
  	if ($i == 0) echo 'Городов нет.<br/>';
?>
<?=$alert->ALERT_SCRIPT;?>
<script src="js/validation.js"></script>
<script src="js/smi.js"></script>
<br/><br/>Добавить новый город:<br/><br/>
<form class="mainform" name="smi_addpart" action="<?=$site->PAGES[$site->PAGE]['url'];?>" method="post" class="mainform" onsubmit="return smi_part_check(this);">
  <span class="alert">*</span> Название города:<br/>
  <input name="title" type="Text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($smi_title, ENT_QUOTES);?>">
  <div class="alert"><?=$alert_title;?></div><br/>
  <button type="submit">Добавить</button>
  <div class="alert"><?=$result;?></div>
 </form>
