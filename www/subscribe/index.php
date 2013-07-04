<?php
/***********************************************
-=Ms Site=-

Модуль: Subscribe
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Скрипт подписки
***********************************************/

	//подключение главного модуля
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'subscribe';

	require_once('../cgi-bin/subscribe.class');
    $subscribe = new Subscribe;

	require_once('../cgi-bin/smi.class');
    $smi = new Smi;

	require_once('../cgi-bin/vars/alert.class');
    $alert = new Alert;

	require_once('../cgi-bin/utils/validate.class');
    $validate = new Validate;

	require_once('../cgi-bin/utils/mail.class');
    $mail = new Mail;

	$parent_page = $site->GetParentPage();

	//проверка на честность
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (
			!isset($_POST['mode']) ||
			!isset($_POST['email'])
		   ) $site->SiteGoTo($parent_page);
	}

	//обнуление
	$alert_email = $subscribe_email = $subscribe_name = '';
	$result = FALSE;
	$subscribe_mode = 'subscribe';

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$subscribe_email = $_POST['email'];
		$subscribe_name = $_POST['name'];
		$subscribe_mode = $_POST['mode'];

		//email
		if ( !$validate->IsEmail($subscribe_email) ) { $alert_email = $alert->ALERT['email']; $alert->NOVALID = TRUE; }

		//validation
		if ($alert->NOVALID == FALSE)
		{
			if ( $subscribe_mode == 'subscribe' )
			{
				$result = $subscribe->FileAdd($site->PATH_DATA . '/subscribe.dat', $subscribe_email);
				if ($result)
				{
					$message = 'Адрес ' . $subscribe_email . ' (' . $subscribe_name . ') подписан на рассылку сайта ' . $site->NAME_SITE;
					$subject = 'Raportal subscribe';
					$mail->MailMailer($site->EMAIL_OWNER, $subject, $message);
				}
				$result = ($result) ? 'Адрес' . $subscribe_email . ' внесен в базу подписки. ' : 'Адрес' . $subscribe_email . ' уже был внесен в базу раньше.';
			}
			if ( $subscribe_mode == 'unsubscribe' )
			{
				$result = $subscribe->FileDel($site->PATH_DATA . '/subscribe.dat', $subscribe_email);
				$result=($result)?'Адрес ' . $subscribe_email . ' исключен из базы подписки. ':'Адрес ' . $subscribe_email . ' не найден в базе подписки.';
			}
			if ( $subscribe_mode == 'check' )
			{
				$status = ' не подписан';
				$result = $subscribe->FileIsItemExist($site->PATH_DATA . '/subscribe.dat', $subscribe_email);
				if ($result)$status = ' подписан';
				$message = 'Адрес ' . $subscribe_email.$status . ' на рассылку сайта ' . $site->NAME_SITE;
				$subject = 'Состояние подписки на рассылку сайта ' . $site->NAME_SITE;
				$mail->MailMailer($subscribe_email, $subject, $message);
				$result = 'Состояние подписки выслано на указанный адрес';
			}
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>