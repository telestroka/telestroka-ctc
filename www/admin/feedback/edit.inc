<?=$alert->ALERT_SCRIPT;?>
<script language="JavaScript" type="text/javascript" src="js/validation.js"></script>
<script language="JavaScript" type="text/javascript" src="js/feedback.js"></script>
<form class="mainform" name="feedback_add" method="post" action="<?=$site->PAGES[$site->PAGE]['url'];?>" class="mainform" onsubmit="return feedback_check(this);">
    <input type="hidden" name="id" value="<?=$feedback_id;?>" />
    Текст:<br/>
    <textarea name="text" rows="10" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($feedback_text, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_text;?></div>
    <br/>
    Ответ:<br/>
    <textarea name="answer" rows="10" cols="17" onclick="this.style.background='white'"><?=htmlspecialchars($feedback_answer, ENT_QUOTES);?></textarea>
    <div class="alert"><?=$alert_answer;?></div>
    <br/>
    Имя:<br/>
    <input name="name" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($feedback_name, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_name;?></div>
    <br/>
    Адрес e-mail:<br/>
    <input name="email" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($feedback_email, ENT_QUOTES);?>"/>
	<div class="alert"><?=$alert_email;?></div>
    <br/>
    Город:<br/>
    <input name="city" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($feedback_city, ENT_QUOTES);?>"/>
	<div class="alert"><?=$alert_city;?></div>
    <br/>
    Организация:<br/>
    <input name="company" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($feedback_company, ENT_QUOTES);?>"/>
	<div class="alert"><?=$alert_company;?></div>
    <br/><br/>
    <button type="submit">Сохранить изменения</button>
    <div class="alert"><?=$result;?></div>
</form>