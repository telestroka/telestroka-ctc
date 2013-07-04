<?
  	foreach ($smi_cat_info as $item_id => $item_params)
  	{
  		echo $item_params['title'] . ' (<a href="' . $site->PAGES['admin_smi_edit']['url'] . '?id=' . $item_id  . '">редактировать</a> | <a href="' . $site->PAGES['admin_smi_del']['url'] . '?id=' . $item_id  . '" onclick="return confirm(\'Вы действительно хотите удалить объект?\')">удалить</a>)<br/>';
  	}
?>
<br/><br/>Добавить новое СМИ:<br/><br/>
<?=$alert->ALERT_SCRIPT;?>
<script language="JavaScript" type="text/javascript" src="<?=$site->PATH;?>/js/validation.js"></script>
<script language="JavaScript" type="text/javascript" src="<?=$site->PATH;?>/js/smi.js"></script>

<form class="mainform" name="smi_add" method="post" action="<?=$site->PAGES[$site->PAGE]['url'];?>" enctype="multipart/form-data" onsubmit="return smi_check(this);">
    <input type="hidden" name="cat" value="<?=$smi_cat;?>" />
    <span class="alert">*</span> Идентификатор:<br/>
    <input name="name" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($smi_name, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_name;?></div>
    <br/>
    <span class="alert">*</span> Название газеты:<br/>
    <input name="title" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($smi_title, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_title;?></div>
    <br/>
    Слоган:<br/>
    <input name="slogan" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($smi_slogan, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_slogan;?></div>
    <br/>
    <span class="alert">*</span> Тираж:<br/>
    <input name="circulation" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($smi_circulation, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_circulation;?></div>
    <br/>
    <span class="alert">*</span> Количество страниц:<br/>
    <input name="pages" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($smi_pages, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_pages;?></div>
    <br/>
    <span class="alert">*</span> Формат:<br/>
    <input name="format" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($smi_format, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_format;?></div>
    <br/>
    <span class="alert">*</span> День публикации:<br/>
    <input name="publish_day" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($smi_publish_day, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_publish_day;?></div>
    <br/>
    Территория распространения:<br/>
    <textarea name="territory" rows="10" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($smi_territory, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_territory;?></div>
    <br/>
    Регионы распространения:<br/>
    <textarea name="regions" rows="10" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($smi_regions, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_regions;?></div>
    <br/>
    Способ распространения:<br/>
    <textarea name="distribute_way" rows="10" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($smi_distribute_way, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_distribute_way;?></div>
    <br/>
    Описание:<br/>
    <textarea name="info" rows="10" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($smi_info, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_info;?></div>
    <br/>
    <span class="alert">*</span> Прайс:<br/>
    <textarea name="price_list" rows="10" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($smi_price_list, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_price_list;?></div>
    <br/>
    Рубрики:<br/>
    <textarea name="rubriks" rows="10" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($smi_rubriks, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_rubriks;?></div>
    <br/>
    Наша скидка:<br/>
    <input name="discount_portal" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($smi_discount_portal, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_discount_portal;?></div>
    <br/>
    Скидки за количество:<br/>
    <textarea name="discount_nums" rows="10" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($smi_discount_nums, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_discount_nums;?></div>
    <br/>
    Скидка агентства:<br/>
    <input name="discount_agency" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($smi_discount_agency, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_discount_agency;?></div>
    <br/>
    Наценка:<br/>
    <input name="discount_markup" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($smi_discount_markup, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_discount_markup;?></div>
    <br/>
    Наценка на города:<br/>
    <textarea name="markup_cities" rows="10" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($smi_markup_cities, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_markup_cities;?></div>
    <br/>
    Изображение:<br/>
    <input type="file" name="image"/>
    <div class="alert"><?=$alert_image;?></div>
    <br/>
    Востребованность:<br/>
    <input name="rate" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($smi_rate, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_rate;?></div>
    <br/>
    <input type="submit" value="Добавить"/>
    <div class="alert"><?=$result;?></div>
</form>