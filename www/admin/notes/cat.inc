<?
  	$i = 0;
  	foreach ($notes_info as $item_id => $item_params)
  	{
  		echo $item_params['text'] . '<br/> (<a href="' . $site->PAGES['admin_notes_edit']['url'] . '?id=' . $item_id  . '">редактировать</a> | <a href="' . $site->PAGES['admin_notes_del']['url'] . '?id=' . $item_id  . '" onclick="return confirm(\'Вы действительно хотите удалить комментарий?\')">удалить</a>)<br/><br/>';
		$i++;
  	}
  	if ($i == 0) echo 'Комментариев нет.<br/>';
?>
<br/><br/>Добавить новый комментарий:<br/><br/>
<form class="mainform" name="notes_add" method="post" action="<?=$site->PAGES[$site->PAGE]['url'];?>" class="mainform">
    <input type="hidden" name="cat" value="<?=$notes_cat;?>" />
    <span class="alert">*</span> Текст:<br/>
    <textarea name="text" rows="10" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($notes_text, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_text;?></div>
    <br/>
    <span class="alert">*</span> Имя:<br/>
    <input name="name" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($notes_name, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_name;?></div>
    <br/>
    Адрес e-mail:<br/>
    <input name="email" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($notes_email, ENT_QUOTES);?>"/>
	<div class="alert"><?=$alert_email;?></div>
    <br/>
    <button type="submit">Добавить</button>
    <div class="alert"><?=$result;?></div>
</form>