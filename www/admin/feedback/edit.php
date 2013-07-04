<?php
/***********************************************
-=Ms Site=-

Модуль: Feedback
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Редактирование вопроса администратором
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_feedback_edit';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/feedback.class');
    $feedback = new Feedback;

	require_once('../../cgi-bin/vars/alert.class');
    $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
    $validate = new Validate;

	//обнуление
	$alert_text = $alert_name = $alert_email = $alert_city = $alert_company = $alert_answer = '';
	$result = $feedback_text = $feedback_name = $feedback_email = $feedback_city = $feedback_company = $feedback_answer = '';

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		//проверка на честность
		if (
				!isset($_GET['id']) ||
				!$feedback->SqlIsExist($_GET['id'], 'feedback_items')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$feedback_id = $_GET['id'];
		$feedback_info = $feedback->SqlGetObj($feedback_id, 'feedback_items');
		$feedback_text = $feedback_info['text'];
		$feedback_name = $feedback_info['name'];
		$feedback_email = $feedback_info['email'];
		$feedback_city = $feedback_info['city'];
		$feedback_company = $feedback_info['company'];
		$feedback_answer = $feedback_info['answer'];
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if (
  			!isset($_POST['text']) ||
  			!isset($_POST['name']) ||
  			!isset($_POST['email']) ||
  			!isset($_POST['city']) ||
  			!isset($_POST['company']) ||
  			!isset($_POST['answer']) ||
  			!isset($_POST['id']) ||
  			!$feedback->SqlIsExist($_POST['id'], 'feedback_items')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$feedback_id= $_POST['id'];
		$feedback_text = $_POST['text'];
		$feedback_name = $_POST['name'];
		$feedback_email = $_POST['email'];
		$feedback_city = $_POST['city'];
		$feedback_company = $_POST['company'];
		$feedback_answer = $_POST['answer'];

		$feedback_info = $feedback->SqlGetObj($feedback_id, 'feedback_items');

		//name
		if ( !$validate->IsRightLength($feedback_name, 0, 255) ) { $alert_name = $alert->ALERT['0-255']; $alert->NOVALID = TRUE; }

		//city
		if ( !$validate->IsRightLength($feedback_city, 0, 255) ) { $alert_city = $alert->ALERT['0-255']; $alert->NOVALID = TRUE; }

		//company
		if ( !$validate->IsRightLength($feedback_company, 0, 255) ) { $alert_company = $alert->ALERT['0-255']; $alert->NOVALID = TRUE; }

		//обработка
		if ($alert->NOVALID == FALSE)
		{
			$add_array = array(
								'text' => $feedback_text,
								'answer' => $feedback_answer,
								'name' => $feedback_name,
								'email' => $feedback_email,
								'city' => $feedback_city,
								'company' => $feedback_company
								);				

			$result = $feedback->SqlUpdateHtml($feedback_id, $add_array, 'feedback_items');
			if ($result) $site->SiteGoTo($parent_page);
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>
