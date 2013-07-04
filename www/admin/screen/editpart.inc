<?=$alert->ALERT_SCRIPT;?>
<script src="js/validation.js"></script>
<script src="js/screen.js"></script>
<form class="mainform" name="screen_editpart" action="<?=$site->PAGES[$site->PAGE]['url'];?>" method="post" class="mainform" onsubmit="return smi_part_check(this);">
  <input type="hidden" name="part" value="<?=htmlspecialchars($smi_part, ENT_QUOTES);?>" />
  <span class="alert">*</span> Название сектора:<br/>
  <input name="title" type="Text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($screen_title, ENT_QUOTES);?>">
  <div class="alert"><?=$alert_title;?></div><br/>
  <button type="submit">Сохранить изменения</button>
  <div class="alert"><?=$result; ?></div>
</form>
