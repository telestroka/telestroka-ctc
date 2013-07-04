<?=$alert->ALERT_SCRIPT;?>
<script src="js/validation.js"></script>
<script src="js/string.js"></script>
<form class="mainform" name="string_editcat" action="<?=$site->PAGES[$site->PAGE]['url'];?>" method="post" class="mainform" onsubmit="return string_cat_check(this);">
  <input type="hidden" name="cat" value="<?=htmlspecialchars($string_cat, ENT_QUOTES);?>" />
  <span class="alert">*</span> Название рубрики:<br/>
  <input name="title" type="Text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($string_title, ENT_QUOTES);?>">
  <div class="alert"><?=$alert_title;?></div>
    <br/>
    Раздел:<br/>
    <select name="sect" >
    	<?
        foreach ($smi_parts as $part_id => $part_params)
        {
            echo '<optgroup label="' . $part_params['title'] . '">';
            $string_sects = $string->SqlGetPartObjects($part_id, 'string_sects');
        		foreach ($string_sects as $sect_id => $sect_params)
        		{
              $sect_info = $string->SqlGetObj($sect_id, 'string_sects');
        			if ($sect_id == $string_sect)
        			{
        				echo '<option value="' . $sect_id . '" selected="selected">' . $sect_params['title'] . '</option>';
        			}
        			else
        			{
        				echo '<option value="' . $sect_id . '">' . $sect_params['title'] . '</option>';
        			}
        		}
            echo '</optgroup>';
        }
    	?>
    </select><br/><br/>
  <button type="submit">Сохранить изменения</button>
  <div class="alert"><?=$result; ?></div>
</form>
