<h2>Подписка</h2><br/><br/>
<?=$alert->ALERT_SCRIPT;?>
<script src="js/validation.js"></script>
<script src="js/subscribe.js"></script>
<form name="subscribe" action="<?=$site->PAGES[$site->PAGE]['url'];?>" method="post" onsubmit="return subscribe_check(this);">
	Ваш e-mail: <input name="email" type="Text" maxlength="255" value="<?=htmlspecialchars($subscribe_email, ENT_QUOTES);?>" onclick="this.style.background='white'"/><br/><br/>
	Имя: <input name="name" type="text" maxlength="255" value="<?=htmlspecialchars($subscribe_name, ENT_QUOTES);?>"/><br/><br/>
	<input type="radio" name="mode" value="subscribe" <? if ($subscribe_mode == 'subscribe') echo 'checked'; ?>/> подписаться<br/>
	<input type="radio" name="mode" value="unsubscribe" <? if ($subscribe_mode == 'unsubscribe') echo 'checked'; ?>/> отписаться<br/>
	<input type="radio" name="mode" value="check" <? if ($subscribe_mode == 'check') echo 'checked'; ?>/> проверить подписку<br/><br/>
	<input type="Submit" value="OK"/><br/>
</form>
<div class="alert">
	<?
		echo $alert_email;
		echo $result;
	?>
</div>