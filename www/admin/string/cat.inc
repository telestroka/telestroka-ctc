<?
  	foreach ($string_cat_info as $item_id => $item_params)
  	{
  		echo $item_params['title'] . ' (<a href="' . $site->PAGES['admin_string_edit']['url'] . '?id=' . $item_id  . '">редактировать</a> | <a href="' . $site->PAGES['admin_string_del']['url'] . '?id=' . $item_id  . '" onclick="return confirm(\'Вы действительно хотите удалить объект?\')">удалить</a>)<br/>';
  	}
?>
<br/><br/>Добавить новый канал:<br/><br/>
<?=$alert->ALERT_SCRIPT;?>
<script language="JavaScript" type="text/javascript" src="<?=$site->PATH;?>/js/validation.js"></script>
<script language="JavaScript" type="text/javascript" src="<?=$site->PATH;?>/js/string.js"></script>

<form class="mainform" name="string_add" method="post" action="<?=$site->PAGES[$site->PAGE]['url'];?>" enctype="multipart/form-data" onsubmit="return string_check(this);">
    <input type="hidden" name="cat" value="<?=$string_cat;?>" />
    <span class="alert">*</span> Идентификатор:<br/>
    <input name="name" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($string_name, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_name;?></div>
    <br/>
    <span class="alert">*</span> Название канала:<br/>
    <input name="title" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($string_title, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_title;?></div>
    <br/>
    Слоган:<br/>
    <input name="slogan" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($string_slogan, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_slogan;?></div>
    <br/>
    Описание:<br/>
    <textarea name="info" rows="10" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($string_info, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_info;?></div>
    <br/>
    <span class="alert">*</span> Прайс:<br/>
    <textarea name="price_list" rows="10" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($string_price_list, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_price_list;?></div>
    <br/>
    Изображение:<br/>
    <input type="file" name="image"/>
    <div class="alert"><?=$alert_image;?></div>
    <br/>
    Востребованность:<br/>
    <input name="rate" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($string_rate, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_rate;?></div>
    <br/>
    <input type="submit" value="Добавить"/>
    <div class="alert"><?=$result;?></div>
</form>