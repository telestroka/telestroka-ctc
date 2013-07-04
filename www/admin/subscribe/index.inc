Список адресов для рассылки:<br/><br/>
<?
	$emails = $subscribe->FileGetInfo($site->PATH_DATA . '/subscribe.dat');
	foreach ($emails as $key => $email)
	{
		if ( strlen($email) > 5 ) echo $email . '<br/>';
	}
?>
<br/>
<form class="mainform" name="subscribe" action="<?=$site->PAGES[$site->PAGE]['url'];?>" method="post">
	<input type="Submit" value="Запустить рассылку">
	<div class="alert"><?=$result;?></div>
</form>