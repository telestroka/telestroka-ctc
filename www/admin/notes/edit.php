<?php
/***********************************************
-=Ms Site=-

Модуль: Notes
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Редактирование комментария к статье администратором
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_notes_edit';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/notes.class');
    $notes = new notes;

	require_once('../../cgi-bin/vars/alert.class');
    $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
    $validate = new Validate;

	//обнуление
	$alert_text = $alert_name = $alert_email = $alert_user = $alert_ip = $alert_date = '';
	$result = $notes_text = $notes_name = $notes_email = $notes_user = $notes_ip = $notes_date = '';

	//инициализация
	 $notes_cats = $notes->SqlGetTable('notes_cats');

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		//проверка на честность
		if (
			!isset($_GET['id']) ||
			!$notes->SqlIsExist($_GET['id'], 'notes_items')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$notes_id = $_GET['id'];
		$notes_info = $notes->SqlGetObj($notes_id, 'notes_items');
		$notes_text = $notes_info['text'];
		$notes_name = $notes_info['name'];
		$notes_email = $notes_info['email'];
		$notes_user = $notes_info['user'];
		$notes_ip = $notes_info['ip'];
		$notes_date = $notes_info['date'];
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if (
  			!isset($_POST['text']) ||
  			!isset($_POST['name']) ||
  			!isset($_POST['email']) ||
  			!isset($_POST['user']) ||
  			!isset($_POST['ip']) ||
  			!isset($_POST['date']) ||
  			!isset($_POST['id']) ||
  			!$notes->SqlIsExist($_POST['id'], 'notes_items')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$notes_id= $_POST['id'];
		$notes_text = $_POST['text'];
		$notes_name = $_POST['name'];
		$notes_email = $_POST['email'];
		$notes_user = $_POST['user'];
		$notes_ip = $_POST['ip'];
		$notes_date = $_POST['date'];

		$notes_info = $notes->SqlGetObj($notes_id, 'notes_items');

		//name
		if ( !$validate->IsRightLength($notes_name, 1, 255) ) { $alert_name = $alert->ALERT['1-255']; $alert->NOVALID = TRUE; }

		//email
		if ( !$validate->IsEmail($notes_email) && !$validate->IsEmpty($notes_email) ) { $alert_email = $alert->ALERT['email']; $alert->NOVALID = TRUE; }

		//user
		if ( !$validate->IsRightLength($notes_user, 0, 255) ) { $alert_user = $alert->ALERT['0-255']; $alert->NOVALID = TRUE; }

        //ip
        if ( !$validate->IsIp($notes_ip) && !$validate->IsEmpty($notes_ip) ) { $alert_ip = $alert->ALERT['ip']; $alert->NOVALID = TRUE; }

		//обработка
		if ($alert->NOVALID == FALSE)
		{
			$add_array = array(
								'text' => $notes_text,
								'name' => $notes_name,
								'email' => $notes_email,
								'user' => $notes_user,
								'ip' => $notes_ip,
								'date' => $notes_date
								);				

			$result = $notes->SqlUpdateHtml($notes_id, $add_array, 'notes_items');
			if ($result) $site->SiteGoTo($parent_page . '?cat=' . $notes_info['cat']);
			else $result = $alert->ALERT['system_error'];
		}
	}
	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>