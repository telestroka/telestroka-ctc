<?=$alert->ALERT_SCRIPT;?>
<script src="js/validation.js"></script>
<script src="js/smi.js"></script>
<form class="mainform" name="smi_editcat" action="<?=$site->PAGES[$site->PAGE]['url'];?>" method="post" class="mainform" onsubmit="return smi_cat_check(this);">
  <input type="hidden" name="cat" value="<?=htmlspecialchars($smi_cat, ENT_QUOTES);?>" />
  <span class="alert">*</span> Название рубрики:<br/>
  <input name="title" type="Text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($smi_title, ENT_QUOTES);?>">
  <div class="alert"><?=$alert_title;?></div>
    <br/>
    Раздел:<br/>
    <select name="sect" >
    	<?
        foreach ($smi_parts as $part_id => $part_params)
        {
            echo '<optgroup label="' . $part_params['title'] . '">';
            $smi_sects = $smi->SqlGetPartObjects($part_id, 'smi_sects');
        		foreach ($smi_sects as $sect_id => $sect_params)
        		{
              $sect_info = $smi->SqlGetObj($sect_id, 'smi_sects');
        			if ($sect_id == $smi_sect)
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
