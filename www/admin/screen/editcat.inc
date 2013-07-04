<?=$alert->ALERT_SCRIPT;?>
<script src="js/validation.js"></script>
<script src="js/screen.js"></script>
<form class="mainform" name="screen_editcat" action="<?=$site->PAGES[$site->PAGE]['url'];?>" method="post" class="mainform" onsubmit="return screen_cat_check(this);">
  <input type="hidden" name="cat" value="<?=htmlspecialchars($screen_cat, ENT_QUOTES);?>" />
  <span class="alert">*</span> Название рубрики:<br/>
  <input name="title" type="Text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($screen_title, ENT_QUOTES);?>">
  <div class="alert"><?=$alert_title;?></div>
    <br/>
    Раздел:<br/>
    <select name="sect" >
    	<?
        foreach ($smi_parts as $part_id => $part_params)
        {
            echo '<optgroup label="' . $part_params['title'] . '">';
            $screen_sects = $screen->SqlGetPartObjects($part_id, 'screen_sects');
        		foreach ($screen_sects as $sect_id => $sect_params)
        		{
              $sect_info = $screen->SqlGetObj($sect_id, 'screen_sects');
        			if ($sect_id == $screen_sect)
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
