<?php
/***********************************************
-=Ms Site=-

Модуль: Feedback
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Обратная связь
***********************************************/

	//подключение главного модуля
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'feedback';
	$parent_page = $site->GetParentPage();

	require_once('../cgi-bin/feedback.class');
    $feedback = new Feedback;

	require_once('../cgi-bin/vars/alert.class');
    $alert = new Alert;

	require_once('../cgi-bin/utils/validate.class');
    $validate = new Validate;

	require_once("../cgi-bin/utils/mail.class");
    $mail = new Mail;
	
	//обнуление
	$alert_text = $alert_name = $alert_email = $alert_city = $alert_company = '';
	$result = $feedback_text = $feedback_name = $feedback_email = $feedback_city = $feedback_company = '';	
	
	//инициализация	
	$items_info = $feedback->SqlGetReverseTable('feedback_items');
	$feedback_items = $feedback->SqlGetTableLastObjects(5, 'feedback_items');

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if (
			!isset($_POST['text']) ||
			!isset($_POST['name']) ||
			!isset($_POST['email']) ||
			!isset($_POST['city']) ||
			!isset($_POST['company'])
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$feedback_text = $_POST['text'];
		$feedback_name = $_POST['name'];
		$feedback_email = $_POST['email'];
		$feedback_city = $_POST['city'];
		$feedback_company = $_POST['company'];

		//text
		/*if ( $validate->IsDamn($feedback_text) ) { $alert_text = $alert->ALERT['damn']; $alert->NOVALID = 'ALERT'; }*/
		if ( !$validate->IsRightLength($feedback_text, 1, 2000) ) { $alert_text = $alert->ALERT['1-2000']; $alert->NOVALID = TRUE; }

		//name
		if ( !$validate->IsRightLength($feedback_name, 0, 255) ) { $alert_name = $alert->ALERT['0-255']; $alert->NOVALID = TRUE; }

		//email
		if ( !$validate->IsEmail($feedback_email) && !$validate->IsEmpty($feedback_email) ) { $alert_email = $alert->ALERT['email']; $alert->NOVALID = TRUE; }

		//city
		if ( !$validate->IsRightLength($feedback_city, 0, 255) ) { $alert_city = $alert->ALERT['0-255']; $alert->NOVALID = TRUE; }

		//company
		if ( !$validate->IsRightLength($feedback_company, 0, 255) ) { $alert_company = $alert->ALERT['0-255']; $alert->NOVALID = TRUE; }

    //обработка
		if ($alert->NOVALID == FALSE)
		{
			$add_array = array(
								'text' => $feedback_text,
								'name' => $feedback_name,
								'email' => $feedback_email,
								'city' => $feedback_city,
								'company' => $feedback_company
								);

			$result = $feedback->SqlAdd($add_array, 'feedback_items');
			
        	$message = '
        	Компания: ' . $feedback_company . '
        	Город: ' . $feedback_city . '
        	Имя: ' . $feedback_name . '
        	E-mail: ' . $feedback_email . '
        	Текст: ' . $feedback_text;

			if ($result) $result = $mail->MailMailer($site->EMAIL_OWNER, 'Feedback message', $message);

			if ($result) $site->SiteGoTo($site->PAGES['feedback_ok']['url']);
			else $result = $alert->ALERT['system_error'];
		}
	}
	
	
	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>