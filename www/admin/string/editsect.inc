<?=$alert->ALERT_SCRIPT;?>
<script src="js/validation.js"></script>
<script src="js/string.js"></script>
<form class="mainform" name="string_editsect" action="<?=$site->PAGES[$site->PAGE]['url'];?>" method="post" class="mainform" onsubmit="return string_sect_check(this);">
  <input type="hidden" name="sect" value="<?=htmlspecialchars($string_sect, ENT_QUOTES);?>" />
  <span class="alert">*</span> Название раздела:<br/>
  <input name="title" type="Text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($string_title, ENT_QUOTES);?>">
  <div class="alert"><?=$alert_title;?></div><br/>
  Раздел:<br/>
  <select name="part" >
  	<?
  		foreach ($smi_parts as $part_id => $part_params)
  		{
  			if ($part_id == $smi_part)
  			{
  				echo '<option value="' . $part_id . '" selected="selected">' . $part_params['title'] . '</option>';
  			}
  			else
  			{
  				echo '<option value="' . $part_id . '">' . $part_params['title'] . '</option>';
  			}
  		}
  	?>
  </select><br/><br/>
  <button type="submit">Сохранить изменения</button>
  <div class="alert"><?=$result; ?></div>
</form>
