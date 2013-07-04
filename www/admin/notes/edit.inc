<form class="mainform" name="notes_add" method="post" action="<?=$site->PAGES[$site->PAGE]['url'];?>" class="mainform">
    <input type="hidden" name="id" value="<?=$notes_id;?>" />
    <br/>
    <span class="alert">*</span> Каналы:<br/>
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
    ID пользователя:<br/>
    <input name="user" type="text" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($notes_user, ENT_QUOTES);?>"/>
	<div class="alert"><?=$alert_user;?></div>
    <br/>
	IP:<br/>
    <input name="ip" type="text" maxlength="15" value="<?=htmlspecialchars($notes_ip, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_ip;?></div>
    <br/>
    Дата:<br/>
    <input type="text" name="date" maxlength="255" onclick="this.style.background='white'" value="<?=htmlspecialchars($notes_date, ENT_QUOTES);?>"/>
    <div class="alert"><?=$alert_date;?></div>
    <br/>
    <button type="submit">Сохранить изменения</button>
    <div class="alert"><?=$result;?></div>
</form>