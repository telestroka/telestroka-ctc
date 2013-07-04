<h1 class="title">Ответы на частые вопросы:</h1>
<?
	$i = 0;
	foreach ($items_info as $item_id => $item_params)
	{
		if ($item_params['answer']  == '') continue;
		echo $item_params['text'] . '<br/>';
		echo '<i>' . $item_params['name'] . '</i>';		
		echo '<div style="padding: 20px 0 40px 40px;">' . $item_params['answer'] . '</div>';
		echo '<div class="form-separator"><span></span></div>';
		$i++;
	}
	if ($i == 0) echo 'Вопросов нет.<br/><br/>';
?>
<a name="form"></a>
<h1 class="gray">Спросить у Анастасии</h1><br/>
<?=$alert->ALERT_SCRIPT;?>
<script src="js/validation.js"></script>
<script src="js/feedback.js"></script>
<form name="feedback_add" action="<?=$site->PAGES[$site->PAGE]['url'];?>" method="post" class="mainform" onsubmit="return feedback_check(this);">
	Название организации<br/><input name="company" type="text" maxlength="255" style="width: 400px;" onclick="this.style.background='white'" value="<?=htmlspecialchars($feedback_company, ENT_QUOTES);?>"/>
	<div class="alert"><?=$alert_company;?></div>
	<br/>
	Город<br/><input name="city" type="text" maxlength="255" style="width: 400px;" onclick="this.style.background='white'" value="<?=htmlspecialchars($feedback_city, ENT_QUOTES);?>"/>
	<div class="alert"><?=$alert_city;?></div>
	<br/>
	Имя<br/><input name="name" type="text" maxlength="255" style="width: 400px;" onclick="this.style.background='white'" value="<?=htmlspecialchars($feedback_name, ENT_QUOTES);?>"/>
	<div class="alert"><?=$alert_name;?></div>
	<br/>
	e-mail<br/><input name="email" type="text" maxlength="255" style="width: 400px;" onclick="this.style.background='white'" value="<?=htmlspecialchars($feedback_email, ENT_QUOTES);?>"/>
	<div class="alert"><?=$alert_email;?></div>
	<br/>
	Сообщение<br/>
	<textarea name="text" rows="10" cols="50" style="width: 400px;" onclick="this.style.background='white'"><?=htmlspecialchars($feedback_text, ENT_QUOTES);?></textarea>
	<div class="alert"><?=$alert_text;?></div>
	<br/>
	<input type="Submit" value="Отправить">
	<div class="alert"><?=$result;?></div>
</form>