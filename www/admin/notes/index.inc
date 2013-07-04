
Добавить новую статью:<br/><br/>
<form class="mainform" name="notes_add" method="post" action="<?=$site->PAGES[$site->PAGE]['url'];?>" enctype="multipart/form-data" class="mainform">
    <span class="alert">*</span> Объявление:<br/>
    <textarea name="title" rows="6" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($notes_title, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_title;?></div>
    <br/>
    Каналы:<br/>
    <textarea name="text" rows="10" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($notes_text, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_text;?></div>
    <br/>
    Изображение:<br/>
    <input type="file" name="image" class="autowidth"/>
    <div class="alert"><?=$alert_image;?></div>
	<br/>
    Источник:<br/>
    <input name="name" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($notes_name, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_name;?></div>
    <br/>
    Сайт источника:<br/>
    <input name="url" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($notes_url, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_url;?></div>
    <br/>
    E-mail источника:<br/>
    <input name="email" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($notes_email, ENT_QUOTES);?>"/>
	<div class="alert"><?=$alert_email;?></div>
    <br/>
    Ключевые слова:<br/>
    <textarea name="tags" rows="10" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($notes_tags, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_tags;?></div>
    <br/>
    <button type="submit">Добавить</button>
    <div class="alert"><?=$result;?></div>
</form>
</br></br>
<?
  	$i = 0;
  	foreach ($notes_cats as $cat_id => $cat_params)
  	{
  		echo '<a href="' . $site->PAGES['admin_notes_cat']['url'] . '?cat=' . $cat_id . '">' . $cat_params['title'] . ' </a> (<a href="' . $site->PAGES['admin_notes_editcat']['url'] . '?cat=' . $cat_id  . '">редактировать</a> | <a href="' . $site->PAGES['admin_notes_delcat']['url'] . '?cat=' . $cat_id  . '" onclick="return confirm(\'Вы действительно хотите удалить статью и комментарии?\')">удалить</a>)<br/>';
		$i++;
  	}
  	if ($i == 0) echo 'Статей нет.<br/>';
?>